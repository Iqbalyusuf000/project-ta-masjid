<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Masjid Al-Kautsar Cempolorejo')</title>
    <meta name="description" content="@yield('description', 'Masjid Al-Kautsar Cempolorejo — Pusat dakwah, ukhuwah, dan peradaban umat Islam.')">

    {{-- Preconnect --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://api.myquran.com">

    {{-- Page-level preloads --}}
    @stack('preloads')

    {{-- Google Fonts: non-blocking --}}
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Raleway:wght@400;500;700;800&family=Great+Vibes&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Raleway:wght@400;500;700;800&family=Great+Vibes&display=swap"></noscript>

    {{-- SweetAlert CSS: non-blocking --}}
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.min.css"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.min.css"></noscript>

    {{-- Native CSS --}}
    <link rel="stylesheet" href="{{ asset('css/native-style.css') }}">

    {{-- CDN Scripts: all deferred --}}
    <script defer src="https://cdn.jsdelivr.net/npm/iconify-icon/dist/iconify-icon.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.all.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>

<body>

    {{-- HEADER --}}
    <header class="n-header">
        <div class="n-header-inner">

            {{-- Logo --}}
            <div class="n-logo">
                <img src="{{ asset('images/logo-alkautsar.webp') }}" alt="Logo Al-Kautsar">
                <p class="n-logo-name">
                    <span class="n-logo-masjid">Masjid</span>
                    <span class="n-logo-alkautsar">Al Kautsar Cempolorejo</span>
                </p>
            </div>

            {{-- Desktop Nav --}}
            <nav class="n-nav-desktop">
                <ul class="n-nav-list">
                    <li>
                        <a href="{{ route('home') }}" class="n-nav-link {{ request()->routeIs('home.native') ? 'n-nav-link-active' : '' }}">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile') }}" class="n-nav-link {{ request()->routeIs('profile') ? 'n-nav-link-active' : '' }}">
                            Profil
                        </a>
                    </li>
                    <li class="n-nav-dropdown-wrap">
                        <button class="n-nav-link n-nav-dropdown-btn">
                            Unit Usaha Masjid <iconify-icon icon="mdi:chevron-down"></iconify-icon>
                        </button>
                        <div class="n-dropdown">
                            <a href="{{ route('water-refill') }}" class="n-dropdown-item">Air Isi Ulang - ALKA</a>
                            <a href="{{ route('hajj') }}" class="n-dropdown-item">Biro Haji & Umroh</a>
                        </div>
                    </li>
                    <li class="n-nav-dropdown-wrap">
                        <button class="n-nav-link n-nav-dropdown-btn">
                            Program <iconify-icon icon="mdi:chevron-down"></iconify-icon>
                        </button>
                        <div class="n-dropdown">
                            <a href="{{ route('kajian') }}" class="n-dropdown-item">Informasi Kajian Islam</a>
                            <a href="{{ route('zakat') }}" class="n-dropdown-item">Zakat, Infaq & Sedekah</a>
                            <a href="{{ route('itikaf') }}" class="n-dropdown-item">I'tikaf Ramadan</a>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('financial-report') }}" class="n-nav-link {{ request()->routeIs('financial-report') ? 'n-nav-link-active' : '' }}">
                            Laporan Keuangan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact.index') }}" class="n-nav-link {{ request()->routeIs('contact.index') ? 'n-nav-link-active' : '' }}">
                            Kontak
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Mobile Toggle --}}
            <button class="n-mobile-toggle" id="n-mobile-btn" aria-label="Toggle menu">
                <iconify-icon icon="mdi:menu" id="n-menu-icon"></iconify-icon>
            </button>

        </div>

        {{-- Mobile Menu --}}
        <div class="n-mobile-menu" id="n-mobile-menu">
            <div class="n-mobile-menu-inner">
                <a href="{{ route('home') }}" class="n-mobile-link">
                    <iconify-icon icon="lucide:home"></iconify-icon> Beranda
                </a>
                <a href="{{ route('profile') }}" class="n-mobile-link">
                    <iconify-icon icon="lucide:user"></iconify-icon> Profil
                </a>
                <div class="n-mobile-group">
                    <button class="n-mobile-group-btn" id="n-unit-btn">
                        <span><iconify-icon icon="lucide:store"></iconify-icon> Unit Usaha Masjid</span>
                        <iconify-icon icon="mdi:chevron-down" id="n-unit-icon"></iconify-icon>
                    </button>
                    <div class="n-mobile-group-items" id="n-unit-menu">
                        <a href="{{ route('water-refill') }}" class="n-mobile-sublink">Air Isi Ulang - ALKA</a>
                        <a href="{{ route('hajj') }}" class="n-mobile-sublink">Biro Haji & Umroh</a>
                    </div>
                </div>
                <div class="n-mobile-group">
                    <button class="n-mobile-group-btn" id="n-program-btn">
                        <span><iconify-icon icon="lucide:calendar"></iconify-icon> Program</span>
                        <iconify-icon icon="mdi:chevron-down" id="n-program-icon"></iconify-icon>
                    </button>
                    <div class="n-mobile-group-items" id="n-program-menu">
                        <a href="{{ route('kajian') }}" class="n-mobile-sublink">Informasi Kajian Islam</a>
                        <a href="{{ route('zakat') }}" class="n-mobile-sublink">Zakat, Infaq & Sedekah</a>
                        <a href="{{ route('itikaf') }}" class="n-mobile-sublink">I'tikaf Ramadan</a>
                    </div>
                </div>
                <a href="{{ route('financial-report') }}" class="n-mobile-link">
                    <iconify-icon icon="lucide:file-text"></iconify-icon> Laporan Keuangan
                </a>
                <a href="{{ route('contact.index') }}" class="n-mobile-link">
                    <iconify-icon icon="lucide:phone"></iconify-icon> Kontak
                </a>
            </div>
        </div>
    </header>

    <main class="n-main">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="n-footer">
        <div class="n-footer-inner">
            <div class="n-footer-grid">

                {{-- Col 1 --}}
                <div class="n-footer-col n-footer-col-wide">
                    <div class="n-footer-brand">
                        <img src="{{ asset('images/logo-alkautsar.webp') }}" alt="Logo" class="n-footer-logo">
                        <h3 class="n-footer-brand-name">Masjid Al Kautsar Cempolorejo</h3>
                    </div>
                    <div class="n-footer-contact">
                        <p>Jl. Cempolorejo V No.21, Krobokan, Kec. Semarang Barat,<br>Kota Semarang, Jawa Tengah 50141</p>
                        <p>Email: info@masjid-alkautsar.id</p>
                        <p>Telp: +62 823-2962-1484</p>
                    </div>
                </div>

                {{-- Col 2 --}}
                <div class="n-footer-col">
                    <h3 class="n-footer-col-title">Navigasi</h3>
                    <ul class="n-footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('profile') }}">Profil</a></li>
                        <li><a href="{{ route('financial-report') }}">Laporan Keuangan</a></li>
                        <li><a href="{{ route('contact.index') }}">Kontak</a></li>
                    </ul>
                </div>

                {{-- Col 3 --}}
                <div class="n-footer-col">
                    <h3 class="n-footer-col-title">Layanan Jamaah</h3>
                    <ul class="n-footer-links">
                        <li>Kajian Umum</li>
                        <li>Zakat Infaq dan Sedekah</li>
                        <li>I'tikaf Ramadhan</li>
                    </ul>
                </div>

                {{-- Col 4 --}}
                <div class="n-footer-col">
                    <h3 class="n-footer-col-title">Unit Usaha Masjid</h3>
                    <ul class="n-footer-links">
                        <li><a href="{{ route('water-refill') }}">Isi Ulang Air Mineral Alka</a></li>
                        <li><a href="{{ route('hajj') }}">Biro Haji dan Umroh</a></li>
                    </ul>
                </div>

            </div>

            <div class="n-footer-bottom">
                <p>© 2026 Masjid Al Kautsar Development Team.</p>
                <div class="n-footer-socials">
                    <a href="https://www.instagram.com/masjidalkautsarcmplrjo/" target="_blank" rel="noopener noreferrer" class="n-social-btn" aria-label="Instagram">
                        <iconify-icon icon="mdi:instagram"></iconify-icon>
                    </a>
                    <a href="https://www.youtube.com/@MasjidAlkautsarCempolorejo" target="_blank" rel="noopener noreferrer" class="n-social-btn" aria-label="YouTube">
                        <iconify-icon icon="mdi:youtube"></iconify-icon>
                    </a>
                    <a href="https://www.tiktok.com/@masjidalkautsarcmplrjo" target="_blank" rel="noopener noreferrer" class="n-social-btn" aria-label="TikTok">
                        <iconify-icon icon="akar-icons:tiktok-fill"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

    {{-- Mobile menu JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Mobile toggle
            const mobileBtn = document.getElementById('n-mobile-btn');
            const mobileMenu = document.getElementById('n-mobile-menu');
            const menuIcon = document.getElementById('n-menu-icon');
            if (mobileBtn) {
                mobileBtn.addEventListener('click', function () {
                    const isOpen = mobileMenu.classList.toggle('n-mobile-menu-open');
                    menuIcon.setAttribute('icon', isOpen ? 'mdi:close' : 'mdi:menu');
                });
            }
            // Accordion groups
            function setupAccordion(btnId, menuId, iconId) {
                const btn = document.getElementById(btnId);
                const menu = document.getElementById(menuId);
                const icon = document.getElementById(iconId);
                if (!btn) return;
                btn.addEventListener('click', function () {
                    const isOpen = menu.classList.toggle('n-mobile-group-items-open');
                    if (icon) icon.style.transform = isOpen ? 'rotate(180deg)' : '';
                });
            }
            setupAccordion('n-unit-btn', 'n-unit-menu', 'n-unit-icon');
            setupAccordion('n-program-btn', 'n-program-menu', 'n-program-icon');
        });
    </script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#d97706',
                });
            });
        </script>
    @endif
</body>

</html>
