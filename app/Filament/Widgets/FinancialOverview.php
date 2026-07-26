<?php

namespace App\Filament\Widgets;

use App\Models\DonationTransaction;
use App\Models\ExpenseTransaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalMasuk     = DonationTransaction::where('status', 'success')->sum('total_amount');
        $totalKeluar    = ExpenseTransaction::sum('amount');
        $totalSaldo     = $totalMasuk - $totalKeluar;

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

        return [
            Stat::make('Total Saldo Aktif', 'Rp ' . number_format($totalSaldo, 0, ',', '.'))
                ->description('Semua pemasukan dikurangi pengeluaran')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($totalSaldo >= 0 ? 'success' : 'danger'),

            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalMasuk, 0, ',', '.'))
                ->description('Akumulasi donasi sukses')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalKeluar, 0, ',', '.'))
                ->description('Akumulasi kas keluar')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Saldo Bulan Ini', 'Rp ' . number_format($saldoBulanIni, 0, ',', '.'))
                ->description('Masuk - Keluar ' . now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color($saldoBulanIni >= 0 ? 'warning' : 'danger'),
        ];
    }
}
