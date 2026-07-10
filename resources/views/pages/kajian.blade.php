@extends('layouts.app')

@section('title', 'Informasi Kajian | Masjid Al-Kautsar Cempolorejo')

@section('content')

    {{-- Hero Section Premium --}}
    <section class="relative bg-tertiary py-32 overflow-hidden min-h-[60vh] flex items-center">
        {{-- Background Image Masjid dengan Overlay Dark --}}
        <div class="absolute inset-0 bg-cover bg-center z-0"
            style="background-image: url('{{ asset('images/islamic-study.jpg') }}')"></div>
        <div class="absolute inset-0 bg-linear-to-r from-secondary/90 via-secondary/75 to-transparent z-10"></div>

        <div
            class="relative container mx-auto px-6 md:px-2 lg:px-26 z-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Sisi Kiri: Sambutan Permanen --}}
            <div class="text-white space-y-6">
                <span class="text-primary font-semibold tracking-widest uppercase text-sm block">Informasi Kajian
                    Islam</span>
                <h1
                    class="text-4xl md:text-5xl lg:text-6xl text-white font-extrabold tracking-normal font-raleway leading-[60px]">
                    Kajian Rutin &<br><span class="text-primary tracking-wide">Kajian Spesial</span><br>Masjid Al Kautsar
                </h1>
                <p class="text-stone-300 font-light max-w-lg leading-relaxed">
                    Temukan Jadwal Kajian Rutin, Kajian Tematik, dan Kajian Spesial
                    bersama Para Ustadz dan Ulama yang diselenggarakan oleh
                    Masjid Al-Kautsar Cempolorejo.
                </p>
                <div class="flex gap-4">
                    <a href="#kajian-all"
                        class="bg-primary hover:bg-white hover:text-secondary text-white font-medium px-6 py-3 rounded-xl transition-all duration-300 shadow-lg shadow-primary/20">Lihat
                        Jadwal Kajian</a>
                    <a href="{{ route('contact.index') }}"
                        class="border border-white/30 hover:border-white text-white font-medium px-6 py-3 rounded-xl transition-all duration-300">Kontak
                        dan Kritik Saran</a>
                </div>
            </div>

            {{-- Sisi Kanan: KONDISIONAL (Hanya muncul jika ada Kajian Akbar/Terdekat aktif) --}}
            @if($agendaTerdekat)
                <div class="lg:justify-self-end w-full max-w-md">
                    <div
                        class="bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-2xl border border-white/20 relative overflow-hidden animate-fade-in">
                        <div
                            class="absolute top-0 right-0 bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-bl-xl tracking-wider uppercase">
                            Agenda Terdekat
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-primary">
                            {{ $agendaTerdekat->kajian->kajianCategory->name ?? 'Kajian' }}
                        </span>
                        <h3 class="text-secondary font-bold text-xl mt-1 mb-3 leading-snug">
                            {{ $agendaTerdekat->kajian->title ?? '' }}
                        </h3>
                        <div class="space-y-2.5 text-sm text-stone-600 mb-5">
                            <div class="flex items-center gap-2.5">
                                <iconify-icon icon="lucide:user" class="text-primary text-base"></iconify-icon>
                                <span>Bersama: <strong
                                        class="text-stone-800">{{ $agendaTerdekat->ustadz->name ?? '' }}</strong></span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <iconify-icon icon="lucide:calendar" class="text-primary text-base"></iconify-icon>
                                <span>
                                    {{ \Carbon\Carbon::parse($agendaTerdekat->date)->isoFormat('D MMMM YYYY') }} |
                                    @if($agendaTerdekat->time_type === 'fixed')
                                        {{ \Carbon\Carbon::parse($agendaTerdekat->start_time)->format('H:i') }} WIB
                                    @else
                                        {{ $agendaTerdekat->time_phrase }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('kajian.show', $agendaTerdekat->id) }}"
                            class="w-full bg-secondary hover:bg-primary text-white font-semibold py-3 rounded-xl block text-center transition-all duration-300 active:scale-[0.98]">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- 3. MAIN CONTENT SECTION -->
    <livewire:kajian-list />


@endsection