<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DonationSetting;
use App\Models\DonationCategory;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\ZakatFitrah;
use App\Models\DonationTransaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ZakatController extends Controller
{
    public function index()
    {
        $setting = DonationSetting::first();
        $programs = DonationCategory::where('is_active', true)->get();
        $testimoni = Testimonial::query()->where('is_active', true)->inRandomOrder()->limit(6)->get();
        $faqs = Faq::where('is_active', true)->get();

        // Statistics
        $totalBeras = ZakatFitrah::where('zakat_status', 'confirmed')->sum('rice_total');
        $totalMuzakki = ZakatFitrah::sum('total_people');

        // Total kas hanya dari kategori "Infaq Zakat Fitrah" dengan reference_type zakat_fitrah
        $infaqZakatCategory = DonationCategory::where('name', 'Infaq Zakat Fitrah')->first();
        $totalKas = 0;
        if ($infaqZakatCategory) {
            $totalKas = DonationTransaction::where('donation_category_id', $infaqZakatCategory->id)
                ->where('reference_type', 'zakat_fitrah')
                ->where('status', 'success')
                ->sum('amount');
        }

        // Default values for setting
        $riceWeight = $setting ? ($setting->rice_weight ?? 3.00) : 3.00;

        return view('pages.zakat', compact(
            'riceWeight', 'programs', 'testimoni', 'faqs',
            'totalBeras', 'totalKas', 'totalMuzakki', 'setting'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pembayar' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jumlah_jiwa' => 'required|integer|min:1',
            'jenis_tambahan' => 'required|in:tidak_ada,infaq',
            'nominal_tambahan' => 'nullable|numeric|min:1000',
            'metode_pembayaran' => 'nullable|in:tunai,transfer_qris'
        ]);

        try {
            DB::beginTransaction();

            $setting = DonationSetting::first();
            $riceWeight = $setting ? ($setting->rice_weight ?? 3.00) : 3.00;
            $riceTotal = $request->jumlah_jiwa * $riceWeight;

            // Generate unique code for zakat
            $zakatCode = 'ZKT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

            $zakat = ZakatFitrah::create([
                'zakat_code' => $zakatCode,
                'muzakki_name' => $request->nama_pembayar,
                'address' => $request->alamat,
                'total_people' => $request->jumlah_jiwa,
                'rice_total' => $riceTotal,
                'zakat_status' => 'pending',
            ]);

            $infaqData = null;

            if ($request->jenis_tambahan === 'infaq' && $request->nominal_tambahan > 0) {
                // Pastikan masuk ke kategori "Infaq Zakat Fitrah" saja
                $category = DonationCategory::firstOrCreate(
                    ['name' => 'Infaq Zakat Fitrah'],
                    ['is_active' => true, 'description' => 'Infaq tambahan saat membayar Zakat Fitrah']
                );

                $donationCode = 'INV-' . now()->format('YmdHis');
                $uniqueCode = rand(1, 100);
                $totalAmount = $request->nominal_tambahan + $uniqueCode;

                DonationTransaction::create([
                    'donation_code' => $donationCode,
                    'donation_category_id' => $category->id,
                    'source' => 'web',
                    'donation_name' => $request->nama_pembayar,
                    'amount' => $request->nominal_tambahan,
                    'unique_code' => $uniqueCode,
                    'total_amount' => $totalAmount,
                    'payment_method' => $request->metode_pembayaran ?? 'tunai',
                    'status' => 'pending',
                    'reference_type' => 'zakat_fitrah',
                    'reference_id' => $zakat->id,
                ]);

                $qrisImageUrl = null;
                if ($setting && $setting->qris_image) {
                    $qrisImageUrl = asset('storage/' . $setting->qris_image);
                }

                $infaqData = [
                    'nominal' => $request->nominal_tambahan,
                    'unique_code' => $uniqueCode,
                    'total_amount' => $totalAmount,
                    'payment_method' => $request->metode_pembayaran ?? 'tunai',
                    'qris_image_url' => $qrisImageUrl,
                    'bank_name' => $setting->bank_name ?? null,
                    'account_number' => $setting->account_number ?? null,
                    'account_name' => $setting->account_name ?? null,
                ];
            }

            // Send Notification to all Admins
            $notificationBody = "Pendaftaran Zakat Fitrah baru atas nama {$request->nama_pembayar} sejumlah {$riceTotal} kg.";
            if ($infaqData !== null) {
                $totalFormatted = number_format($totalAmount, 0, ',', '.');
                $notificationBody .= " Beliau juga menyertakan Infaq sebesar Rp {$totalFormatted}.";
            }

            \Filament\Notifications\Notification::make()
                ->title('Zakat Fitrah Baru Masuk')
                ->body($notificationBody)
                ->success()
                ->sendToDatabase(\App\Models\User::all());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendaftar Zakat Fitrah.',
                'data' => [
                    'zakat_code' => $zakatCode,
                    'muzakki_name' => $request->nama_pembayar,
                    'jumlah_jiwa' => $request->jumlah_jiwa,
                    'rice_total' => $riceTotal,
                    'has_infaq' => $infaqData !== null,
                    'infaq' => $infaqData,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
}
