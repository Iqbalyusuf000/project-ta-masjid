<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Masjid Al-Kautsar Cempolorejo')</title>

    <script src="https://cdn.jsdelivr.net/npm/iconify-icon/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.all.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Raleway:wght@400;700&family=Great+Vibes&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.24/dist/sweetalert2.min.css" rel="stylesheet">

    {{-- Tailwind (via Vite or CDN sesuai setup kamu) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-lato text-secondary scroll-smooth">

    @include('layouts.partials.header')

    <main class="pt-18 lg:pt-20">
        @yield('content')
    </main>

    @include('layouts.partials.footer')


    @stack('scripts')
</body>

</html>