@extends('layouts.app')

@section('title', 'Beranda | Masjid Al-Kautsar Cempolorejo')

@section('content')

{{-- HERO --}}
<section class="relative h-screen overflow-hidden flex justify-center items-center">
    <!-- Background -->
    <div class="absolute inset-0 bg-[url('/images/bg-hero.jpg')] bg-cover bg-center transition-all duration-700"></div>
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/45 backdrop-blur-[3px] z-[1] flex flex-col justify-center items-center text-center text-white">
        <div class="relative z-[2] bg-[#f0bb3f90] px-[400px] py-[26px] backdrop-blur-[10px] text-center">
            <h1 class="text-[2.6rem] font-semibold text-white mb-[15px] drop-shadow-[2px_4px_2px_rgba(0,0,0,0.33)]">
                Masjid Al Kautsar Cempolorejo Semarang
            </h1>
            <p class="font-[var(--font-script)] text-[2.2rem]">
                “Dakwah. Ukhuwah. Together to Jannah”
            </p>
        </div>   
        <div id="live-clock" class="text-[2.0rem] mt-2 text-white"></div>
        <marquee id="prayer-marquee" behavior="scroll" direction="left" scrollamount="6" class="mt-1 text-[#f0bb3f]">Memuat jadwal sholat Semarang...</marquee>
    </div>
</section>

{{-- ABOUT --}}
<section class="py-[60px] bg-[#fff8dc]">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
        <div class="bg-[#fff1cc] rounded-xl p-8 shadow-sm text-center">
            <iconify-icon icon="mdi:mosque" class="text-5xl text-[#b8860b]"></iconify-icon>
            <h3 class="text-[#b8860b] font-[var(--font-heading)] text-xl mt-4">Tentang Kami</h3>
            <p class="mt-2 text-sm md:text-base">Masjid Al Kautsar Cempolorejo ingin bertumbuh menjadi ruang baik bagi seluruh jamaah, memakmurkan masjid, dan membangun peradaban umat.</p>
        </div>

        <div class="bg-[#fff1cc] rounded-xl p-8 shadow-sm text-center">
            <iconify-icon icon="ph:hand-heart" class="text-5xl text-[#b8860b]"></iconify-icon>
            <h3 class="text-[#b8860b] font-[var(--font-heading)] text-xl mt-4">Dukung Kami</h3>
            <p class="mt-2 text-sm md:text-base">Seluruh elemen Islam bisa mendukung keuangan dan program melalui infaq, zakat, dan sedekah. Mari bergandeng tangan bersama!</p>
        </div>

        <div class="bg-[#fff1cc] rounded-xl p-8 shadow-sm text-center">
            <iconify-icon icon="mdi:clipboard-list-outline" class="text-5xl text-[#b8860b]"></iconify-icon>
            <h3 class="text-[#b8860b] font-[var(--font-heading)] text-xl mt-4">Pengelolaan Masjid</h3>
            <p class="mt-2 text-sm md:text-base">Kami bertekad mengelola masjid dengan transparan dan akuntabel, selaras kebutuhan jamaah dan masyarakat sekitar.</p>
        </div>
    </div>
</section>

{{-- PROFILE --}}
<section class="relative py-[60px] bg-[url('/images/bg-profile.jpg')] bg-repeat-round bg-center">
    <div class="absolute inset-0 bg-[#fff8dc]/80"></div>
    <div class="relative container mx-auto text-center px-6">
        <h2 class="text-[#b8860b] font-[var(--font-heading)] text-2xl md:text-3xl font-semibold">Profil Masjid Al Kautsar Cempolorejo</h2>
        <p class="mt-8 max-w-3xl mx-auto text-[#1C1C1C] text-[15px] md:text-[17px]">
            Masjid Al Kautsar Cempolorejo, berdiri pada akhir tahun 2000 dan mula-mula hanya sebuah masjid kecil.
            Kemudian dikembangkan untuk menjadi masjid yang mampu dimakmurkan masyarakat sekitar. Cita-citanya agar
            di kemudian hari, masjid mampu menjadi pusat peradaban, tempat berkumpul serta bahu-membahu untuk
            solusi bersama dalam menyelesaikan permasalahan umat.
        </p>
    </div>
</section>

@endsection
