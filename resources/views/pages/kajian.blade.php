@extends('layouts.app')

@section('title', 'Informasi Kajian | Masjid Al-Kautsar Cempolorejo')

@section('content')

    {{-- ================================================================
    HERO SECTION
    ================================================================ --}}
    <section class="relative bg-slate-950 min-h-[72vh] flex items-center overflow-hidden">
        {{-- Animated background grid --}}
        <div class="absolute inset-0 opacity-[0.04]" style="background-image: url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>

        {{-- Glow blobs --}}
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/3 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
                {{-- Left: Text Content --}}
                <div>
                    <div class="inline-flex items-center gap-2 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                        <iconify-icon icon="mdi:book-open-page-variant"></iconify-icon>
                        Program Kajian Islam
                    </div>
                    <h1 class="font-raleway font-black text-5xl sm:text-6xl text-white leading-tight mb-5">
                        Majelis <span class="text-yellow-400">Ilmu</span><br>Al-Kautsar
                    </h1>
                    <p class="text-slate-300 text-base md:text-lg leading-relaxed mb-8 max-w-lg">
                        Jadwal kajian rutin, kajian tematik, dan kajian spesial bersama para ustadz pilihan. Gratis dan terbuka untuk seluruh jamaah.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#kajian-all"
                            class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold px-7 py-3.5 rounded-full transition-all duration-200 shadow-lg shadow-yellow-500/30 hover:-translate-y-0.5">
                            <iconify-icon icon="mdi:calendar-search"></iconify-icon>
                            Lihat Jadwal
                        </a>
                        <a href="{{ route('contact.index') }}"
                            class="inline-flex items-center gap-2 border border-white/20 hover:border-white/50 text-white font-semibold px-7 py-3.5 rounded-full transition-all duration-200 backdrop-blur-sm hover:-translate-y-0.5">
                            <iconify-icon icon="mdi:message-outline"></iconify-icon>
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                {{-- Right: Nearest Event Card --}}
                @if($agendaTerdekat)
                    <div class="lg:justify-self-end w-full max-w-md">
                        <div class="relative bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-7 shadow-2xl overflow-hidden group hover:bg-white/8 transition-all duration-300">
                            {{-- Decorative corner accent --}}
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-yellow-500/20 rounded-full blur-2xl"></div>

                            <div class="flex items-center gap-2 mb-5">
                                <span class="flex items-center gap-1.5 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-[11px] font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full animate-ping"></span>
                                    Agenda Terdekat
                                </span>
                            </div>

                            <p class="text-yellow-400 text-xs font-bold uppercase tracking-widest mb-1.5">
                                {{ $agendaTerdekat->kajian->kajianCategory->name ?? 'Kajian' }}
                            </p>
                            <h3 class="text-white font-bold text-xl mb-2 leading-snug">
                                {{ $agendaTerdekat->kajian->title ?? '' }}
                            </h3>
                            @if($agendaTerdekat->sub_title)
                                <p class="text-slate-400 text-sm mb-5 leading-relaxed">{{ $agendaTerdekat->sub_title }}</p>
                            @endif

                            <div class="space-y-2.5 mb-6">
                                <div class="flex items-center gap-3 text-sm text-slate-300">
                                    <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                        <iconify-icon icon="mdi:account" class="text-yellow-400"></iconify-icon>
                                    </div>
                                    <span>{{ $agendaTerdekat->ustadz->name ?? '' }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-slate-300">
                                    <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                        <iconify-icon icon="mdi:calendar" class="text-yellow-400"></iconify-icon>
                                    </div>
                                    <span>
                                        {{ \Carbon\Carbon::parse($agendaTerdekat->date)->locale('id')->isoFormat('D MMMM YYYY') }}
                                        &bull;
                                        @if($agendaTerdekat->time_type === 'fixed')
                                            {{ \Carbon\Carbon::parse($agendaTerdekat->start_time)->format('H:i') }} WIB
                                        @else
                                            {{ $agendaTerdekat->time_phrase }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-sm text-slate-300">
                                    <div class="w-7 h-7 rounded-lg bg-white/10 flex items-center justify-center shrink-0">
                                        <iconify-icon icon="mdi:map-marker" class="text-yellow-400"></iconify-icon>
                                    </div>
                                    <span>{{ $agendaTerdekat->location->name ?? '' }}</span>
                                </div>
                            </div>

                            <a href="{{ route('kajian.show', $agendaTerdekat->id) }}"
                                class="w-full bg-yellow-500 hover:bg-yellow-400 text-slate-900 font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all duration-200 group-hover:shadow-lg group-hover:shadow-yellow-500/20">
                                <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                                Lihat Detail Kajian
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Decorative stats if no event --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
                            <iconify-icon icon="mdi:mosque" class="text-yellow-400 text-3xl mb-2"></iconify-icon>
                            <p class="text-white font-bold text-xl">Setiap Ahad</p>
                            <p class="text-slate-400 text-xs mt-1">Kajian Rutin</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center">
                            <iconify-icon icon="mdi:book-open" class="text-emerald-400 text-3xl mb-2"></iconify-icon>
                            <p class="text-white font-bold text-xl">Gratis</p>
                            <p class="text-slate-400 text-xs mt-1">Terbuka Umum</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-2xl p-5 text-center col-span-2">
                            <iconify-icon icon="mdi:microphone" class="text-blue-400 text-3xl mb-2"></iconify-icon>
                            <p class="text-white font-bold text-xl">Ustadz Berpengalaman</p>
                            <p class="text-slate-400 text-xs mt-1">Dipilih & Berkualitas</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ================================================================
    MAIN CONTENT SECTION (Livewire Kajian List)
    ================================================================ --}}
    <livewire:kajian-list />

@endsection