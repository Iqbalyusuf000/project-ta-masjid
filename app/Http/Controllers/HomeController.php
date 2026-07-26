<?php

namespace App\Http\Controllers;

use App\Models\DonationCategory;
use App\Models\DonationTransaction;
use App\Models\ExpenseTransaction;
use App\Models\KajianDetail;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // --- Kajian Terdekat (5 kajian mendatang) ---
        $upcomingKajian = Cache::remember('home.upcoming_kajian', 300, function () {
            return KajianDetail::with(['kajian', 'ustadz', 'location'])
                ->where('date', '>=', now()->toDateString())
                ->orderBy('date', 'asc')
                ->orderBy('start_time', 'asc')
                ->limit(5)
                ->get();
        });

        // --- Testimonial ---
        $testimonials = Cache::remember('home.testimonials', 300, function () {
            return Testimonial::query()->where('is_active', true)->inRandomOrder()->limit(6)->get();
        });

        // --- Ringkasan Keuangan ---
        $totalMasuk = Cache::remember('home.total_masuk', 300, function () {
            return DonationTransaction::where('status', 'success')->sum('total_amount');
        });
        $totalKeluar = Cache::remember('home.total_keluar', 300, function () {
            return ExpenseTransaction::sum('amount');
        });
        $totalSaldo = $totalMasuk - $totalKeluar;

        $bulanIni = now()->month;
        $tahunIni = now()->year;
        $masukBulanIni = Cache::remember('home.masuk_bulan_ini.' . $bulanIni . '.' . $tahunIni, 300, function () use ($bulanIni, $tahunIni) {
            return DonationTransaction::where('status', 'success')
                ->whereMonth('created_at', $bulanIni)
                ->whereYear('created_at', $tahunIni)
                ->sum('total_amount');
        });
        $keluarBulanIni = Cache::remember('home.keluar_bulan_ini.' . $bulanIni . '.' . $tahunIni, 300, function () use ($bulanIni, $tahunIni) {
            return ExpenseTransaction::whereMonth('expense_date', $bulanIni)
                ->whereYear('expense_date', $tahunIni)
                ->sum('amount');
        });

        // --- Program Infaq / Sedekah ---
        $programs = Cache::remember('home.programs', 300, function () {
            return DonationCategory::where('is_active', true)->get();
        });

        return view('pages.home', compact(
            'upcomingKajian',
            'testimonials',
            'totalMasuk',
            'totalKeluar',
            'totalSaldo',
            'masukBulanIni',
            'keluarBulanIni',
            'programs',
        ));
    }

    public function indexNative()
    {
        // --- Kajian Terdekat (5 kajian mendatang) ---
        $upcomingKajian = KajianDetail::with(['kajian', 'ustadz', 'location'])
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->limit(5)
            ->get();

        // --- Testimonial ---
        $testimonials = Testimonial::query()->where('is_active', true)->inRandomOrder()->limit(6)->get();

        // --- Ringkasan Keuangan ---
        $totalMasuk  = DonationTransaction::where('status', 'success')->sum('total_amount');
        $totalKeluar = ExpenseTransaction::sum('amount');
        $totalSaldo  = $totalMasuk - $totalKeluar;

        $bulanIni       = now()->month;
        $tahunIni       = now()->year;
        $masukBulanIni  = DonationTransaction::where('status', 'success')
                            ->whereMonth('created_at', $bulanIni)
                            ->whereYear('created_at', $tahunIni)
                            ->sum('total_amount');
        $keluarBulanIni = ExpenseTransaction::whereMonth('expense_date', $bulanIni)
                            ->whereYear('expense_date', $tahunIni)
                            ->sum('amount');

        // --- Program Infaq / Sedekah ---
        $programs = DonationCategory::where('is_active', true)->get();

        return view('pages.home-native', compact(
            'upcomingKajian',
            'testimonials',
            'totalMasuk',
            'totalKeluar',
            'totalSaldo',
            'masukBulanIni',
            'keluarBulanIni',
            'programs',
        ));
    }

    public function storeDonation(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name'                  => 'nullable|string|max:255',
            'donation_category_id'  => 'required|exists:donation_categories,id',
            'amount'                => 'required|numeric|min:10000',
        ]);

        $donationCode = 'INV-' . now()->format('YmdHis');
        $uniqueCode = rand(1, 100);
        $totalAmount = $request->amount + $uniqueCode;

        $category = DonationCategory::findOrFail($request->donation_category_id);
        
        // Pemetaan manual sesuai nama kategori dari seeder
        $referenceType = match ($category->name) {
            'Infaq Zakat Fitrah'        => 'zakat_fitrah',
            'Infaq Umum'                => 'infaq_umum',
            'Santunan Yatim & Dhuafa'   => 'santunan_yatim_piatu',
            'Infaq Ramadan'             => 'itikaf_registration',
            default                     => 'infaq_umum',
        };

        DonationTransaction::create([
            'donation_code' => $donationCode,
            'donation_category_id' => $request->donation_category_id,
            'source' => 'web',
            'donation_name' => $request->name ?: 'Hamba Allah',
            'amount' => $request->amount,
            'unique_code' => $uniqueCode,
            'total_amount' => $totalAmount,
            'payment_method' => 'transfer_qris', // Default
            'status' => 'pending',
            'reference_type' => $referenceType,
        ]);

        $setting = \App\Models\DonationSetting::first();
        $qrisImageUrl = null;
        if ($setting && $setting->qris_image) {
            $qrisImageUrl = asset('storage/' . $setting->qris_image);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat tagihan infaq.',
            'data' => [
                'donation_code' => $donationCode,
                'donation_name' => $request->name ?: 'Hamba Allah',
                'category_name' => $category->name,
                'amount' => $request->amount,
                'unique_code' => $uniqueCode,
                'total_amount' => $totalAmount,
                'payment_method' => 'transfer_qris',
                'qris_image_url' => $qrisImageUrl,
                'bank_name' => $setting->bank_name ?? null,
                'account_number' => $setting->account_number ?? null,
                'account_name' => $setting->account_name ?? null,
            ]
        ]);
    }
}
