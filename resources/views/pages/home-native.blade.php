@extends('layouts.app-native')

@section('title', 'Beranda — Masjid Al-Kautsar Cempolorejo')
@section('description', 'Masjid Al-Kautsar Cempolorejo — Pusat dakwah, ukhuwah, dan peradaban umat Islam di Semarang Barat.')

@push('preloads')
    <link rel="preload" href="{{ asset('images/masjid-alkautsar.webp') }}" as="image" type="image/webp" fetchpriority="high">
@endpush

@section('content')

    {{-- ================================================================
    SECTION 1: HERO
    ================================================================ --}}
    <section class="n-hero" id="hero">

        {{-- Background --}}
        <div class="n-hero-bg">
            <img src="{{ asset('images/masjid-alkautsar.webp') }}" alt="Masjid Al-Kautsar"
                fetchpriority="high" loading="eager" decoding="sync"
                class="n-hero-bg-img" id="hero-bg">
            <div class="n-hero-overlay"></div>
        </div>

        {{-- Gold accent top --}}
        <div class="n-hero-gold-accent"></div>

        {{-- Hero Content --}}
        <div class="n-hero-content">
            <span class="n-hero-tagline anim-fadeInUp delay-100">
                <span class="n-hero-tagline-line"></span>
                Dakwah · Ukhuwah · Together to Jannah
                <span class="n-hero-tagline-line"></span>
            </span>

            <h1 class="n-hero-title anim-fadeInUp delay-200">
                Masjid <span class="n-hero-title-highlight">Al-Kautsar</span><br>Cempolorejo
            </h1>

            {{-- Rotating Ayat --}}
            <div class="n-hero-quotes anim-fadeInUp delay-300"
                x-data="{
                    quotes: [
                        'إِنَّمَا يَعْمُرُ مَسَاجِدَ اللَّهِ مَنْ آمَنَ بِاللَّهِ — QS At-Taubah: 18',
                        'وَمَنْ أَحْسَنُ قَوْلًا مِمَّنْ دَعَا إِلَى اللَّهِ — QS Fushilat: 33',
                        'النَّاسُ كَمَعَادِنِ الذَّهَبِ وَالْفِضَّةِ — HR Muslim',
                    ],
                    current: 0,
                    init() { setInterval(() => this.current = (this.current + 1) % this.quotes.length, 4000) }
                }">
                <template x-for="(q, i) in quotes" :key="i">
                    <p x-show="current === i"
                        x-transition:enter="n-quote-enter"
                        x-transition:enter-start="n-quote-enter-start"
                        x-transition:enter-end="n-quote-enter-end"
                        x-transition:leave="n-quote-leave"
                        x-transition:leave-start="n-quote-leave-start"
                        x-transition:leave-end="n-quote-leave-end"
                        class="n-hero-quote" x-text="q">
                    </p>
                </template>
            </div>

            {{-- CTA Buttons --}}
            <div class="n-hero-btns anim-fadeInUp delay-400">
                <a href="{{ route('kajian') }}" class="n-btn-primary">
                    <iconify-icon icon="mdi:calendar-star"></iconify-icon>
                    Jadwal Kajian
                </a>
                <a href="{{ route('financial-report') }}" class="n-btn-glass">
                    <iconify-icon icon="mdi:chart-line"></iconify-icon>
                    Laporan Keuangan
                </a>
            </div>

            {{-- Prayer Widget --}}
            <div class="n-prayer-wrap anim-fadeInUp delay-500" x-data="prayerWidget()" x-init="init()">
                <div class="n-prayer-box">
                    <div class="n-prayer-header">
                        <div>
                            <p class="n-prayer-label">Jadwal Sholat</p>
                            <p class="n-prayer-date" x-text="todayLabel">Memuat tanggal...</p>
                        </div>
                        <div class="n-prayer-next">
                            <p class="n-prayer-next-label">Sholat Berikutnya</p>
                            <p class="n-prayer-next-name" x-text="nextPrayerLabel">—</p>
                            <p class="n-prayer-countdown" x-text="countdown">00:00:00</p>
                        </div>
                    </div>

                    <div class="n-prayer-grid">
                        <template x-for="p in prayers" :key="p.name">
                            <div class="n-prayer-item"
                                :class="p.name === nextPrayerName ? 'n-prayer-item-active' : ''">
                                <iconify-icon :icon="p.icon"
                                    class="n-prayer-icon"
                                    :class="p.name === nextPrayerName ? 'n-prayer-icon-active' : ''">
                                </iconify-icon>
                                <p class="n-prayer-name" x-text="p.name"></p>
                                <p class="n-prayer-time" x-text="p.time">--:--</p>
                            </div>
                        </template>
                    </div>

                    <p x-show="loading" class="n-prayer-loading anim-pulse-slow">
                        Memuat jadwal sholat Semarang...
                    </p>
                </div>
            </div>
        </div>

        {{-- Scroll Chevron --}}
        <div class="n-hero-scroll">
            <a href="#programs" class="n-hero-scroll-btn anim-bounce">
                <iconify-icon icon="mdi:chevron-double-down"></iconify-icon>
            </a>
        </div>
    </section>

    {{-- ================================================================
    SECTION 2: PROGRAM & LAYANAN UTAMA
    ================================================================ --}}
    <section id="programs" class="n-programs-section">
        <div class="n-container">

            <div class="n-section-header section-reveal">
                <span class="n-section-eyebrow">Layanan & Program</span>
                <h2 class="n-section-title">Apa yang Bisa Kamu Lakukan?</h2>
                <p class="n-section-desc">Bergabunglah dalam berbagai program kebaikan dan layanan yang tersedia di Masjid Al-Kautsar.</p>
            </div>

            <div class="n-programs-grid">

                <a href="{{ route('zakat') }}" class="n-program-card section-reveal delay-100">
                    <div>
                        <div class="n-program-icon n-program-icon-gold">
                            <iconify-icon icon="mdi:hand-coin-outline"></iconify-icon>
                        </div>
                        <h3 class="n-program-title">Zakat Fitrah</h3>
                        <p class="n-program-desc">Tunaikan zakat fitrah beras dengan mudah.</p>
                    </div>
                    <span class="n-program-link n-program-link-gold">
                        Bayar <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                    </span>
                </a>

                <a href="{{ route('itikaf') }}" class="n-program-card section-reveal delay-200">
                    <div>
                        <div class="n-program-icon n-program-icon-emerald">
                            <iconify-icon icon="mdi:moon-and-stars"></iconify-icon>
                        </div>
                        <h3 class="n-program-title">I'tikaf</h3>
                        <p class="n-program-desc">Daftar I'tikaf 10 hari terakhir Ramadhan.</p>
                    </div>
                    <span class="n-program-link n-program-link-emerald">
                        Daftar <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                    </span>
                </a>

                <a href="{{ route('kajian') }}" class="n-program-card section-reveal delay-300">
                    <div>
                        <div class="n-program-icon n-program-icon-sky">
                            <iconify-icon icon="mdi:book-open-page-variant-outline"></iconify-icon>
                        </div>
                        <h3 class="n-program-title">Kajian Islam</h3>
                        <p class="n-program-desc">Ikuti kajian rutin dan tematik bersama para asatidz.</p>
                    </div>
                    <span class="n-program-link n-program-link-sky">
                        Lihat <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                    </span>
                </a>

                <a href="{{ route('water-refill') }}" class="n-program-card section-reveal delay-400">
                    <div>
                        <div class="n-program-icon n-program-icon-blue">
                            <iconify-icon icon="mdi:water-outline"></iconify-icon>
                        </div>
                        <h3 class="n-program-title">Alka Tirta</h3>
                        <p class="n-program-desc">Layanan isi ulang air minum yang menyegarkan dan bersih.</p>
                    </div>
                    <span class="n-program-link n-program-link-blue">
                        Info <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                    </span>
                </a>

                <a href="{{ route('hajj') }}" class="n-program-card section-reveal delay-500">
                    <div>
                        <div class="n-program-icon n-program-icon-amber">
                            <iconify-icon icon="mdi:airplane-takeoff"></iconify-icon>
                        </div>
                        <h3 class="n-program-title">Haji & Umroh</h3>
                        <p class="n-program-desc">Biro perjalanan ibadah terpercaya.</p>
                    </div>
                    <span class="n-program-link n-program-link-amber">
                        Info <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                    </span>
                </a>

            </div>
        </div>
    </section>

    {{-- ================================================================
    SECTION 2.5: PROGRAM INFAQ & SEDEKAH
    ================================================================ --}}
    <section class="n-infaq-section">
        <div class="n-container">
            <div class="n-section-header section-reveal">
                <span class="n-section-eyebrow n-eyebrow-yellow">Jariyah pilihan</span>
                <h2 class="n-section-title">Program Infaq & Sedekah</h2>
                <p class="n-section-desc">Pilih program yang ingin Anda dukung, setiap rupiah tersalurkan dengan amanah.</p>
            </div>

            <div class="n-infaq-grid">
                @foreach($programs as $p)
                    @php
                        $terkumpul = $p->donationTransactions()->where('status', 'success')->sum('amount');
                        $target = $p->target_amount ?: 1;
                        $percent = min(100, round(($terkumpul / $target) * 100));
                    @endphp
                    <div class="n-infaq-card section-reveal" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="n-infaq-card-body">
                            <div class="n-infaq-card-top">
                                <span class="n-infaq-icon-wrap">
                                    <iconify-icon icon="{{ $p->icon ?? 'mdi:mosque' }}"></iconify-icon>
                                </span>
                                @if($p->badge)
                                    <span class="n-infaq-badge">
                                        <iconify-icon icon="mdi:alert-circle-outline"></iconify-icon>{{ $p->badge }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="n-infaq-title">{{ $p->name }}</h3>
                            <p class="n-infaq-desc">{{ $p->description }}</p>
                        </div>
                        <div class="n-infaq-card-footer">
                            <div class="n-progress-bar">
                                <div class="n-progress-fill" style="width: {{ $percent }}%"></div>
                            </div>
                            <div class="n-progress-info">
                                <span class="n-progress-amount">Rp {{ number_format($terkumpul, 0, ',', '.') }}</span>
                                <span class="n-progress-percent">{{ $percent }}% dari Rp {{ number_format($p->target_amount, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('zakat') }}#program" class="n-btn-outline">
                                Salurkan Donasi <iconify-icon icon="mdi:arrow-right"></iconify-icon>
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
    <section class="n-form-section" x-data="infaqForm()">
        <div class="n-container-sm">
            <div class="n-form-box section-reveal">
                <div class="n-form-header">
                    <iconify-icon icon="mdi:hand-heart" class="n-form-icon"></iconify-icon>
                    <h2 class="n-form-title">Mulai Kebaikan Hari Ini</h2>
                    <p class="n-form-desc">Salurkan infaq dan sedekah Anda dengan mudah dan cepat melalui form di bawah ini.</p>
                </div>

                <form @submit.prevent="submitForm" class="n-form">
                    <div class="n-form-grid">
                        <div class="n-form-group">
                            <label class="n-label">Nama Lengkap (Opsional)</label>
                            <input type="text" x-model="formData.name" placeholder="Hamba Allah" class="n-input">
                        </div>
                        <div class="n-form-group">
                            <label class="n-label">Kategori Infaq</label>
                            <select x-model="formData.donation_category_id" required class="n-input">
                                <option value="" disabled selected>Pilih Kategori...</option>
                                @foreach($programs as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="n-form-group">
                        <label class="n-label">Nominal (Rp)</label>
                        <input type="number" x-model="formData.amount" required min="10000" placeholder="Contoh: 50000" class="n-input n-input-bold">
                        <p class="n-input-hint">* Minimal donasi Rp 10.000</p>
                    </div>
                    <button type="submit" :disabled="isLoading" class="n-btn-submit">
                        <template x-if="!isLoading">
                            <span class="n-btn-submit-inner">
                                <iconify-icon icon="mdi:heart"></iconify-icon>
                                Lanjutkan Pembayaran
                            </span>
                        </template>
                        <template x-if="isLoading">
                            <span class="n-btn-submit-inner">
                                <iconify-icon icon="mdi:loading" class="n-spin"></iconify-icon>
                                Memproses...
                            </span>
                        </template>
                    </button>
                </form>
            </div>
        </div>

        {{-- MODAL --}}
        <div x-show="showModal" x-cloak
            x-transition:enter="n-modal-enter"
            x-transition:enter-start="n-modal-enter-start"
            x-transition:enter-end="n-modal-enter-end"
            x-transition:leave="n-modal-leave"
            x-transition:leave-start="n-modal-leave-start"
            x-transition:leave-end="n-modal-leave-end"
            class="n-modal-backdrop"
            @keydown.escape.window="closeModal()">
            <div x-show="showModal"
                x-transition:enter="n-modal-box-enter"
                x-transition:enter-start="n-modal-box-enter-start"
                x-transition:enter-end="n-modal-box-enter-end"
                x-transition:leave="n-modal-box-leave"
                x-transition:leave-start="n-modal-box-leave-start"
                x-transition:leave-end="n-modal-box-leave-end"
                class="n-modal-box" @click.stop>

                <div class="n-modal-header">
                    <div class="n-modal-check-wrap">
                        <iconify-icon icon="mdi:check-circle" class="n-modal-check"></iconify-icon>
                    </div>
                    <h3 class="n-modal-title">Pendaftaran Infaq Berhasil!</h3>
                    <p class="n-modal-subtitle">Selesaikan donasi Anda dengan transfer ke rekening di bawah ini.</p>
                </div>

                <div class="n-modal-body">
                    <div class="n-modal-code-box">
                        <p class="n-modal-code-label">Kode Infaq Anda</p>
                        <p class="n-modal-code" x-text="responseData.donation_code ?? '-'"></p>
                    </div>

                    <div class="n-modal-qris-box">
                        <iconify-icon icon="mdi:qrcode-scan" class="n-modal-qris-icon"></iconify-icon>
                        <p class="n-modal-qris-title">Infaq via Transfer / QRIS</p>
                        <p class="n-modal-qris-desc">Scan QR Code berikut untuk membayar infaq:</p>

                        <template x-if="responseData.qris_image_url">
                            <div class="n-modal-qris-img-wrap">
                                <img :src="responseData.qris_image_url" alt="QRIS" class="n-modal-qris-img">
                            </div>
                        </template>
                        <template x-if="!responseData.qris_image_url">
                            <div class="n-modal-qris-empty">Gambar QRIS belum tersedia.<br>Hubungi pengurus masjid.</div>
                        </template>

                        <div class="n-modal-total-box">
                            <p class="n-modal-total-label">Total yang harus ditransfer:</p>
                            <p class="n-modal-total-amount">
                                Rp <span x-text="(responseData.total_amount ?? 0).toLocaleString('id-ID')"></span>
                            </p>
                            <p class="n-modal-total-detail">
                                (Nominal: Rp <span x-text="(responseData.amount ?? 0).toLocaleString('id-ID')"></span>
                                + Kode Unik: <span x-text="responseData.unique_code ?? 0"></span>)
                            </p>
                        </div>

                        <div class="n-modal-bank">
                            <p>Bank Tujuan: <strong x-text="responseData.bank_name || '-'"></strong></p>
                            <p>No. Rekening: <strong x-text="responseData.account_number || '-'"></strong></p>
                            <p>Atas Nama: <strong x-text="responseData.account_name || '-'"></strong></p>
                        </div>
                    </div>

                    <div class="n-modal-actions">
                        <a :href="getWaLink()" target="_blank" class="n-btn-wa">
                            <iconify-icon icon="mdi:whatsapp"></iconify-icon>
                            Konfirmasi via WhatsApp
                        </a>
                        <button @click="closeModal()" class="n-btn-close-modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
    SECTION 3: JADWAL KAJIAN TERDEKAT
    ================================================================ --}}
    <section class="n-kajian-section">
        <div class="n-container">

            <div class="n-kajian-header section-reveal">
                <div></div>
                <div class="n-section-header" style="margin-bottom:0">
                    <span class="n-section-eyebrow n-eyebrow-sky">Agenda Mendatang</span>
                    <h2 class="n-section-title">Jadwal Kajian Terdekat</h2>
                </div>
                <div class="n-kajian-see-all">
                    <a href="{{ route('kajian') }}" class="n-link-sky">
                        Semua Kajian <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                    </a>
                </div>
            </div>

            @if($upcomingKajian->isNotEmpty())
                <div class="n-kajian-grid">
                    @foreach($upcomingKajian->take(3) as $kajian)
                        <a href="{{ route('kajian.show', $kajian) }}"
                            class="n-kajian-card section-reveal"
                            style="animation-delay: {{ $loop->index * 0.1 }}s">

                            @if($kajian->poster)
                                <div class="n-kajian-poster">
                                    <img src="{{ asset('storage/' . $kajian->poster) }}" alt="{{ $kajian->sub_title }}" loading="lazy">
                                </div>
                            @else
                                <div class="n-kajian-poster n-kajian-poster-empty">
                                    <iconify-icon icon="mdi:book-open-blank-variant-outline"></iconify-icon>
                                </div>
                            @endif

                            <div class="n-kajian-body">
                                <div class="n-kajian-badges">
                                    <span class="n-kajian-badge-date">
                                        <iconify-icon icon="mdi:calendar-outline"></iconify-icon>
                                        {{ \Carbon\Carbon::parse($kajian->date)->translatedFormat('d F Y') }}
                                    </span>
                                    <span class="n-kajian-badge-time">
                                        <iconify-icon icon="mdi:clock-outline"></iconify-icon>
                                        {{ $kajian->time_phrase ?? \Carbon\Carbon::parse($kajian->start_time)->format('H:i') }}
                                    </span>
                                </div>
                                <h3 class="n-kajian-title">{{ $kajian->sub_title }}</h3>
                                @if($kajian->ustadz)
                                    <p class="n-kajian-meta">
                                        <iconify-icon icon="mdi:account-tie-outline"></iconify-icon>
                                        {{ $kajian->ustadz->name }}
                                    </p>
                                @endif
                                @if($kajian->location)
                                    <p class="n-kajian-meta">
                                        <iconify-icon icon="mdi:map-marker-outline"></iconify-icon>
                                        {{ $kajian->location->name }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                @if($upcomingKajian->count() > 3)
                    <div class="n-kajian-list">
                        @foreach($upcomingKajian->skip(3) as $kajian)
                            <a href="{{ route('kajian.show', $kajian) }}" class="n-kajian-list-item section-reveal">
                                <div class="n-kajian-list-icon">
                                    <iconify-icon icon="mdi:book-open-page-variant-outline"></iconify-icon>
                                </div>
                                <div class="n-kajian-list-body">
                                    <p class="n-kajian-list-title">{{ $kajian->sub_title }}</p>
                                    <p class="n-kajian-list-meta">
                                        {{ \Carbon\Carbon::parse($kajian->date)->translatedFormat('d F Y') }}{{ $kajian->ustadz ? ' · ' . $kajian->ustadz->name : '' }}
                                    </p>
                                </div>
                                <iconify-icon icon="mdi:chevron-right" class="n-kajian-list-arrow"></iconify-icon>
                            </a>
                        @endforeach
                    </div>
                @endif

            @else
                <div class="n-kajian-empty section-reveal">
                    <iconify-icon icon="mdi:calendar-blank-outline" class="n-kajian-empty-icon"></iconify-icon>
                    <p class="n-kajian-empty-title">Nantikan jadwal kajian berikutnya</p>
                    <p class="n-kajian-empty-desc">Program kajian rutin akan segera hadir kembali</p>
                </div>
            @endif

        </div>
    </section>

    {{-- ================================================================
    SECTION 4: TRANSPARANSI KEUANGAN
    ================================================================ --}}
    <section class="n-finance-section">
        <div class="n-finance-blob n-finance-blob-top"></div>
        <div class="n-finance-blob n-finance-blob-bottom"></div>

        <div class="n-container n-finance-inner">
            <div class="n-section-header section-reveal">
                <span class="n-section-eyebrow n-eyebrow-gold">Transparansi & Akuntabilitas</span>
                <h2 class="n-section-title n-title-white">Ringkasan Keuangan Masjid</h2>
                <p class="n-section-desc n-desc-muted">Kami mengelola amanah jamaah dengan penuh tanggung jawab. Berikut ringkasan keuangan terkini.</p>
            </div>

            <div class="n-finance-grid">
                <div class="n-finance-card n-glass-dark section-reveal delay-100">
                    <div class="n-finance-icon n-finance-icon-gold">
                        <iconify-icon icon="mdi:bank-outline"></iconify-icon>
                    </div>
                    <p class="n-finance-label">Total Saldo Aktif</p>
                    <p class="n-finance-amount n-finance-amount-white">Rp {{ number_format($totalSaldo, 0, ',', '.') }}</p>
                </div>
                <div class="n-finance-card n-glass-dark section-reveal delay-200">
                    <div class="n-finance-icon n-finance-icon-emerald">
                        <iconify-icon icon="mdi:trending-up"></iconify-icon>
                    </div>
                    <p class="n-finance-label">Total Pemasukan</p>
                    <p class="n-finance-amount n-finance-amount-emerald">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</p>
                </div>
                <div class="n-finance-card n-glass-dark section-reveal delay-300">
                    <div class="n-finance-icon n-finance-icon-rose">
                        <iconify-icon icon="mdi:trending-down"></iconify-icon>
                    </div>
                    <p class="n-finance-label">Total Pengeluaran</p>
                    <p class="n-finance-amount n-finance-amount-rose">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="n-finance-monthly n-glass-dark section-reveal">
                <div class="n-finance-monthly-left">
                    <iconify-icon icon="mdi:calendar-month-outline" class="n-finance-monthly-icon"></iconify-icon>
                    <p class="n-finance-monthly-label">Bulan Ini ({{ now()->translatedFormat('F Y') }})</p>
                </div>
                <div class="n-finance-monthly-stats">
                    <p class="n-finance-monthly-stat">
                        Masuk: <span class="n-finance-monthly-green">Rp {{ number_format($masukBulanIni, 0, ',', '.') }}</span>
                    </p>
                    <p class="n-finance-monthly-stat">
                        Keluar: <span class="n-finance-monthly-rose">Rp {{ number_format($keluarBulanIni, 0, ',', '.') }}</span>
                    </p>
                </div>
                <a href="{{ route('financial-report') }}" class="n-btn-finance-cta">
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
        <section class="n-testi-section">
            <div class="n-container">
                <div class="n-section-header section-reveal">
                    <span class="n-section-eyebrow n-eyebrow-amber">Suara Jamaah</span>
                    <h2 class="n-section-title">Apa Kata Mereka?</h2>
                </div>
            </div>

            <div class="n-ticker-wrap">
                <div class="n-ticker-track">
                    @foreach([$testimonials, $testimonials] as $group)
                        @foreach($group as $t)
                            <div class="n-testi-card">
                                <iconify-icon icon="mdi:format-quote-open" class="n-testi-quote-icon"></iconify-icon>
                                <p class="n-testi-text">{{ $t->message ?? $t->content ?? '-' }}</p>
                                <div class="n-testi-author">
                                    <div class="n-testi-avatar">
                                        {{ strtoupper(substr($t->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="n-testi-name">{{ $t->name }}</p>
                                        @if(isset($t->role))
                                            <p class="n-testi-role">{{ $t->role }}</p>
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
    <section class="n-cta-section">
        <div class="n-cta-pattern"></div>
        <div class="n-container n-cta-content section-reveal">
            <iconify-icon icon="mdi:mosque" class="n-cta-icon"></iconify-icon>
            <h2 class="n-cta-title">Mari Bersama Memakmurkan<br>Masjid Al-Kautsar</h2>
            <p class="n-cta-desc">
                Setiap donasi, kehadiran di kajian, dan doa yang tulus adalah sumbangsih nyata bagi kemakmuran masjid dan peradaban umat.
            </p>
            <div class="n-cta-btns">
                <a href="{{ route('zakat') }}" class="n-btn-cta-primary">
                    <iconify-icon icon="mdi:hand-coin-outline"></iconify-icon>
                    Bayar Zakat Fitrah
                </a>
                <a href="{{ route('contact.index') }}" class="n-btn-cta-glass">
                    <iconify-icon icon="mdi:message-text-outline"></iconify-icon>
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
    // PRAYER WIDGET
    // ================================================================
    function prayerWidget() {
        return {
            loading: true,
            prayers: [
                { name: 'Subuh',   icon: 'mdi:weather-night',              time: '--:--' },
                { name: 'Dzuhur',  icon: 'mdi:weather-sunny',              time: '--:--' },
                { name: 'Ashar',   icon: 'mdi:weather-partly-cloudy',      time: '--:--' },
                { name: 'Maghrib', icon: 'mdi:weather-sunset',             time: '--:--' },
                { name: 'Isya',    icon: 'mdi:weather-night-partly-cloudy',time: '--:--' },
            ],
            nextPrayerName: '',
            nextPrayerLabel: '—',
            todayLabel: '',
            countdown: '00:00:00',
            nextPrayerTime: null,
            _timer: null,

            async init() {
                const now = new Date();
                const days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                this.todayLabel = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

                const cityId  = '74db120f0a8e5646ef5a30154e9f6deb';
                const dateStr = `${now.getFullYear()}-${String(now.getMonth()+1).padStart(2,'0')}-${String(now.getDate()).padStart(2,'0')}`;

                try {
                    const resp = await fetch(`https://api.myquran.com/v3/sholat/jadwal/${cityId}/${dateStr}`);
                    const json = await resp.json();
                    if (json.status && json.data && json.data.jadwal) {
                        const j = json.data.jadwal[dateStr];
                        if (j) {
                            this.prayers[0].time = j.subuh;
                            this.prayers[1].time = j.dzuhur;
                            this.prayers[2].time = j.ashar;
                            this.prayers[3].time = j.maghrib;
                            this.prayers[4].time = j.isya;
                        }
                    }
                } catch (e) { console.warn('Prayer API error:', e); }

                this.loading = false;
                this.updateNext();
                this._timer = setInterval(() => this.tick(), 1000);
            },

            parseTime(str) {
                if (!str || str === '--:--') return null;
                const [h, m] = str.split(':').map(Number);
                const d = new Date(); d.setHours(h, m, 0, 0); return d;
            },

            updateNext() {
                const now = new Date();
                let found = false;
                for (const p of this.prayers) {
                    const t = this.parseTime(p.time);
                    if (t && t > now) {
                        this.nextPrayerName  = p.name;
                        this.nextPrayerLabel = `${p.name} — ${p.time}`;
                        this.nextPrayerTime  = t;
                        found = true; break;
                    }
                }
                if (!found) { this.nextPrayerName = 'Subuh'; this.nextPrayerLabel = 'Subuh (besok)'; this.nextPrayerTime = null; }
            },

            tick() {
                if (!this.nextPrayerTime) { this.countdown = '—'; return; }
                const diff = Math.max(0, this.nextPrayerTime - new Date());
                if (diff === 0) { this.updateNext(); return; }
                const h = String(Math.floor(diff / 3600000)).padStart(2,'0');
                const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2,'0');
                const s = String(Math.floor((diff % 60000) / 1000)).padStart(2,'0');
                this.countdown = `${h}:${m}:${s}`;
            },
        };
    }

    // ================================================================
    // INFAQ FORM
    // ================================================================
    function infaqForm() {
        return {
            formData: { name: '', donation_category_id: '', amount: '' },
            isLoading: false,
            showModal: false,
            responseData: {},

            submitForm() {
                this.isLoading = true;
                fetch('{{ route("donation.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.formData)
                })
                .then(r => r.json())
                .then(data => {
                    this.isLoading = false;
                    if (data.success) {
                        this.responseData = data.data;
                        this.showModal = true;
                        this.formData = { name: '', donation_category_id: '', amount: '' };
                    } else {
                        alert('Gagal: ' + data.message);
                    }
                })
                .catch(() => {
                    this.isLoading = false;
                    alert('Terjadi kesalahan, silakan coba lagi.');
                });
            },

            closeModal() { this.showModal = false; },

            getWaLink() {
                const phone    = '6282329621484';
                const name     = this.responseData.donation_name || 'Hamba Allah';
                const code     = this.responseData.donation_code || '';
                const category = this.responseData.category_name || '';
                const nominal  = (this.responseData.total_amount || 0).toLocaleString('id-ID');
                const text     = `Assalamu'alaikum, saya ${name} dengan Kode Donasi *${code}* bermaksud melakukan konfirmasi untuk Infaq/Sedekah program *${category}* dengan nominal sebesar Rp ${nominal}. Berikut ini adalah lampiran bukti transfer saya.`;
                return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
            }
        };
    }
</script>
@endpush
