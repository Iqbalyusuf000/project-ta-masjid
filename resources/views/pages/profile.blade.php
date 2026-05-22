@extends('layouts.app')

@section('title', 'Visi & Misi | Masjid Al-Kautsar Cempolorejo')

@section('content')

    {{-- Prayer Time --}}
    <section class="pt-2 pb-2">
        <div class="container mx-auto px-4 lg:px-10">
            @include('components.prayer-time')
        </div>
    </section>

    <section class="bg-neutral min-h-screen py-6">

        <div class="container mx-auto px-4 lg:px-8">

            {{-- HERO --}}
            <section class="relative overflow-hidden rounded-2xl">

                {{-- Background --}}
                <img src="{{ asset('images/masjid-alkautsar.jpeg') }}" alt="Masjid Banner"
                    class="w-full h-[260px] md:h-[380px] object-cover">

                {{-- Overlay --}}
                <div class="absolute inset-0 bg-black/45"></div>

                {{-- Content --}}
                <div class="absolute inset-0 flex flex-col justify-end p-6 lg:p-10 text-white">

                    <span
                        class="w-fit bg-primary text-white text-[10px] sm:text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">
                        Didirikan pada 1992
                    </span>

                    <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold mb-3 leading-tight">
                        Masjid Al Kautsar Cempolorejo
                    </h1>

                    <p class="italic text-stone-200 text-sm lg:text-base max-w-3xl leading-7">
                        "Dan berpegangteguhlah kamu semuanya pada tali (agama) Allah,
                        dan janganlah kamu bercerai berai"
                    </p>

                </div>

            </section>

            {{-- Divider --}}
            <div class="bg-primary w-full h-1 my-6 rounded-full"></div>

            {{-- MOBILE/TABLET FLOATING TAB --}}
            <div class="lg:hidden sticky top-[78px] z-50 mb-6">

                <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-stone-200 p-2">

                    <div class="flex gap-2 overflow-x-auto scrollbar-hide">

                        {{-- History --}}
                        <a href="#history"
                            class="nav-link flex items-center gap-2 px-4 py-3 rounded-xl font-semibold whitespace-nowrap shrink-0 transition-all duration-300 bg-primary text-white">

                            <iconify-icon icon="mdi:history" class="text-lg"></iconify-icon>

                            <span>Sejarah Masjid</span>
                        </a>

                        {{-- Vision Mission --}}
                        <a href="#vision-mission"
                            class="nav-link flex items-center gap-2 px-4 py-3 rounded-xl font-semibold whitespace-nowrap shrink-0 transition-all duration-300 text-secondary hover:bg-stone-100">

                            <iconify-icon icon="mdi:star-four-points-outline" class="text-lg"></iconify-icon>

                            <span>Visi Misi</span>
                        </a>

                        {{-- Struktur Organisasi --}}
                        <a href="#organization"
                            class="nav-link flex items-center gap-2 px-4 py-3 rounded-xl font-semibold whitespace-nowrap shrink-0 transition-all duration-300 text-secondary hover:bg-stone-100">

                            <iconify-icon icon="mdi:organization" class="text-lg"></iconify-icon>

                            <span>Struktur Organisasi</span>
                        </a>

                    </div>

                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- DESKTOP SIDEBAR --}}
                <aside class="hidden lg:block lg:col-span-3">

                    <div class="sticky top-28">

                        <div class="bg-white rounded-3xl shadow-sm border border-stone-200 p-4">

                            <div class="space-y-2">

                                {{-- History --}}
                                <a href="#history"
                                    class="desktop-nav-link flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition-all duration-300 bg-primary text-white">

                                    <iconify-icon icon="mdi:history" class="text-lg"></iconify-icon>

                                    <span>Sejarah Masjid</span>
                                </a>

                                {{-- Vision Mission --}}
                                <a href="#vision-mission"
                                    class="desktop-nav-link flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-secondary hover:bg-stone-100">

                                    <iconify-icon icon="mdi:star-four-points-outline" class="text-lg"></iconify-icon>

                                    <span>Visi Misi</span>
                                </a>

                                {{-- Struktur Organisasi --}}
                                <a href="#organization"
                                    class="desktop-nav-link flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition-all duration-300 text-secondary hover:bg-stone-100">

                                    <iconify-icon icon="mdi:account-child" class="text-lg"></iconify-icon>

                                    <span>Struktur Organisasi</span>
                                </a>

                            </div>

                        </div>

                    </div>

                </aside>

                {{-- CONTENT --}}
                <div class="lg:col-span-9 space-y-8">

                    {{-- HISTORY --}}
                    <section id="history"
                        class="bg-white rounded-3xl shadow-sm border border-stone-200 p-6 sm:p-8 lg:p-12 scroll-mt-36 lg:scroll-mt-28">

                        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-secondary mb-6">
                            Sejarah Kami
                        </h2>

                        <div class="space-y-6 text-stone-600 leading-8 text-sm md:text-base">

                            <p>
                                Didirikan pada tahun 1999, Masjid Al-Kautsar Cempolorejo
                                berawal sebagai mushola kecil yang dibangun oleh salah satu warga
                                setempat sebagai tempat terdekat untuk beribadah dan berkumpul
                                bersama komunitas muslim terdekat.
                            </p>

                            {{-- Images --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-7 lg:gap-10">

                                <img src="{{ asset('images/history-1.jpg') }}" alt="History"
                                    class="rounded-2xl h-72 w-full object-cover">

                                <img src="{{ asset('images/history-2.jpeg') }}" alt="History"
                                    class="rounded-2xl h-72 w-full object-cover">

                            </div>

                            <p>
                                Seiring berjalannya waktu, Masjid Al-Kautsar Cempolorejo
                                telah melakukan banyak perubahan dan pembangunan, termasuk
                                pembangunan menjadi masjid yang luas pada tahun 2005.
                            </p>

                        </div>

                    </section>

                    {{-- VISION MISSION --}}
                    <section id="vision-mission"
                        class="bg-primary/50 border border-primary/50 rounded-3xl p-6 lg:p-10 scroll-mt-36 lg:scroll-mt-28">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                            {{-- Vision --}}
                            <div>

                                <div class="flex items-center gap-3 mb-5">

                                    <div
                                        class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center shrink-0">

                                        <iconify-icon icon="mdi:eye-outline" class="text-xl"></iconify-icon>
                                    </div>

                                    <h3 class="text-2xl font-bold text-secondary">
                                        Vision
                                    </h3>

                                </div>

                                <p class="text-stone-700 leading-9 text-sm md:text-base">
                                    {{ $visionMission->visi }}
                                </p>

                            </div>

                            {{-- Mission --}}
                            <div>

                                <div class="flex items-center gap-3 mb-5">

                                    <div
                                        class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center shrink-0">

                                        <iconify-icon icon="mdi:bullseye-arrow" class="text-xl"></iconify-icon>
                                    </div>

                                    <h3 class="text-2xl font-bold text-secondary">
                                        Mission
                                    </h3>

                                </div>

                                <ul class="space-y-5 text-stone-700 text-sm md:text-base">

                                    @foreach ($visionMission->misi as $misi)
                                        <li class="flex gap-4 leading-8">

                                            <span class="w-2.5 h-2.5 rounded-full bg-primary mt-3 shrink-0"></span>

                                            <span>
                                                {{ $misi }}
                                            </span>

                                        </li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    </section>

                    {{-- ORGANIZATION STRUCTURE --}}
                    <section id="organization"
                        class="bg-white rounded-3xl shadow-sm border border-stone-200 p-6 sm:p-8 lg:p-12 scroll-mt-36 lg:scroll-mt-28">

                        <div class="container mx-auto px-4 lg:px-8">

                            {{-- Heading --}}
                            <div class="text-center mb-14">

                                <h2 class="text-2xl lg:text-3xl font-bold text-secondary mb-4">
                                    Struktur Organisasi Masjid
                                </h2>

                            </div>

                            {{-- BAGAN ORGANISASI --}}

                            {{-- ORGANIZATION FLOW --}}
                            <div class="relative">

                                <div class="space-y-14">

                                    {{-- ========================================= --}}
                                    {{-- PENASEHAT --}}
                                    {{-- ========================================= --}}
                                    <section class="mb-12">

                                        <div class="flex items-center gap-3 mb-6">

                                            <div class="w-2 h-10 bg-primary rounded-full"></div>

                                            <div>
                                                <h2 class="text-lg lg:text-xl font-bold text-secondary">
                                                    Dewan Penasehat
                                                </h2>
                                            </div>

                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                                            @foreach ($advisors as $advisor)
                                                <div
                                                    class="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                                                    <div class="h-2 bg-primary"></div>

                                                    <div class="p-4 text-center">

                                                        <x-member-avatar :member="$advisor->member" size="w-24 h-24"
                                                            textSize="text-3xl" />

                                                        <div class="mt-5">

                                                            <h3 class="text-xl font-bold text-secondary">
                                                                {{ $advisor->member->name ?? 'Nama Pengurus'}}
                                                            </h3>

                                                            <p
                                                                class="mt-2 inline-flex bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                                                                {{ $advisor->position->name ?? 'Posisi Pengurus' }}
                                                            </p>

                                                        </div>

                                                    </div>

                                                </div>
                                            @endforeach

                                        </div>

                                    </section>

                                    <section class="my-12">
                                        <div class="flex items-center gap-3 mb-6">

                                            <div class="w-2 h-10 bg-primary rounded-full"></div>

                                            <div>
                                                <h2 class="text-lg lg:text-xl font-bold text-secondary">
                                                    Pengurus Harian
                                                </h2>
                                            </div>

                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                                            {{-- Ketua --}}
                                            @if($chairman)
                                                <div
                                                    class="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                                                    <div class="h-2 bg-primary"></div>

                                                    <div class="p-4 text-center">

                                                        <x-member-avatar :member="$chairman->member" size="w-24 h-24"
                                                            textSize="text-3xl" />

                                                        <div class="mt-5">

                                                            <h3 class="text-lg font-bold text-secondary">
                                                                {{ $chairman->member->name ?? 'Nama Pengurus'}}
                                                            </h3>

                                                            <p
                                                                class="mt-2 inline-flex bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                                                                {{ $chairman->position->name ?? 'Posisi Pengurus' }}
                                                            </p>

                                                        </div>

                                                    </div>

                                                </div>
                                            @endif

                                            {{-- Sekretaris --}}
                                            @if ($secretary)
                                                <div
                                                    class="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                                                    <div class="h-2 bg-primary"></div>

                                                    <div class="p-4 text-center">

                                                        <x-member-avatar :member="$secretary->member" size="w-24 h-24"
                                                            textSize="text-3xl" />

                                                        <div class="mt-5">

                                                            <h3 class="text-lg font-bold text-secondary">
                                                                {{ $secretary->member->name ?? 'Nama Pengurus'}}
                                                            </h3>

                                                            <p
                                                                class="mt-2 inline-flex bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                                                                {{ $secretary->position->name ?? 'Posisi Pengurus'}}
                                                            </p>

                                                        </div>

                                                    </div>

                                                </div>
                                            @endif


                                            {{-- Bendahara --}}
                                            @if ($treasurer)
                                                <div
                                                    class="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">

                                                    <div class="h-2 bg-primary"></div>

                                                    <div class="p-4 text-center">

                                                        <x-member-avatar :member="$treasurer->member" size="w-24 h-24"
                                                            textSize="text-3xl" />

                                                        <div class="mt-5">

                                                            <h3 class="text-lg font-bold text-secondary">
                                                                {{ $treasurer->member->name ?? 'Nama Pengurus' }}
                                                            </h3>

                                                            <p
                                                                class="mt-2 inline-flex bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                                                                {{ $treasurer->position->name ?? 'Posisi Pengurus' }}
                                                            </p>

                                                        </div>

                                                    </div>

                                                </div>
                                            @endif

                                        </div>

                                </div>

                            </div>

                            {{-- ========================================= --}}
                            {{-- SEKSI --}}
                            {{-- ========================================= --}}
                            <div>

                                <div class="flex items-center gap-3 mb-6">

                                    <div class="w-2 h-10 bg-primary rounded-full"></div>

                                    <div>
                                        <h2 class="text-lg lg:text-xl font-bold text-secondary">
                                            Pengurus Organisasi
                                        </h2>
                                    </div>

                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                                    {{-- Bidang --}}

                                    @foreach ($divisions as $divisionName => $members)
                                        <div
                                            class="bg-white rounded-3xl border border-stone-200 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">

                                            {{-- Header --}}
                                            <div class="bg-primary px-6 py-5">

                                                <h3 class="text-white font-bold text-base leading-7">
                                                    {{ $divisionName }}
                                                </h3>

                                            </div>

                                            {{-- Members --}}
                                            <div class="p-6 space-y-5">

                                                @foreach ($members as $organization)
                                                    <div
                                                        class="flex items-center gap-4 border border-stone-100 rounded-2xl p-4 hover:bg-stone-50 transition-all">

                                                        {{-- Photo --}}
                                                        <div
                                                            class="w-14 h-14 rounded-full overflow-hidden border-2 border-primary/20 shrink-0">

                                                            @if ($organization->member->photo)
                                                                <img src="{{ Storage::url($organization->member->photo) }}"
                                                                    alt="{{ $organization->member->name }}"
                                                                    class="w-full h-full object-cover">
                                                            @else

                                                                @php
                                                                    $initials = collect(explode(' ', $organization->member->name))
                                                                        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                                                                        ->take(2)
                                                                        ->join('');
                                                                @endphp

                                                                <div class="w-28 h-28 rounded-full mx-auto border-4 border-primary/20 shadow-sm
                                                                                                    bg-primary text-white flex items-center justify-center
                                                                                                    text-3xl font-bold">

                                                                    {{ $initials }}

                                                                </div>

                                                            @endif

                                                        </div>

                                                        {{-- Info --}}
                                                        <div>

                                                            <h4 class="font-bold text-secondary leading-6">
                                                                {{ $organization->member->name ?? 'Nama Pengurus'}}
                                                            </h4>

                                                            <p class="text-sm text-stone-500">
                                                                {{ $organization->position->name ?? 'Posisi Pengurus'}}
                                                            </p>

                                                        </div>

                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>
                    </section>

                </div>

            </div>

        </div>

    </section>

    </div>

    </div>

    </div>

    </section>

@endsection