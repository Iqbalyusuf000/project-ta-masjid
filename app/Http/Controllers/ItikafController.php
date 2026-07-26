<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DonationSetting;
use App\Models\DonationCategory;
use App\Models\DonationTransaction;
use App\Models\ItikafRegistration;
use App\Models\ItikafFaq;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ItikafController extends Controller
{
    /**
     * Menampilkan halaman pendaftaran I'tikaf Ramadhan beserta statistik,
     * daftar FAQ, dan pengaturan donasi.
     */
    public function index()
    {
        $setting  = DonationSetting::first();
        $programs = DonationCategory::where('is_active', true)->get();
        $faqs     = ItikafFaq::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        // --- Statistik Kuota Jamaah ---
        $totalIkhwan = ItikafRegistration::where('status', 'confirmed')
            ->where('gender', 'L')
            ->count();

        $totalAkhwat = ItikafRegistration::where('status', 'confirmed')
            ->where('gender', 'P')
            ->count();

        $totalJamaah = $totalIkhwan + $totalAkhwat;

        // --- Total Kas dari Infaq Ramadan & I'tikaf ---
        $infaqCategory = DonationCategory::where('name', "Infaq Ramadan")->first();
        $totalKas = 0;
        if ($infaqCategory) {
            $totalKas = DonationTransaction::where('donation_category_id', $infaqCategory->id)
                ->where('reference_type', 'itikaf_registration')
                ->where('status', 'success')
                ->sum('amount');
        }

        return view('pages.itikaf', compact(
            'setting',
            'programs',
            'faqs',
            'totalIkhwan',
            'totalAkhwat',
            'totalJamaah',
            'totalKas'
        ));
    }

    /**
     * Memproses pendaftaran I'tikaf via AJAX dan mengembalikan JSON response.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'whatsapp'           => 'required|string|min:11|max:13',
            'gender'             => 'required|in:L,P',
            'days_selected'      => 'required|array|min:1',
            'days_selected.*'    => 'required|string',
            'jenis_tambahan'     => 'required|in:tidak_ada,infaq',
            'nominal_tambahan'   => 'nullable|numeric|min:1000',
            'metode_pembayaran'  => 'nullable|in:tunai,transfer_qris',
        ]);

        try {
            DB::beginTransaction();

            // Generate kode unik I'tikaf
            $itikafCode = 'ITK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
            $setting = DonationSetting::first();

            // Simpan data pendaftaran
            $itikaf = ItikafRegistration::create([
                'itikaf_code'   => $itikafCode,
                'name'          => $request->name,
                'whatsapp'      => $request->whatsapp,
                'gender'        => $request->gender,
                'days_selected' => $request->days_selected,
                'status'        => 'pending',
            ]);

            $infaqData = null;

            // Jika jamaah memilih menambahkan infaq
            if ($request->jenis_tambahan === 'infaq' && $request->nominal_tambahan > 0) {
                // Pastikan kategori donasi khusus I'tikaf sudah ada
                $category = DonationCategory::firstOrCreate(
                    ['name' => "Infaq Ramadan"],
                    [
                        'is_active'   => true,
                        'description' => "Infaq tambahan saat pendaftaran I'tikaf Ramadhan",
                    ]
                );

                $donationCode = 'INV-' . now()->format('YmdHis');
                $uniqueCode   = rand(1, 100); // 3 digit unik
                $totalAmount  = $request->nominal_tambahan + $uniqueCode;

                DonationTransaction::create([
                    'donation_code'        => $donationCode,
                    'donation_category_id' => $category->id,
                    'source'               => 'web',
                    'donation_name'        => $request->name,
                    'amount'               => $request->nominal_tambahan,
                    'unique_code'          => $uniqueCode,
                    'total_amount'         => $totalAmount,
                    'payment_method'       => $request->metode_pembayaran ?? 'tunai',
                    'status'               => 'pending',
                    'reference_type'       => 'itikaf_registration',
                    'reference_id'         => $itikaf->id,
                ]);

                $qrisImageUrl = null;
                if ($setting && $setting->qris_image) {
                    $qrisImageUrl = asset('storage/' . $setting->qris_image);
                }

                $infaqData = [
                    'nominal'        => $request->nominal_tambahan,
                    'unique_code'    => $uniqueCode,
                    'total_amount'   => $totalAmount,
                    'payment_method' => $request->metode_pembayaran ?? 'tunai',
                    'qris_image_url' => $qrisImageUrl,
                    'bank_name'      => $setting->bank_name ?? null,
                    'account_number' => $setting->account_number ?? null,
                    'account_name'   => $setting->account_name ?? null,
                ];
            }

            // Send Notification to all Admins
            $notificationBody = "Pendaftaran I'tikaf baru atas nama {$request->name} untuk " . count($request->days_selected) . " hari.";
            if ($infaqData !== null) {
                $totalFormatted = number_format($totalAmount, 0, ',', '.');
                $notificationBody .= " Beliau juga menyertakan Infaq sebesar Rp {$totalFormatted}.";
            }

            \Filament\Notifications\Notification::make()
                ->title('Pendaftaran I\'tikaf Baru')
                ->body($notificationBody)
                ->success()
                ->sendToDatabase(\App\Models\User::all());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Alhamdulillah, pendaftaran I'tikaf berhasil!",
                'data'    => [
                    'itikaf_code'   => $itikafCode,
                    'name'          => $request->name,
                    'gender'        => $request->gender,
                    'days_selected' => $request->days_selected,
                    'has_infaq'     => $infaqData !== null,
                    'infaq'         => $infaqData,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
