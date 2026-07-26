<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Masjid Al-Kautsar Cempolorejo')</title>
    <meta name="description" content="@yield('description', 'Masjid Al-Kautsar Cempolorejo — Pusat dakwah, ukhuwah, dan peradaban umat Islam.')">

    {{-- Preconnect to external origins (must be very first) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://api.myquran.com">

    {{-- Page-level preloads (e.g., LCP image on home page) --}}
    @stack('preloads')

    {{-- Google Fonts: non-blocking --}}
    <link
        rel="preload"
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Raleway:wght@400;700&family=Great+Vibes&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Raleway:wght@400;700&family=Great+Vibes&display=swap"></noscript>

    {{-- SweetAlert CSS: non-blocking --}}
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.min.css"></noscript>

    {{-- Vite compiled CSS + JS (CSS is render-critical, JS is deferred by Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- CDN Scripts: all deferred --}}
    <script defer src="https://cdn.jsdelivr.net/npm/iconify-icon/dist/iconify-icon.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.all.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>

<body class="font-lato text-secondary scroll-smooth">

    @include('layouts.partials.header')

    <main class="pt-18 lg:pt-20">
        @yield('content')
    </main>

    @include('layouts.partials.footer')


    @stack('scripts')

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#d97706',
            });
        </script>
    @endif
</body>

</html>