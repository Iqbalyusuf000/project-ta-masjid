<?php

namespace App\Http\Controllers;

use App\Models\DonationTransaction;
use App\Models\ExpenseTransaction;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FinancialReportController extends Controller
{
    public function index()
    {
        // ================================================================
        // 4 CARDS RINGKASAN & PERSENTASE
        // ================================================================
        $totalMasuk     = DonationTransaction::where('status', 'success')->sum('total_amount');
        $totalKeluar    = ExpenseTransaction::sum('amount');
        $totalSaldo     = $totalMasuk - $totalKeluar;

        $yesterday      = now()->subDay()->endOfDay();
        $totalMasukKemarin = DonationTransaction::where('status', 'success')->where('created_at', '<=', $yesterday)->sum('total_amount');
        $totalKeluarKemarin = ExpenseTransaction::where('created_at', '<=', $yesterday)->sum('amount');
        $totalSaldoKemarin = $totalMasukKemarin - $totalKeluarKemarin;

        $pctPemasukan = $totalMasukKemarin > 0 ? (($totalMasuk - $totalMasukKemarin) / $totalMasukKemarin) * 100 : ($totalMasuk > 0 ? 100 : 0);
        $pctPengeluaran = $totalKeluarKemarin > 0 ? (($totalKeluar - $totalKeluarKemarin) / $totalKeluarKemarin) * 100 : ($totalKeluar > 0 ? 100 : 0);
        $pctSaldoAktif = $totalSaldoKemarin != 0 ? (($totalSaldo - $totalSaldoKemarin) / abs($totalSaldoKemarin)) * 100 : ($totalSaldo > 0 ? 100 : 0);

        // Bulan Ini vs Bulan Lalu
        $bulanIni       = now()->month;
        $tahunIni       = now()->year;
        $masukBulanIni  = DonationTransaction::where('status', 'success')
                            ->whereMonth('created_at', $bulanIni)
                            ->whereYear('created_at', $tahunIni)
                            ->sum('total_amount');
        $keluarBulanIni = ExpenseTransaction::whereMonth('expense_date', $bulanIni)
                            ->whereYear('expense_date', $tahunIni)
                            ->sum('amount');
        $saldoBulanIni  = $masukBulanIni - $keluarBulanIni;

        $bulanLalu = now()->subMonth()->month;
        $tahunBulanLalu = now()->subMonth()->year;
        $masukBulanLalu = DonationTransaction::where('status', 'success')
                            ->whereMonth('created_at', $bulanLalu)
                            ->whereYear('created_at', $tahunBulanLalu)
                            ->sum('total_amount');
        $keluarBulanLalu = ExpenseTransaction::whereMonth('expense_date', $bulanLalu)
                            ->whereYear('expense_date', $tahunBulanLalu)
                            ->sum('amount');
        $saldoBulanLalu = $masukBulanLalu - $keluarBulanLalu;

        $pctSaldoBulanIni = $saldoBulanLalu != 0 ? (($saldoBulanIni - $saldoBulanLalu) / abs($saldoBulanLalu)) * 100 : ($saldoBulanIni > 0 ? 100 : 0);

        // ================================================================
        // LINE CHART DATA (today / week / month)
        // ================================================================
        $lineChartData = [
            'today' => $this->getLineToday(),
            'week'  => $this->getLineWeek(),
            'month' => $this->getLineMonth(),
        ];

        // ================================================================
        // BAR CHART DATA (Januari - Desember tahun berjalan)
        // ================================================================
        $barLabels   = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
        $barMasuk    = [];
        $barKeluar   = [];
        for ($m = 1; $m <= 12; $m++) {
            $barMasuk[]  = (int) DonationTransaction::where('status', 'success')
                                ->whereMonth('created_at', $m)
                                ->whereYear('created_at', $tahunIni)
                                ->sum('total_amount');
            $barKeluar[] = (int) ExpenseTransaction::whereMonth('expense_date', $m)
                                ->whereYear('expense_date', $tahunIni)
                                ->sum('amount');
        }
        $barChartData = [
            'labels' => $barLabels,
            'masuk'  => $barMasuk,
            'keluar' => $barKeluar,
        ];

        // ================================================================
        // PIE CHART DATA (distribusi pengeluaran per kategori)
        // ================================================================
        $pieRaw = ExpenseTransaction::select('category', DB::raw('SUM(amount) as total'))
                    ->groupBy('category')
                    ->get();
        $pieChartData = [
            'labels' => $pieRaw->pluck('category')->map(fn ($v) => ucfirst($v))->toArray(),
            'data'   => $pieRaw->pluck('total')->map(fn ($v) => (int) $v)->toArray(),
        ];

        // ================================================================
        // TABEL MUTASI (UNION 10 terakhir)
        // ================================================================
        $mutasi = $this->getMutasi();

        return view('pages.financial-report', compact(
            'totalMasuk',
            'totalKeluar',
            'totalSaldo',
            'saldoBulanIni',
            'lineChartData',
            'barChartData',
            'pieChartData',
            'mutasi',
            'tahunIni',
            'pctSaldoAktif',
            'pctPemasukan',
            'pctPengeluaran',
            'pctSaldoBulanIni'
        ));
    }

    // ----------------------------------------------------------------
    // LINE CHART: Hari Ini (per 4 jam)
    // ----------------------------------------------------------------
    private function getLineToday(): array
    {
        $labels = ['00:00','04:00','08:00','12:00','16:00','20:00'];
        $masuk  = [];
        $keluar = [];

        $ranges = [
            [0, 4], [4, 8], [8, 12], [12, 16], [16, 20], [20, 24],
        ];

        foreach ($ranges as [$from, $to]) {
            $masuk[] = (int) DonationTransaction::where('status', 'success')
                ->whereDate('created_at', today())
                ->whereTime('created_at', '>=', sprintf('%02d:00:00', $from))
                ->whereTime('created_at', '<', sprintf('%02d:00:00', $to))
                ->sum('total_amount');

            $keluar[] = (int) ExpenseTransaction::whereDate('expense_date', today())
                ->get()
                ->filter(function ($item) use ($from, $to) {
                    $hour = Carbon::parse($item->created_at)->hour;
                    return $hour >= $from && $hour < $to;
                })
                ->sum('amount');
        }

        return ['labels' => $labels, 'masuk' => $masuk, 'keluar' => $keluar];
    }

    // ----------------------------------------------------------------
    // LINE CHART: 7 Hari Terakhir
    // ----------------------------------------------------------------
    private function getLineWeek(): array
    {
        $labels = [];
        $masuk  = [];
        $keluar = [];

        for ($i = 6; $i >= 0; $i--) {
            $date     = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->translatedFormat('D, d M');

            $masuk[]  = (int) DonationTransaction::where('status', 'success')
                            ->whereDate('created_at', $date)->sum('total_amount');
            $keluar[] = (int) ExpenseTransaction::whereDate('expense_date', $date)->sum('amount');
        }

        return ['labels' => $labels, 'masuk' => $masuk, 'keluar' => $keluar];
    }

    // ----------------------------------------------------------------
    // LINE CHART: Bulan Berjalan (per tanggal)
    // ----------------------------------------------------------------
    private function getLineMonth(): array
    {
        $daysInMonth = now()->daysInMonth;
        $labels      = [];
        $masuk       = [];
        $keluar      = [];

        for ($d = 1; $d <= $daysInMonth; $d++) {
            $date     = now()->format('Y-m-') . sprintf('%02d', $d);
            $labels[] = $d;

            $masuk[]  = (int) DonationTransaction::where('status', 'success')
                            ->whereDate('created_at', $date)->sum('total_amount');
            $keluar[] = (int) ExpenseTransaction::whereDate('expense_date', $date)->sum('amount');
        }

        return ['labels' => $labels, 'masuk' => $masuk, 'keluar' => $keluar];
    }

    // ----------------------------------------------------------------
    // TABEL MUTASI: Union masuk + keluar, 10 terakhir
    // ----------------------------------------------------------------
    private function getMutasi(): array
    {
        // Query masuk
        $masukQuery = DonationTransaction::query()
            ->where('status', 'success')
            ->join('donation_categories', 'donation_transactions.donation_category_id', '=', 'donation_categories.id')
            ->select(
                'donation_transactions.id',
                DB::raw("'masuk' as tipe"),
                DB::raw("donation_categories.name as keterangan"),
                'donation_transactions.total_amount as nominal',
                DB::raw("DATE(donation_transactions.created_at) as tanggal"),
                DB::raw("donation_transactions.created_at as sort_at")
            );

        // Query keluar (UNION)
        $keluar = DB::table('expense_transactions')
            ->select(
                'id',
                DB::raw("'keluar' as tipe"),
                DB::raw("title as keterangan"),
                DB::raw("amount as nominal"),
                DB::raw("expense_date as tanggal"),
                DB::raw("created_at as sort_at")
            )
            ->whereNull('deleted_at');

        $mutasi = $masukQuery->toBase()
            ->union($keluar)
            ->orderByDesc('sort_at')
            ->limit(10)
            ->get();

        return $mutasi->toArray();
    }
}
