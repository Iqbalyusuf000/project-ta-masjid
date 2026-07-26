@extends('layouts.app')

@section('title', 'Beranda — Masjid Al-Kautsar Cempolorejo')
@section('description', 'Masjid Al-Kautsar Cempolorejo — Pusat dakwah, ukhuwah, dan peradaban umat Islam di Semarang Barat.')

@push('preloads')
    <link rel="preload" href="{{ asset('images/masjid-alkautsar.webp') }}" as="image" type="image/webp" fetchpriority="high">
@endpush

@push('styles')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.55;
            }
        }

        @keyframes scrollX {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease both;
        }

        .animate-fadeIn {
            animation: fadeIn 1.2s ease both;
        }

        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        .delay-600 {
            animation-delay: 0.6s;
        }

        .hero-overlay {
            background: linear-gradient(to bottom, rgba(10, 10, 10, 0.55) 0%, rgba(10, 10, 10, 0.75) 60%, rgba(10, 10, 10, 0.92) 100%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .glass-dark {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .program-card:hover {
            transform: translateY(-6px);
        }

        .section-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .section-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Testimonial ticker */
        .ticker-wrap {
            overflow: hidden;
        }

        .ticker-track {
            display: flex;
            gap: 1.5rem;
            width: max-content;
            animation: scrollX 40s linear infinite;
        }

        .ticker-track:hover {
            animation-play-state: paused;
        }
    </style>
@endpush

@section('content')

    {{-- ================================================================
    SECTION 1: HERO
    ================================================================ --}}
    <section class="relative min-h-screen flex flex-col justify-end overflow-hidden" id="hero">

        {{-- Background --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/masjid-alkautsar.webp') }}" alt="Masjid Al-Kautsar"
                fetchpriority="high" loading="eager" decoding="sync"
                class="w-full h-full object-cover scale-105 transition-transform duration-[8s] ease-in-out" id="hero-bg">
            <div class="absolute inset-0 hero-overlay"></div>
        </div>

        {{-- Decorative gold accent top --}}
        <div
            class="absolute top-0 left-0 right-0 h-1 bg-linear-to-r from-transparent via-yellow-500 to-transparent opacity-70">
        </div>

        {{-- Hero Copy --}}
        <div class="relative z-10 flex flex-col items-center text-center px-4 pt-36 pb-16 md:pb-20">
            <span
                class="animate-fadeInUp delay-100 inline-flex items-center gap-2 text-yellow-400 text-xs font-bold uppercase tracking-[0.25em] mb-5">
                <span class="w-8 h-px bg-yellow-400/60"></span>
                Dakwah · Ukhuwah · Together to Jannah
                <span class="w-8 h-px bg-yellow-400/60"></span>
            </span>

            <h1
                class="animate-fadeInUp delay-200 font-raleway font-bold text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl leading-tight mb-6 drop-shadow-xl">
                Masjid <span class="text-yellow-400">Al-Kautsar</span><br>Cempolorejo
            </h1>

            {{-- Rotating Ayat / Hadits --}}
            <div class="animate-fadeInUp delay-300 mb-10 min-h-14" x-data="{
                                                                    quotes: [
                                                                        'إِنَّمَا يَعْمُرُ مَسَاجِدَ اللَّهِ مَنْ آمَنَ بِاللَّهِ — QS At-Taubah: 18',
                                                                        'وَمَنْ أَحْسَنُ قَوْلًا مِمَّنْ دَعَا إِلَى اللَّهِ — QS Fushilat: 33',
                                                                        'النَّاسُ كَمَعَادِنِ الذَّهَبِ وَالْفِضَّةِ — HR Muslim',
                                                                    ],
                                                                    current: 0,
                                                                    init() { setInterval(() => this.current = (this.current + 1) % this.quotes.length, 4000) }
                                                                }">
                <template x-for="(q, i) in quotes" :key="i">
                    <p x-show="current === i" x-transition:enter="transition ease-out duration-700"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="text-white/80 italic text-base md:text-lg font-light max-w-2xl mx-auto" x-text="q">
                    </p>
                </template>
            </div>

            {{-- CTA Buttons --}}
            <div class="animate-fadeInUp delay-400 flex flex-wrap gap-3 justify-center mb-16">
                <a href="{{ route('kajian') }}"
                    class="px-7 py-3 bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold rounded-full text-sm transition-all duration-200 shadow-lg shadow-yellow-500/30 hover:shadow-yellow-400/50 hover:-translate-y-0.5">
                    <iconify-icon icon="mdi:calendar-star" class="mr-1"></iconify-icon>
                    Jadwal Kajian
                </a>
                <a href="{{ route('financial-report') }}"
                    class="px-7 py-3 glass text-white font-semibold rounded-full text-sm transition-all duration-200 hover:bg-white/15 hover:-translate-y-0.5">
                    <iconify-icon icon="mdi:chart-line" class="mr-1"></iconify-icon>
                    Laporan Keuangan
                </a>
            </div>

            {{-- ============================================================
            PRAYER TIME WIDGET (glassmorphism)
            ============================================================ --}}
            <div class="animate-fadeInUp delay-500 w-full max-w-4xl mx-auto" x-data="prayerWidget()" x-init="init()">
                <div class="glass rounded-2xl p-5 md:p-6">
                    {{-- Header row --}}
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-5">
                        <div>
                            <p class="text-yellow-400 text-xs font-bold uppercase tracking-widest mb-0.5">Jadwal Sholat</p>
                            <p class="text-white font-semibold text-base" x-text="todayLabel">Memuat tanggal...</p>
                        </div>
                        <div class="text-right">
                            <p class="text-white/50 text-xs mb-0.5">Sholat Berikutnya</p>
                            <p class="text-yellow-400 font-bold text-lg" x-text="nextPrayerLabel">—</p>
                            <p class="text-white/70 text-sm font-mono" x-text="countdown">00:00:00</p>
                        </div>
                    </div>

                    {{-- Prayer Times Grid --}}
                    <div class="grid grid-cols-5 gap-2 md:gap-3">
                        <template x-for="p in prayers" :key="p.name">
                            <div class="text-center rounded-xl py-3 px-1 transition-all duration-300" :class="p.name === nextPrayerName
                                                                                        ? 'bg-yellow-500/90 text-slate-900 shadow-lg shadow-yellow-500/30'
                                                                                        : 'bg-white/10 text-white'">
                                <iconify-icon :icon="p.icon" class="text-xl mb-1 block mx-auto"
                                    :class="p.name === nextPrayerName ? 'text-slate-900' : 'text-yellow-400'"></iconify-icon>
                                <p class="text-xs font-semibold uppercase tracking-wider mb-0.5" x-text="p.name"></p>
                                <p class="text-sm font-bold font-mono" x-text="p.time">--:--</p>
                            </div>
                        </template>
                    </div>

                    {{-- Loading state --}}
                    <p x-show="loading" class="text-white/40 text-center text-xs mt-3 animate-pulse-slow">Memuat jadwal
                        sholat Semarang...</p>
                </div>
            </div>
        </div>

        {{-- Scroll chevron --}}
        <div class="relative z-10 flex justify-center pb-6">
            <a href="#programs" class="text-white/40 hover:text-yellow-400 transition animate-bounce" aria-label="Scroll ke bagian program">
                <iconify-icon icon="mdi:chevron-double-down" class="text-3xl"></iconify-icon>
            </a>
        </div>
    </section>

    {{-- ================================================================
    SECTION 2: PROGRAM & LAYANAN UTAMA
    ================================================================ --}}
    <section id="programs" class="bg-slate-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-14 section-reveal">
                <span class="inline-block text-yellow-600 text-xs font-bold uppercase tracking-widest mb-3">
                    Layanan & Program
                </span>
                <h2 class="font-raleway font-bold text-slate-800 text-3xl md:text-4xl">
                    Apa yang Bisa Kamu Lakukan?
                </h2>
                <p class="text-slate-500 mt-3 max-w-xl mx-auto text-sm md:text-base">
                    Bergabunglah dalam berbagai program kebaikan dan layanan yang tersedia di Masjid Al-Kautsar.
                </p>
            </div>

            {{-- Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

                {{-- Zakat Fitrah --}}
                <a href="{{ route('zakat') }}"
                    class="program-card group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 p-6 text-center section-reveal delay-100 flex flex-col justify-between">
                    <div>
                        <div
                            class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/20 transition-colors">
                                <iconify-icon icon="mdi:hand-coin-outline" class="text-3xl text-tertiary"></iconify-icon>
                            </div>
                            <h3 class="font-raleway font-bold text-slate-800 text-base mb-2">Zakat Fitrah</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">Tunaikan zakat fitrah beras dengan mudah.</p>
                        </div>
                        <span
                            class="mt-4 inline-flex items-center justify-center gap-1 text-tertiary text-xs font-semibold group-hover:gap-2 transition-all">
                            Bayar <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                        </span>
                    </a>

                    {{-- I'tikaf Ramadhan --}}
                    <a href="{{ route('itikaf') }}"
                        class="program-card group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 p-6 text-center section-reveal delay-200 flex flex-col justify-between">
                        <div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-100 transition-colors">
                                <iconify-icon icon="mdi:moon-and-stars" class="text-3xl text-emerald-600"></iconify-icon>
                            </div>
                            <h3 class="font-raleway font-bold text-slate-800 text-base mb-2">I'tikaf</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">Daftar I'tikaf 10 hari terakhir Ramadhan.</p>
                        </div>
                        <span
                            class="mt-4 inline-flex items-center justify-center gap-1 text-emerald-600 text-xs font-semibold group-hover:gap-2 transition-all">
                            Daftar <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                        </span>
                    </a>

                    {{-- Kajian Islam --}}
                    <a href="{{ route('kajian') }}"
                        class="program-card group block bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 p-6 text-center section-reveal delay-300 flex flex-col justify-between">
                        <div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-sky-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-sky-100 transition-colors">
                                <iconify-icon icon="mdi:book-open-page-variant-outline"
                                    class="text-3xl text-sky-600"></iconify-icon>
                            </div>
                            <h3 class="font-raleway font-bold text-slate-800 text-base mb-2">Kajian Islam</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">Ikuti kajian rutin dan tematik bersama para
                                asatidz.</p>
                            </div>
                            <span
                                class="mt-4 inline-flex items-center justify-center gap-1 text-sky-600 text-xs font-semibold group-hover:gap-2 transition-all">
                                Lihat <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                            </span>
                        </a>

                        {{-- Isi Ulang Air --}}
                        <a href="{{ route('water-refill') }}"
                            class="program-card group block bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 p-6 text-center section-reveal delay-400 flex flex-col justify-between">
                            <div>
                                <div
                                    class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-100 transition-colors">
                                    <iconify-icon icon="mdi:water-outline" class="text-3xl text-blue-600"></iconify-icon>
                                </div>
                                <h3 class="font-raleway font-bold text-slate-800 text-base mb-2">Alka Tirta</h3>
                                <p class="text-slate-500 text-xs leading-relaxed">Layanan isi ulang air minum yang menyegarkan dan bersih.</p>
                            </div>
                            <span
                                class="mt-4 inline-flex items-center justify-center gap-1 text-blue-600 text-xs font-semibold group-hover:gap-2 transition-all">
                                Info <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                            </span>
                        </a>

                        {{-- Haji & Umroh --}}
                        <a href="{{ route('hajj') }}"
                            class="program-card group block bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 p-6 text-center section-reveal delay-500 flex flex-col justify-between">
                            <div>
                                <div
                                    class="w-14 h-14 rounded-2xl bg-[var(--color-cookies)]/10 flex items-center justify-center mx-auto mb-4 group-hover:bg-[var(--color-cookies)]/20 transition-colors">
                                    <iconify-icon icon="mdi:airplane-takeoff"
                                        class="text-3xl text-[var(--color-cookies)]"></iconify-icon>
                                </div>
                                <h3 class="font-raleway font-bold text-slate-800 text-base mb-2">Haji & Umroh</h3>
                                <p class="text-slate-500 text-xs leading-relaxed">Biro perjalanan ibadah terpercaya.</p>
                            </div>
                            <span
                                class="mt-4 inline-flex items-center justify-center gap-1 text-[var(--color-cookies)] text-xs font-semibold group-hover:gap-2 transition-all">
                                Info <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                            </span>
                        </a>

                    </div>
                </div>
            </section>

            {{-- ================================================================
            SECTION 2.5: PROGRAM INFAQ & SEDEKAH
            ================================================================ --}}
            <section class="py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-[var(--color-secondary)]/[0.03]">
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-14 section-reveal">
                        <span class=" text-yellow-600 ">Jariyah pilihan</span>
                            <h2 class="font-raleway font-extrabold text-3xl sm:text-4xl mt-2 text-[var(--color-secondary)]">Program Infaq & Sedekah</h2>
                            <p class="text-[var(--color-secondary)]/60 mt-3 max-w-xl mx-auto text-sm md:text-base">Pilih program yang ingin Anda dukung, setiap rupiah tersalurkan dengan amanah.</p>
                        </div>

                        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($programs as $p)
                                <div class="bg-white rounded-2xl border border-[var(--color-secondary)]/5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col section-reveal" style="animation-delay: {{ $loop->index * 0.1 }}s">
                                    <div class="p-6 pb-4 flex-1">
                                        <div class="flex items-start justify-between">
                                            <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-[var(--color-primary)]/10 text-[var(--color-primary)] text-2xl">
                                                <iconify-icon icon="{{ $p->icon ?? 'mdi:mosque' }}"></iconify-icon>
                                            </span>
                                            @if($p->badge)
                                                <span class="text-[11px] font-raleway font-bold tracking-wide bg-[var(--color-cookies)]/10 text-[var(--color-cookies)] px-2.5 py-1 rounded-full flex items-center gap-1">
                                                    <iconify-icon icon="mdi:alert-circle-outline"></iconify-icon>{{ $p->badge }}
                                                </span>
                                            @endif
                                        </div>
                                        <h3 class="font-raleway font-bold text-lg mt-4 text-[var(--color-secondary)]">{{ $p->name }}</h3>
                                        <p class="text-[var(--color-secondary)]/60 text-sm mt-2 leading-relaxed">{{ $p->description }}</p>
                                    </div>

                                    <div class="px-6 pb-6">
                                        @php 
                                                                                                                                            $terkumpul = $p->donationTransactions()->where('status', 'success')->sum('amount');
                                            $target = $p->target_amount ?: 1;
                                            $percent = min(100, round(($terkumpul / $target) * 100)); 
                                        @endphp
                                        <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">
                                            <div class="h-full rounded-full bg-gradient-to-r from-[var(--color-primary)] to-[var(--color-tertiary)]" style="width: {{ $percent }}%"></div>
                                        </div>
                                        <div class="flex justify-between items-center mt-2.5 text-xs font-raleway">
                                            <span class="text-[var(--color-secondary)] font-bold">Rp {{ number_format($terkumpul, 0, ',', '.') }}</span>
                                            <span class="text-[var(--color-secondary)]/50">{{ $percent }}% dari Rp {{ number_format($p->target_amount, 0, ',', '.') }}</span>
                                        </div>
                                        <a href="{{ route('zakat') }}#program" class="mt-4 w-full inline-flex items-center justify-center gap-2 border border-[var(--color-secondary)]/15 hover:bg-[var(--color-secondary)] hover:text-[var(--color-neutral)] hover:border-[var(--color-secondary)] font-raleway font-semibold text-sm py-2.5 rounded-full transition-colors text-[var(--color-secondary)]">
                                            Salurkan Donasi
                                            <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- ================================================================
                SECTION 2.6: FORM INFAQ CEPAT
                ================================================================ --}}
                <section class="bg-white py-16 border-t border-slate-100" x-data="infaqForm()">
                    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                        <div class="bg-slate-50 rounded-3xl p-8 md:p-10 border border-slate-100 shadow-sm section-reveal">
                            <div class="text-center mb-8">
                                <iconify-icon icon="mdi:hand-heart" class="text-5xl text-[var(--color-primary)] mb-3"></iconify-icon>
                                <h2 class="font-raleway font-bold text-2xl text-[var(--color-secondary)]">Mulai Kebaikan Hari Ini</h2>
                                <p class="text-[var(--color-secondary)]/60 mt-2 text-sm">Salurkan infaq dan sedekah Anda dengan mudah dan cepat melalui form di bawah ini.</p>
                            </div>

                            <form @submit.prevent="submitForm" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Nama --}}
                                    <div>
                                        <label for="donor_name" class="block text-sm font-semibold text-[var(--color-secondary)] mb-2">Nama Lengkap (Opsional)</label>
                                        <input type="text" id="donor_name" x-model="formData.name" placeholder="Hamba Allah" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[var(--color-primary)] focus:ring focus:ring-[var(--color-primary)]/20 transition-all text-sm">
                                    </div>

                                    {{-- Kategori --}}
                                    <div>
                                        <label for="donation_category_id" class="block text-sm font-semibold text-[var(--color-secondary)] mb-2">Kategori Infaq</label>
                                        <select id="donation_category_id" x-model="formData.donation_category_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[var(--color-primary)] focus:ring focus:ring-[var(--color-primary)]/20 transition-all text-sm">
                                            <option value="" disabled selected>Pilih Kategori...</option>
                                            @foreach($programs as $p)
                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Nominal --}}
                                <div>
                                    <label for="donation_amount" class="block text-sm font-semibold text-[var(--color-secondary)] mb-2">Nominal (Rp)</label>
                                    <input type="number" id="donation_amount" x-model="formData.amount" required min="10000" placeholder="Contoh: 50000" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-[var(--color-primary)] focus:ring focus:ring-[var(--color-primary)]/20 transition-all text-sm font-semibold">
                                    <p class="text-xs text-slate-400 mt-1.5">* Minimal donasi Rp 10.000</p>
                                </div>

                                <button type="submit" :disabled="isLoading" aria-label="Lanjutkan Pembayaran Infaq" class="w-full py-4 bg-[var(--color-primary)] hover:bg-[var(--color-tertiary)] text-[var(--color-neutral)] font-bold rounded-xl transition-all shadow-md shadow-[var(--color-primary)]/30 hover:shadow-lg flex items-center justify-center gap-2 text-sm sm:text-base disabled:opacity-70 disabled:cursor-not-allowed">
                                    <template x-if="!isLoading">
                                        <div class="flex items-center gap-2">
                                            <iconify-icon icon="mdi:heart"></iconify-icon>
                                            Lanjutkan Pembayaran
                                        </div>
                                    </template>
                                    <template x-if="isLoading">
                                        <div class="flex items-center gap-2">
                                            <iconify-icon icon="mdi:loading" class="animate-spin text-xl"></iconify-icon>
                                            Memproses...
                                        </div>
                                    </template>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- MODAL INFAQ --}}
                    <div
                        x-show="showModal"
                        x-cloak
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="fixed inset-0 z-50 flex items-center justify-center p-4"
                        style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px);"
                        @keydown.escape.window="closeModal()"
                    >
                        <div
                            x-show="showModal"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                            class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-y-auto max-h-[90vh] scrollbar-thin"
                            @click.stop
                        >
                            <div class="bg-gradient-to-br from-[var(--color-secondary)] to-slate-800 p-6 text-center">
                                <div class="w-16 h-16 bg-green-400/20 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <iconify-icon icon="mdi:check-circle" class="text-4xl text-green-400"></iconify-icon>
                                </div>
                                <h3 class="text-white font-bold text-lg">Pendaftaran Infaq Berhasil!</h3>
                                <p class="text-white/70 text-xs mt-1">Selesaikan donasi Anda dengan transfer ke rekening di bawah ini.</p>
                            </div>

                            {{-- Body Modal --}}
                            <div class="p-6 space-y-4">
                                {{-- Kode Infaq --}}
                                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-center">
                                    <p class="text-xs text-amber-700 mb-1">Kode Infaq Anda</p>
                                    <p class="text-2xl font-bold text-[var(--color-secondary)] tracking-widest font-mono" x-text="responseData.donation_code ?? '-'"></p>
                                </div>

                                {{-- Infaq: Transfer / QRIS --}}
                                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 text-center">
                                    <iconify-icon icon="mdi:qrcode-scan" class="text-3xl text-blue-600 mb-1"></iconify-icon>
                                    <p class="text-xs font-bold uppercase tracking-wider text-blue-700">Infaq via Transfer / QRIS</p>
                                    <p class="text-sm text-blue-800 mt-1">Scan QR Code berikut untuk membayar infaq:</p>

                                    {{-- QRIS Image --}}
                                    <template x-if="responseData.qris_image_url">
                                        <div class="mt-3 bg-white rounded-xl border border-blue-200 p-3 inline-block">
                                            <img :src="responseData.qris_image_url" alt="QRIS Masjid Al-Kautsar" class="w-40 h-40 object-contain mx-auto rounded-lg">
                                        </div>
                                    </template>
                                    <template x-if="!responseData.qris_image_url">
                                        <div class="mt-3 bg-white rounded-xl border border-blue-200 p-6 text-slate-400 text-xs">
                                            Gambar QRIS belum tersedia.<br>Hubungi pengurus masjid.
                                        </div>
                                    </template>

                                    <div class="mt-3 bg-white rounded-xl border border-blue-200 py-3 px-4">
                                        <p class="text-xs text-slate-500 mb-1">Total yang harus ditransfer:</p>
                                        <p class="text-2xl font-black text-blue-700">
                                            Rp <span x-text="(responseData.total_amount ?? 0).toLocaleString('id-ID')"></span>
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            (Nominal: Rp <span x-text="(responseData.amount ?? 0).toLocaleString('id-ID')"></span>
                                            + Kode Unik: <span x-text="responseData.unique_code ?? 0"></span>)
                                        </p>
                                    </div>

                                    <div class="mt-3 text-xs text-blue-700 text-left space-y-1 bg-white p-3 border border-blue-200 rounded-xl">
                                        <p>Bank Tujuan: <span class="font-bold" x-text="responseData.bank_name || '-'"></span></p>
                                        <p>No. Rekening: <span class="font-bold" x-text="responseData.account_number || '-'"></span></p>
                                        <p>Atas Nama: <span class="font-bold" x-text="responseData.account_name || '-'"></span></p>
                                    </div>
                                </div>

                                {{-- Tombol --}}
                                <div class="mt-5 space-y-2">
                                    <a :href="getWaLink()" target="_blank" class="w-full inline-flex items-center justify-center gap-2 bg-green-700 hover:bg-green-800 text-white font-bold py-3 rounded-xl transition-colors text-sm">
                                        <iconify-icon icon="mdi:whatsapp" class="text-xl"></iconify-icon>
                                        Konfirmasi via WhatsApp
                                    </a>
                                    <button @click="closeModal()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl transition-colors text-sm">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ================================================================
                SECTION 3: JADWAL KAJIAN TERDEKAT
                ================================================================ --}}
                <section class="bg-white py-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end mb-12 section-reveal">
                            {{-- Spacer Kiri --}}
                            <div class="hidden sm:block"></div>

                            {{-- Judul Tengah --}}
                            <div class="text-center">
                                <span class="inline-block text-sky-600 text-xs font-bold uppercase tracking-widest mb-3">
                                    Agenda Mendatang
                                </span>
                                <h2 class="font-raleway font-bold text-slate-800 text-2xl md:text-3xl">
                                    Jadwal Kajian Terdekat
                                </h2>
                            </div>

                            {{-- Link Kanan --}}
                            <div class="flex justify-center sm:justify-end pb-1">
                                <a href="{{ route('kajian') }}"
                                    class="shrink-0 inline-flex items-center gap-2 text-sky-600 font-semibold text-sm hover:gap-3 transition-all">
                                    Semua Kajian <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                                </a>
                            </div>
                        </div>

                        @if($upcomingKajian->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($upcomingKajian->take(3) as $kajian)
                                    <a href="{{ route('kajian.show', $kajian) }}"
                                        class="group block bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden section-reveal"
                                        style="animation-delay: {{ $loop->index * 0.1 }}s">

                                        {{-- Poster --}}
                                        @if($kajian->poster)
                                            <div class="h-44 overflow-hidden">
                                                <img src="{{ asset('storage/' . $kajian->poster) }}" alt="{{ $kajian->sub_title }}" loading="lazy"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            </div>
                                        @else
                                            <div class="h-44 bg-gradient-to-br from-sky-500 to-indigo-600 flex items-center justify-center">
                                                <iconify-icon icon="mdi:book-open-blank-variant-outline"
                                                    class="text-6xl text-white/40"></iconify-icon>
                                            </div>
                                        @endif

                                        <div class="p-5">
                                            {{-- Date Badge --}}
                                            <div class="flex items-center gap-2 mb-3">
                                                <span
                                                    class="inline-flex items-center gap-1.5 text-xs bg-sky-50 text-sky-700 font-semibold px-3 py-1 rounded-full">
                                                    <iconify-icon icon="mdi:calendar-outline"></iconify-icon>
                                                    {{ \Carbon\Carbon::parse($kajian->date)->translatedFormat('d F Y') }}
                                                </span>
                                                <span
                                                    class="inline-flex items-center gap-1.5 text-xs bg-slate-100 text-slate-600 font-semibold px-3 py-1 rounded-full">
                                                    <iconify-icon icon="mdi:clock-outline"></iconify-icon>
                                                    {{ $kajian->time_phrase ?? \Carbon\Carbon::parse($kajian->start_time)->format('H:i') }}
                                                </span>
                                            </div>

                                            <h3
                                                class="font-raleway font-bold text-slate-800 text-base leading-snug mb-2 group-hover:text-sky-600 transition-colors line-clamp-2">
                                                {{ $kajian->sub_title }}
                                            </h3>

                                            @if($kajian->ustadz)
                                                <p class="text-slate-500 text-sm flex items-center gap-1.5">
                                                    <iconify-icon icon="mdi:account-tie-outline" class="text-base"></iconify-icon>
                                                    {{ $kajian->ustadz->name }}
                                                </p>
                                            @endif

                                            @if($kajian->location)
                                                <p class="text-slate-500 text-sm flex items-center gap-1.5 mt-1">
                                                    <iconify-icon icon="mdi:map-marker-outline" class="text-base"></iconify-icon>
                                                    {{ $kajian->location->name }}
                                                </p>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            {{-- Remaining kajian as list --}}
                            @if($upcomingKajian->count() > 3)
                                <div class="mt-6 space-y-3">
                                    @foreach($upcomingKajian->skip(3) as $kajian)
                                        <a href="{{ route('kajian.show', $kajian) }}"
                                            class="group flex items-center gap-4 bg-slate-50 hover:bg-sky-50 border border-slate-100 hover:border-sky-200 rounded-xl px-5 py-4 transition-all section-reveal">
                                            <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center shrink-0">
                                                <iconify-icon icon="mdi:book-open-page-variant-outline" class="text-sky-600 text-xl"></iconify-icon>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-slate-800 text-sm truncate group-hover:text-sky-700 transition-colors">
                                                    {{ $kajian->sub_title }}
                                                </p>
                                                <p class="text-slate-500 text-xs mt-0.5">
                                                    {{ \Carbon\Carbon::parse($kajian->date)->translatedFormat('d F Y') }}{{ $kajian->ustadz ? ' · ' . $kajian->ustadz->name : '' }}
                                                </p>
                                            </div>
                                            <iconify-icon icon="mdi:chevron-right"
                                                class="text-slate-400 group-hover:text-sky-500 transition-colors text-xl"></iconify-icon>
                                        </a>
                                    @endforeach
                                </div>
                            @endif

                        @else
                            {{-- Empty state --}}
                            <div class="flex flex-col items-center justify-center py-20 text-slate-400 section-reveal">
                                <iconify-icon icon="mdi:calendar-blank-outline" class="text-7xl mb-4 opacity-30"></iconify-icon>
                                <p class="font-semibold text-lg">Nantikan jadwal kajian berikutnya</p>
                                <p class="text-sm mt-1">Program kajian rutin akan segera hadir kembali</p>
                            </div>
                        @endif

                    </div>
                </section>

                {{-- ================================================================
                SECTION 4: TRANSPARANSI KEUANGAN MINI
                ================================================================ --}}
                <section class="relative bg-slate-900 py-20 overflow-hidden">

                    {{-- Decorative blobs --}}
                    <div class="absolute top-0 left-1/4 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-yellow-500/10 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                        <div class="text-center mb-14 section-reveal">
                            <span class="inline-block text-yellow-400 text-xs font-bold uppercase tracking-widest mb-3">
                                Transparansi & Akuntabilitas
                            </span>
                            <h2 class="font-raleway font-bold text-white text-3xl md:text-4xl">
                                Ringkasan Keuangan Masjid
                            </h2>
                            <p class="text-white/50 mt-3 max-w-lg mx-auto text-sm">
                                Kami mengelola amanah jamaah dengan penuh tanggung jawab. Berikut ringkasan keuangan terkini.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-10">

                            {{-- Total Saldo --}}
                            <div class="glass-dark rounded-2xl p-7 text-center section-reveal delay-100">
                                <div class="w-14 h-14 rounded-2xl bg-yellow-500/10 flex items-center justify-center mx-auto mb-4">
                                    <iconify-icon icon="mdi:bank-outline" class="text-yellow-400 text-2xl"></iconify-icon>
                                </div>
                                <p class="text-white/50 text-xs font-bold uppercase tracking-widest mb-2">Total Saldo Aktif</p>
                                <p class="text-white font-black text-2xl md:text-3xl">
                                    Rp {{ number_format($totalSaldo, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Total Pemasukan --}}
                            <div class="glass-dark rounded-2xl p-7 text-center section-reveal delay-200">
                                <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 flex items-center justify-center mx-auto mb-4">
                                    <iconify-icon icon="mdi:trending-up" class="text-emerald-400 text-2xl"></iconify-icon>
                                </div>
                                <p class="text-white/50 text-xs font-bold uppercase tracking-widest mb-2">Total Pemasukan</p>
                                <p class="text-emerald-400 font-black text-2xl md:text-3xl">
                                    Rp {{ number_format($totalMasuk, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Total Pengeluaran --}}
                            <div class="glass-dark rounded-2xl p-7 text-center section-reveal delay-300">
                                <div class="w-14 h-14 rounded-2xl bg-rose-500/10 flex items-center justify-center mx-auto mb-4">
                                    <iconify-icon icon="mdi:trending-down" class="text-rose-400 text-2xl"></iconify-icon>
                                </div>
                                <p class="text-white/50 text-xs font-bold uppercase tracking-widest mb-2">Total Pengeluaran</p>
                                <p class="text-rose-400 font-black text-2xl md:text-3xl">
                                    Rp {{ number_format($totalKeluar, 0, ',', '.') }}
                                </p>
                            </div>

                        </div>

                        {{-- Bulan Ini detail + CTA --}}
                        <div
                            class="flex flex-col xl:flex-row items-center justify-center gap-6 xl:gap-10 glass-dark rounded-2xl px-7 py-5 section-reveal text-center xl:text-left">
                            <div class="flex items-center justify-center gap-3">
                                <iconify-icon icon="mdi:calendar-month-outline"
                                    class="text-yellow-400 text-3xl shrink-0"></iconify-icon>
                                <p class="text-white/50 text-xs md:text-sm font-bold uppercase tracking-widest mt-1">Bulan Ini
                                    ({{ now()->translatedFormat('F Y') }})</p>
                            </div>

                            <div class="flex flex-wrap justify-center items-center gap-4 md:gap-8">
                                <p class="text-white font-semibold">
                                    Masuk: <span class="text-emerald-400 font-bold">Rp
                                        {{ number_format($masukBulanIni, 0, ',', '.') }}</span>
                                </p>
                                <p class="text-white font-semibold">
                                    Keluar: <span class="text-rose-400 font-bold">Rp
                                        {{ number_format($keluarBulanIni, 0, ',', '.') }}</span>
                                </p>
                            </div>

                            <a href="{{ route('financial-report') }}"
                                class="shrink-0 inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold px-6 py-3 rounded-full text-sm transition-all duration-200 hover:shadow-lg hover:shadow-yellow-500/30 hover:-translate-y-0.5">
                                <iconify-icon icon="mdi:chart-bar"></iconify-icon>
                                Lihat Laporan Lengkap
                            </a>
                        </div>

                    </div>
                </section>

                {{-- ================================================================
                SECTION 5: TESTIMONIAL
                ================================================================ --}}
                @if($testimonials->isNotEmpty())
                    <section class="bg-slate-50 py-20 overflow-hidden">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
                            <div class="text-center section-reveal">
                                <span class="inline-block text-amber-600 text-xs font-bold uppercase tracking-widest mb-3">
                                    Suara Jamaah
                                </span>
                                <h2 class="font-raleway font-bold text-slate-800 text-3xl md:text-4xl">
                                    Apa Kata Mereka?
                                </h2>
                            </div>
                        </div>

                        {{-- Auto-scrolling Ticker --}}
                        <div class="ticker-wrap py-2">
                            <div class="ticker-track">
                                {{-- Duplicate for seamless loop --}}
                                @foreach([$testimonials, $testimonials] as $group)
                                    @foreach($group as $t)
                                        <div class="w-72 md:w-80 shrink-0 bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                                            <iconify-icon icon="mdi:format-quote-open" class="text-3xl text-yellow-400 mb-3 block"></iconify-icon>
                                            <p class="text-slate-600 text-sm leading-relaxed line-clamp-4">{{ $t->message ?? $t->content ?? '-' }}
                                            </p>
                                            <div class="flex items-center gap-3 mt-5">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-gradient-to-br from-yellow-400 to-amber-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
                                                    {{ strtoupper(substr($t->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-slate-800 text-sm">{{ $t->name }}</p>
                                                    @if(isset($t->role))
                                                        <p class="text-slate-400 text-xs">{{ $t->role }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                {{-- ================================================================
                SECTION 6: CALL TO ACTION
                ================================================================ --}}
                <section class="relative bg-gradient-to-br from-amber-600 via-yellow-500 to-amber-400 py-20 overflow-hidden">

                    {{-- Decorative pattern --}}
                    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url(\"
                        data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg' %3E%3Cg
                        fill='none' fill-rule='evenodd' %3E%3Cg fill='%23000000' fill-opacity='1' %3E%3Cpath
                        d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'
                        /%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>

                    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center section-reveal">
                        <iconify-icon icon="mdi:mosque" class="text-6xl text-white/80 mb-6 block"></iconify-icon>
                        <h2 class="font-raleway font-bold text-white text-3xl md:text-5xl leading-tight mb-5">
                            Mari Bersama Memakmurkan<br>Masjid Al-Kautsar
                        </h2>
                        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto mb-10 leading-relaxed">
                            Setiap donasi, kehadiran di kajian, dan doa yang tulus adalah sumbangsih nyata bagi kemakmuran masjid dan
                            peradaban umat.
                        </p>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <a href="{{ route('zakat') }}"
                                class="px-8 py-4 bg-white text-amber-700 font-bold rounded-full shadow-xl shadow-black/20 hover:shadow-2xl hover:-translate-y-1 transition-all duration-200 text-sm">
                                <iconify-icon icon="mdi:hand-coin-outline" class="mr-2 text-base"></iconify-icon>
                                Bayar Zakat Fitrah
                            </a>
                            <a href="{{ route('contact.index') }}"
                                class="px-8 py-4 bg-white/20 hover:bg-white/30 text-white font-bold rounded-full border border-white/30 hover:-translate-y-1 transition-all duration-200 text-sm backdrop-blur-sm">
                                <iconify-icon icon="mdi:message-text-outline" class="mr-2 text-base"></iconify-icon>
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </section>

@endsection

@push('scripts')
    <script>
        // ================================================================
        // SCROLL REVEAL
        // ================================================================
        (function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');
                        observer.unobserve(e.target);
                    }
                });
            }, { threshold: 0.12 });

            document.querySelectorAll('.section-reveal').forEach(el => observer.observe(el));
        })();

        // ================================================================
        // PRAYER WIDGET (MyQuran v3.0 API)
        // ================================================================
        function prayerWidget() {
            return {
                loading: true,
                prayers: [
                    { name: 'Subuh', icon: 'mdi:weather-night', time: '--:--' },
                    { name: 'Dzuhur', icon: 'mdi:weather-sunny', time: '--:--' },
                    { name: 'Ashar', icon: 'mdi:weather-partly-cloudy', time: '--:--' },
                    { name: 'Maghrib', icon: 'mdi:weather-sunset', time: '--:--' },
                    { name: 'Isya', icon: 'mdi:weather-night-partly-cloudy', time: '--:--' },
                ],
                nextPrayerName: '',
                nextPrayerLabel: '—',
                todayLabel: '',
                countdown: '00:00:00',
                nextPrayerTime: null,
                _timer: null,

                async init() {
                    const now = new Date();
                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    this.todayLabel = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

                    // Kota Semarang — ID 1312 di MyQuran API
                    const cityId = '74db120f0a8e5646ef5a30154e9f6deb';
                    const dateStr = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;

                    try {
                        const resp = await fetch(`https://api.myquran.com/v3/sholat/jadwal/${cityId}/${dateStr}`);
                        const json = await resp.json();

                        if (json.status && json.data && json.data.jadwal) {
                            const j = json.data.jadwal[dateStr]; // keyed by "YYYY-MM-DD"
                            if (j) {
                                this.prayers[0].time = j.subuh;
                                this.prayers[1].time = j.dzuhur;
                                this.prayers[2].time = j.ashar;
                                this.prayers[3].time = j.maghrib;
                                this.prayers[4].time = j.isya;
                            }
                        }
                    } catch (e) {
                        console.warn('Prayer API error:', e);
                    }

                    this.loading = false;
                    this.updateNext();
                    this._timer = setInterval(() => this.tick(), 1000);
                },

                parseTime(str) {
                    if (!str || str === '--:--') return null;
                    const [h, m] = str.split(':').map(Number);
                    const d = new Date();
                    d.setHours(h, m, 0, 0);
                    return d;
                },

                updateNext() {
                    const now = new Date();
                    let found = false;
                    for (const p of this.prayers) {
                        const t = this.parseTime(p.time);
                        if (t && t > now) {
                            this.nextPrayerName = p.name;
                            this.nextPrayerLabel = `${p.name} — ${p.time}`;
                            this.nextPrayerTime = t;
                            found = true;
                            break;
                        }
                    }
                    if (!found) {
                        this.nextPrayerName = 'Subuh';
                        this.nextPrayerLabel = 'Subuh (besok)';
                        this.nextPrayerTime = null;
                    }
                },

                tick() {
                    if (!this.nextPrayerTime) { this.countdown = '—'; return; }
                    const diff = Math.max(0, this.nextPrayerTime - new Date());
                    if (diff === 0) { this.updateNext(); return; }
                    const h = String(Math.floor(diff / 3600000)).padStart(2, '0');
                    const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
                    const s = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');
                    this.countdown = `${h}:${m}:${s}`;
                },
            };
        }

        function infaqForm() {
            return {
                formData: {
                    name: '',
                    donation_category_id: '',
                    amount: ''
                },
                isLoading: false,
                showModal: false,
                responseData: {},
                submitForm() {
                    this.isLoading = true;
                    fetch('{{ route('donation.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.isLoading = false;
                        if(data.success) {
                            this.responseData = data.data;
                            this.showModal = true;
                            this.formData.name = '';
                            this.formData.amount = '';
                            this.formData.donation_category_id = '';
                        } else {
                            alert('Gagal: ' + data.message);
                        }
                    })
                    .catch(error => {
                        this.isLoading = false;
                        alert('Terjadi kesalahan, silakan coba lagi.');
                    });
                },
                closeModal() {
                    this.showModal = false;
                },
                getWaLink() {
                    let phone = '6282329621484';
                    let name = this.responseData.donation_name || 'Hamba Allah';
                    let code = this.responseData.donation_code || '';
                    let category = this.responseData.category_name || '';
                    let nominal = (this.responseData.total_amount || 0).toLocaleString('id-ID');

                    let text = `Assalamu'alaikum, saya ${name} dengan Kode Donasi *${code}* bermaksud melakukan konfirmasi untuk Infaq/Sedekah program *${category}* dengan nominal sebesar Rp ${nominal}. Berikut ini adalah lampiran bukti transfer saya.`;

                    return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
                }
            }
        }
    </script>
@endpush