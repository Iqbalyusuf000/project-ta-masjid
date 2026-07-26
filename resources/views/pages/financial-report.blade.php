@extends('layouts.app')

@section('title', 'Laporan Keuangan Masjid Al-Kautsar')
@section('description', 'Transparansi pengelolaan keuangan Masjid Al-Kautsar — ringkasan saldo, tren pemasukan & pengeluaran, dan riwayat mutasi terbaru.')

@section('content')
    <div x-data="financialReportData()" x-init="initLineChart()">

        {{-- ================================================================
        HERO SECTION
        ================================================================ --}}
        <section class="relative bg-secondary text-white overflow-hidden py-14 md:py-20">
            <div class="absolute inset-0 opacity-5 pointer-events-none">
                <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full bg-primary blur-3xl"></div>
                <div class="absolute bottom-0 right-1/4 w-72 h-72 rounded-full bg-primary blur-3xl"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <span
                    class="inline-block bg-primary/15 text-primary font-semibold text-xs uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">
                    Transparansi Keuangan
                </span>
                <h1 class="font-display font-bold text-3xl md:text-5xl text-white leading-tight mb-3">
                    Laporan <span class="text-primary">Pengelolaan Keuangan</span>
                </h1>
                <p class="text-white/70 text-sm md:text-base max-w-2xl mx-auto">
                    Kami berkomitmen mengelola amanah jamaah dengan transparan dan akuntabel.<br>Berikut rekap keuangan
                    Masjid
                    Al-Kautsar secara lengkap.
                </p>
                <p class="text-white/40 text-xs mt-3">Tahun {{ $tahunIni }}</p>
            </div>
        </section>

        {{-- ================================================================
        SECTION 1: 4 CARDS RINGKASAN
        ================================================================ --}}
        <section class="bg-slate-50 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    {{-- Saldo Aktif --}}
                    <div
                        class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col gap-3 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total Saldo
                                Aktif</span>
                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">
                                <iconify-icon icon="mdi:bank-outline" class="text-xl text-primary"></iconify-icon>
                            </div>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-secondary">
                                Rp {{ number_format($totalSaldo, 0, ',', '.') }}
                            </p>
                            <p class="text-xs mt-1 flex items-center gap-1">
                                @if($pctSaldoAktif > 0)
                                    <span class="text-green-500 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-up"></iconify-icon>
                                        {{ number_format($pctSaldoAktif, 1, ',', '.') }}%</span>
                                @elseif($pctSaldoAktif < 0)
                                    <span class="text-red-500 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-down"></iconify-icon>
                                        {{ number_format(abs($pctSaldoAktif), 1, ',', '.') }}%</span>
                                @else
                                    <span class="text-slate-400 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:minus"></iconify-icon> 0%</span>
                                @endif
                                <span class="text-slate-400">dari hari lalu</span>
                            </p>
                        </div>
                    </div>

                    {{-- Total Pemasukan --}}
                    <div
                        class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col gap-3 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total Pemasukan</span>
                            <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center">
                                <iconify-icon icon="mdi:trending-up" class="text-xl text-green-600"></iconify-icon>
                            </div>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-green-600">
                                Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                            </p>
                            <p class="text-xs mt-1 flex items-center gap-1">
                                @if($pctPemasukan > 0)
                                    <span class="text-green-500 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-up"></iconify-icon>
                                        {{ number_format($pctPemasukan, 1, ',', '.') }}%</span>
                                @elseif($pctPemasukan < 0)
                                    <span class="text-red-500 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-down"></iconify-icon>
                                        {{ number_format(abs($pctPemasukan), 1, ',', '.') }}%</span>
                                @else
                                    <span class="text-slate-400 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:minus"></iconify-icon> 0%</span>
                                @endif
                                <span class="text-slate-400">dari hari lalu</span>
                            </p>
                        </div>
                    </div>

                    {{-- Total Pengeluaran --}}
                    <div
                        class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 flex flex-col gap-3 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-400">Total
                                Pengeluaran</span>
                            <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                                <iconify-icon icon="mdi:trending-down" class="text-xl text-red-500"></iconify-icon>
                            </div>
                        </div>
                        <div>
                            <p class="text-2xl font-black text-red-500">
                                Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                            </p>
                            <p class="text-xs mt-1 flex items-center gap-1">
                                @if($pctPengeluaran > 0)
                                    <span class="text-red-500 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-up"></iconify-icon>
                                        {{ number_format($pctPengeluaran, 1, ',', '.') }}%</span>
                                @elseif($pctPengeluaran < 0)
                                    <span class="text-green-500 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-down"></iconify-icon>
                                        {{ number_format(abs($pctPengeluaran), 1, ',', '.') }}%</span>
                                @else
                                    <span class="text-slate-400 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:minus"></iconify-icon> 0%</span>
                                @endif
                                <span class="text-slate-400">dari hari lalu</span>
                            </p>
                        </div>
                    </div>

                    {{-- Saldo Bulan Ini --}}
                    <div
                        class="bg-gradient-to-br from-secondary to-slate-700 rounded-2xl shadow-sm p-6 flex flex-col gap-3 hover:shadow-md transition-all">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-widest text-white/50">Saldo Bulan Ini</span>
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                                <iconify-icon icon="mdi:calendar-month-outline" class="text-xl text-primary"></iconify-icon>
                            </div>
                        </div>
                        <div>
                            <p class="text-2xl font-black {{ $saldoBulanIni >= 0 ? 'text-primary' : 'text-red-400' }}">
                                Rp {{ number_format($saldoBulanIni, 0, ',', '.') }}
                            </p>
                            <p class="text-xs mt-1 flex items-center gap-1">
                                @if($pctSaldoBulanIni > 0)
                                    <span class="text-green-400 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-up"></iconify-icon>
                                        {{ number_format($pctSaldoBulanIni, 1, ',', '.') }}%</span>
                                @elseif($pctSaldoBulanIni < 0)
                                    <span class="text-red-400 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:trending-down"></iconify-icon>
                                        {{ number_format(abs($pctSaldoBulanIni), 1, ',', '.') }}%</span>
                                @else
                                    <span class="text-white/50 font-semibold flex items-center"><iconify-icon
                                            icon="mdi:minus"></iconify-icon> 0%</span>
                                @endif
                                <span class="text-white/40">dari bulan lalu</span>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ================================================================
        SECTION 2: LINE CHART TREN (dengan Alpine.js filter)
        ================================================================ --}}
        <section class="bg-white py-12 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <div>
                        <h2 class="font-display font-bold text-xl sm:text-2xl text-secondary">Tren Pemasukan & Pengeluaran
                        </h2>
                        <p class="text-slate-500 text-sm mt-1">Perbandingan pemasukan dan pengeluaran Masjid Al Kautsar
                            Cempolorejo</p>
                    </div>
                    {{-- Filter Buttons --}}
                    <div class="flex gap-2 bg-slate-100 p-1 rounded-xl shrink-0">
                        <button @click="switchFilter('today')" :class="activeFilter === 'today'
                                                ? 'bg-white text-secondary shadow-sm font-bold'
                                                : 'text-slate-500 hover:text-secondary'"
                            class="px-4 py-2 rounded-lg text-sm transition-all duration-200">
                            Hari Ini
                        </button>
                        <button @click="switchFilter('week')" :class="activeFilter === 'week'
                                                ? 'bg-white text-secondary shadow-sm font-bold'
                                                : 'text-slate-500 hover:text-secondary'"
                            class="px-4 py-2 rounded-lg text-sm transition-all duration-200">
                            Seminggu
                        </button>
                        <button @click="switchFilter('month')" :class="activeFilter === 'month'
                                                ? 'bg-white text-secondary shadow-sm font-bold'
                                                : 'text-slate-500 hover:text-secondary'"
                            class="px-4 py-2 rounded-lg text-sm transition-all duration-200">
                            Sebulan
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5" style="height: 350px;">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </section>

        {{-- ================================================================
        SECTION 3 & 4: BAR CHART + PIE CHART (2 kolom)
        ================================================================ --}}
        <section class="bg-slate-50 py-12 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- BAR CHART (span 2) --}}
                    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <h2 class="font-display font-bold text-lg text-secondary mb-1">Komparasi Bulanan {{ $tahunIni }}
                        </h2>
                        <p class="text-xs text-slate-400 mb-5">Pemasukan (Warna emas) vs Pengeluaran (Warna abu-abu) Jan–Des
                        </p>
                        <div style="height: 300px;">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>

                    {{-- PIE / DOUGHNUT CHART --}}
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <h2 class="font-display font-bold text-lg text-secondary mb-1">Distribusi Pengeluaran</h2>
                        <p class="text-xs text-slate-400 mb-5">Berdasarkan seluruh kategori</p>
                        @if(count($pieChartData['data']) > 0)
                            <div style="height: 260px;" class="flex items-center justify-center">
                                <canvas id="pieChart"></canvas>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center h-60 text-center text-slate-400">
                                <iconify-icon icon="mdi:chart-pie-outline" class="text-5xl mb-3 opacity-30"></iconify-icon>
                                <p class="text-sm">Belum ada data pengeluaran</p>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </section>

        {{-- ================================================================
        SECTION 5: TABEL MUTASI
        ================================================================ --}}
        <section class="bg-white py-12 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-8">
                    <h2 class="font-display font-bold text-xl sm:text-2xl text-secondary">Riwayat Transaksi Terbaru</h2>
                    <p class="text-slate-500 text-sm mt-1">Transaksi pemasukan & pengeluaran terakhir</p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    @if(count($mutasi) > 0)
                        {{-- Desktop Table --}}
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200">
                                        <th
                                            class="text-left px-5 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="text-left px-5 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider">
                                            Keterangan</th>
                                        <th
                                            class="text-center px-5 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider">
                                            Tipe</th>
                                        <th
                                            class="text-right px-5 py-4 font-semibold text-slate-500 uppercase text-xs tracking-wider">
                                            Nominal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($mutasi as $row)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-5 py-4 text-slate-500 whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($row->tanggal)->translatedFormat('d M Y') }}
                                            </td>
                                            <td class="px-5 py-4 text-slate-800 font-medium max-w-xs truncate">
                                                {{ $row->keterangan }}
                                            </td>
                                            <td class="px-5 py-4 text-center">
                                                @if($row->tipe === 'masuk')
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-green-50 text-green-700 border border-green-200 text-xs font-bold px-3 py-1 rounded-full">
                                                        <iconify-icon icon="mdi:arrow-down-circle" class="text-sm"></iconify-icon> Masuk
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1 bg-red-50 text-red-600 border border-red-200 text-xs font-bold px-3 py-1 rounded-full">
                                                        <iconify-icon icon="mdi:arrow-up-circle" class="text-sm"></iconify-icon> Keluar
                                                    </span>
                                                @endif
                                            </td>
                                            <td
                                                class="px-5 py-4 text-right font-bold {{ $row->tipe === 'masuk' ? 'text-green-600' : 'text-red-500' }} whitespace-nowrap">
                                                {{ $row->tipe === 'masuk' ? '+' : '-' }} Rp
                                                {{ number_format($row->nominal, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-16 text-slate-400">
                            <iconify-icon icon="mdi:swap-horizontal-circle-outline"
                                class="text-6xl mb-4 opacity-30"></iconify-icon>
                            <p class="font-semibold">Belum ada riwayat mutasi</p>
                            <p class="text-xs mt-1">Transaksi akan muncul di sini secara otomatis</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </div>{{-- end x-data --}}

    {{-- Chart.js Scripts --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
        <script>
            function financialReportData() {
                let chartInstance = null;
                
                return {
                    activeFilter: 'week',
                    lineData: @json($lineChartData),

                    initLineChart() {
                        const ctx = document.getElementById('lineChart').getContext('2d');
                        const d = this.lineData[this.activeFilter];
                        chartInstance = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: d.labels,
                                datasets: [
                                    {
                                        label: 'Pemasukan',
                                        data: d.masuk,
                                        borderColor: '#D4AF37',
                                        backgroundColor: 'rgba(212,175,55,0.12)',
                                        borderWidth: 2.5,
                                        pointRadius: 4,
                                        pointBackgroundColor: '#D4AF37',
                                        fill: true,
                                        tension: 0.4,
                                    },
                                    {
                                        label: 'Pengeluaran',
                                        data: d.keluar,
                                        borderColor: '#0F172A',
                                        backgroundColor: 'rgba(15,23,42,0.08)',
                                        borderWidth: 2.5,
                                        pointRadius: 4,
                                        pointBackgroundColor: '#0F172A',
                                        fill: true,
                                        tension: 0.4,
                                    },
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                interaction: { mode: 'index', intersect: false },
                                plugins: {
                                    legend: { position: 'top' },
                                    tooltip: {
                                        callbacks: {
                                            label: function (ctx) {
                                                return ' ' + ctx.dataset.label + ': Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function (value) {
                                                if (value >= 1000000) return 'Rp ' + (value / 1000000).toFixed(1) + ' Jt';
                                                if (value >= 1000) return 'Rp ' + (value / 1000).toFixed(0) + ' Rb';
                                                return 'Rp ' + value;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    },

                    switchFilter(filter) {
                        this.activeFilter = filter;
                        const d = this.lineData[filter];
                        chartInstance.data.labels = d.labels;
                        chartInstance.data.datasets[0].data = d.masuk;
                        chartInstance.data.datasets[1].data = d.keluar;
                        chartInstance.update();
                    },

                    formatRupiah(num) {
                        return 'Rp ' + Number(num).toLocaleString('id-ID');
                    }
                };
            }

            document.addEventListener('DOMContentLoaded', function () {


                // BAR CHART
                const barCtx = document.getElementById('barChart');
                if (barCtx) {
                    const barData = @json($barChartData);
                    new Chart(barCtx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: barData.labels,
                            datasets: [
                                {
                                    label: 'Pemasukan',
                                    data: barData.masuk,
                                    backgroundColor: 'rgba(212,175,55,0.80)',
                                    borderColor: '#D4AF37',
                                    borderWidth: 1,
                                    borderRadius: 6,
                                },
                                {
                                    label: 'Pengeluaran',
                                    data: barData.keluar,
                                    backgroundColor: 'rgba(15,23,42,0.65)',
                                    borderColor: '#0F172A',
                                    borderWidth: 1,
                                    borderRadius: 6,
                                },
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: { mode: 'index', intersect: false },
                            plugins: {
                                legend: { position: 'top' },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => ' ' + ctx.dataset.label + ': Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: v => {
                                            if (v >= 1000000) return 'Rp ' + (v / 1000000).toFixed(1) + ' Jt';
                                            if (v >= 1000) return 'Rp ' + (v / 1000).toFixed(0) + ' Rb';
                                            return 'Rp ' + v;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }

                // PIE / DOUGHNUT CHART
                const pieCtx = document.getElementById('pieChart');
                if (pieCtx) {
                    const pieData = @json($pieChartData);
                    const pieColors = ['#D4AF37', '#0F172A', '#3B82F6', '#10B981', '#F97316', '#8B5CF6'];
                    new Chart(pieCtx.getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: pieData.labels,
                            datasets: [{
                                data: pieData.data,
                                backgroundColor: pieColors.slice(0, pieData.labels.length),
                                borderColor: '#fff',
                                borderWidth: 3,
                                hoverOffset: 8,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            cutout: '60%',
                            plugins: {
                                legend: { position: 'bottom', labels: { padding: 14, boxWidth: 14 } },
                                tooltip: {
                                    callbacks: {
                                        label: ctx => ' Rp ' + ctx.parsed.toLocaleString('id-ID')
                                    }
                                }
                            }
                        }
                    });
                }
            });
        </script>
    @endpush

@endsection