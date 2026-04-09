<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Masjid Al-Kautsar Cempolorejo')</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Raleway:wght@400;700&family=Great+Vibes&display=swap" rel="stylesheet">

    {{-- Tailwind (via Vite or CDN sesuai setup kamu) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans text-[#1C1C1C]">

    @include('layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')
    @include('layouts.partials.scripts')

    @stack('scripts')
</body>
</html>
