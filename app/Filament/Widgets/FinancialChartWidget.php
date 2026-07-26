<?php

namespace App\Filament\Widgets;

use App\Models\DonationTransaction;
use App\Models\ExpenseTransaction;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class FinancialChartWidget extends ChartWidget
{
    protected ?string $heading = 'Tren Keuangan';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected ?string $maxHeight = '300px';

    public ?string $filter = 'week';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Hari Ini',
            'week'  => 'Seminggu Terakhir',
            'month' => 'Bulan Ini',
        ];
    }

    protected function getData(): array
    {
        return match ($this->filter) {
            'today' => $this->getToday(),
            'month' => $this->getMonth(),
            default => $this->getWeek(),
        };
    }

    protected function getType(): string
    {
        return 'line';
    }

    // -------------------------------------------------------
    private function getToday(): array
    {
        $labels = ['00:00','04:00','08:00','12:00','16:00','20:00'];
        $ranges = [[0,4],[4,8],[8,12],[12,16],[16,20],[20,24]];
        $masuk  = [];
        $keluar = [];

        foreach ($ranges as [$from, $to]) {
            $masuk[]  = (int) DonationTransaction::where('status', 'success')
                ->whereDate('created_at', today())
                ->whereTime('created_at', '>=', sprintf('%02d:00:00', $from))
                ->whereTime('created_at', '<',  sprintf('%02d:00:00', $to))
                ->sum('total_amount');

            $keluar[] = (int) ExpenseTransaction::whereDate('expense_date', today())
                ->get()
                ->filter(fn ($i) => Carbon::parse($i->created_at)->hour >= $from && Carbon::parse($i->created_at)->hour < $to)
                ->sum('amount');
        }

        return $this->buildDataset($labels, $masuk, $keluar);
    }

    private function getWeek(): array
    {
        $labels = [];
        $masuk  = [];
        $keluar = [];

        for ($i = 6; $i >= 0; $i--) {
            $date     = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->format('d M');
            $masuk[]  = (int) DonationTransaction::where('status','success')->whereDate('created_at', $date)->sum('total_amount');
            $keluar[] = (int) ExpenseTransaction::whereDate('expense_date', $date)->sum('amount');
        }

        return $this->buildDataset($labels, $masuk, $keluar);
    }

    private function getMonth(): array
    {
        $daysInMonth = now()->daysInMonth;
        $labels = [];
        $masuk  = [];
        $keluar = [];

        for ($d = 1; $d <= $daysInMonth; $d++) {
            $date     = now()->format('Y-m-') . sprintf('%02d', $d);
            $labels[] = $d;
            $masuk[]  = (int) DonationTransaction::where('status','success')->whereDate('created_at', $date)->sum('total_amount');
            $keluar[] = (int) ExpenseTransaction::whereDate('expense_date', $date)->sum('amount');
        }

        return $this->buildDataset($labels, $masuk, $keluar);
    }

    private function buildDataset(array $labels, array $masuk, array $keluar): array
    {
        return [
            'datasets' => [
                [
                    'label'           => 'Pemasukan',
                    'data'            => $masuk,
                    'borderColor'     => '#D4AF37',
                    'backgroundColor' => 'rgba(212,175,55,0.15)',
                    'fill'            => true,
                    'tension'         => 0.4,
                ],
                [
                    'label'           => 'Pengeluaran',
                    'data'            => $keluar,
                    'borderColor'     => '#0F172A',
                    'backgroundColor' => 'rgba(15,23,42,0.1)',
                    'fill'            => true,
                    'tension'         => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
