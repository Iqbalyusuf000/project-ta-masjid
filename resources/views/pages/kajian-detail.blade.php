@extends('layouts.app')

@section('title', ($kajianDetail->kajian->title ?? 'Detail Kajian') . ' | Masjid Al-Kautsar Cempolorejo')

@section('content')
    @php
        // Generate Initials for Ustadz Name
        $ustadzName = $kajianDetail->ustadz->name ?? 'Ustadz';
        $cleanName = preg_replace('/^(ustadz|ust\.|dr\.|h\.|haji)\s+/i', '', $ustadzName);
        $words = explode(' ', $cleanName);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        $initials = substr($initials, 0, 2);
    @endphp

    <div class="bg-slate-50 text-slate-800 antialiased min-h-screen pb-16">

        {{-- Custom Page Subnav --}}
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('kajian') }}"
                            class="flex items-center gap-1 text-slate-500 hover:text-slate-900 transition text-base font-medium group">
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        <span class="text-slate-300">|</span>
                        <div class="flex items-center gap-2">
                            <span class="text-base font-bold tracking-tight text-slate-900">Informasi<span
                                    class="text-primary"> Kajian Islam</span></span>
                        </div>
                    </div>
                    <div>
                        <button onclick="shareLink()" class="text-slate-500 hover:text-slate-900 text-sm font-semibold flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.684 10.742l4.684-2.342m0 0l4.684 2.342m-4.684-2.342V4m0 12v6m0 0l4.684-2.342m-4.684 2.342L8.684 19.658">
                                </path>
                            </svg>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        {{-- Hero Header --}}
        <div class="bg-white border-b border-slate-100 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2 text-sm text-slate-400 mb-4">
                    <a href="{{ route('home') }}" class="hover:text-emerald-600">Beranda</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <a href="{{ route('kajian') }}" class="hover:text-emerald-600">Jadwal Kajian</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-slate-600 font-medium truncate">{{ $kajianDetail->sub_title ?? '' }}</span>
                </div>

                <div class="flex flex-wrap gap-2 mb-4 pt-2">
                    <span
                        class="bg-tertiary/10 text-tertiary text-xs font-bold px-2.5 py-1 rounded-md border border-tertiary/20 uppercase">
                        {{ $kajianDetail->kajian->kajianCategory->name ?? 'Kajian' }}
                    </span>
                    <span
                        class="bg-amber-50 text-amber-700 text-xs font-bold px-2.5 py-1 rounded-md border border-amber-100 uppercase">
                        {{ $kajianDetail->location->type ?? 'Offline' }}
                    </span>
                </div>

                <h1
                    class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight max-w-4xl">
                    {{ $kajianDetail->sub_title ?? '' }}
                </h1>
                </p>
            </div>
        </div>

        {{-- Main Content Section --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- Left Content Area --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Poster Card --}}
                    @if($kajianDetail->poster)
                        <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm flex justify-center overflow-hidden">
                            <img src="{{ asset('storage/' . $kajianDetail->poster) }}"
                                alt="Poster {{ $kajianDetail->kajian->title ?? '' }}"
                                class="rounded-xl w-full max-w-[450px] height-auto object-contain shadow-md hover:scale-[1.02] transition-transform duration-300">
                        </div>
                    @endif

                    {{-- Description --}}
                    <div class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm">
                        <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="w-1 h-5 bg-primary rounded-full"></span>
                            Deskripsi Kajian
                        </h2>
                        <div class="text-slate-600 text-sm md:text-base leading-relaxed space-y-4">
                            {!! nl2br(e($kajianDetail->description)) !!}
                        </div>

                        @if($kajianDetail->note)
                            <blockquote
                                class="mt-6 border-l-4 border-red-600 bg-red-50/50 rounded-r-xl p-4 text-xs md:text-sm text-slate-700 font-medium">
                                Catatan: {{ $kajianDetail->note }}
                            </blockquote>
                        @endif
                    </div>

                    {{-- Speaker (Ustadz) Info --}}
                    <div
                        class="bg-white rounded-2xl border border-slate-100 p-6 md:p-8 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-5">
                        @if($kajianDetail->ustadz->photo)
                            <img src="{{ asset('storage/' . $kajianDetail->ustadz->photo) }}"
                                alt="{{ $kajianDetail->ustadz->name }}"
                                class="w-20 h-20 rounded-full object-cover shrink-0 shadow-md">
                        @else
                            <div
                                class="w-16 h-16 rounded-full bg-linear-to-tr from-emerald-600 to-teal-500 text-white font-black text-xl flex items-center justify-center flex-shrink-0 shadow-md">
                                {{ $initials ?: 'U' }}
                            </div>
                        @endif
                        <div class="text-center sm:text-left flex-1">
                            <div class="text-sm font-bold text-primary uppercase tracking-wider mb-2">Pemateri Utama</div>
                            <h3 class="text-lg font-bold text-slate-900 mt-0.5">{{ $kajianDetail->ustadz->name }}</h3>
                            <p class="text-slate-600 text-sm md:text-sm mt-2 leading-relaxed">
                                {{ $kajianDetail->ustadz->description ?? 'Pemateri Kajian Islam Masjid Al-Kautsar Cempolorejo.' }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Right Sidebar --}}
                <div class="space-y-6 lg:sticky lg:top-24">

                    {{-- Event Card --}}
                    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-md">
                        <div class="text-2xl font-black text-slate-900 mb-5">
                            Gratis <span class="text-sm font-medium text-slate-400">/ Terbuka Untuk Umum</span>
                        </div>

                        <div class="space-y-3.5 border-t border-slate-100 pt-4 mb-6 text-xs md:text-sm text-slate-600">
                            {{-- Date & Time --}}
                            <div class="flex items-start gap-3">
                                <div>
                                    <iconify-icon icon="lucide:calendar" class="text-slate-400 mt-1 w-5 h-5 text-xl" />
                                </div> 
                                <div>
                                    <p class="text-base font-bold text-slate-900">
                                        {{ \Carbon\Carbon::parse($kajianDetail->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                    </p>
                                    <p class="text-sm text-slate-400 mt-1">
                                        @if($kajianDetail->time_type === 'fixed')
                                            {{ \Carbon\Carbon::parse($kajianDetail->start_time)->format('H:i') }} WIB s/d Selesai
                                        @else
                                            {{ $kajianDetail->time_phrase }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="flex items-start gap-3">
                                <div>
                                    <iconify-icon icon="lucide:map-pin" class="text-slate-400 mt-1 w-5 h-5 text-xl" />
                                </div> 
                                <div>
                                    <p class="text-base font-bold text-slate-900">{{ $kajianDetail->location->name }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5 line-clamp-2">{{ $kajianDetail->location->address ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="space-y-2">
                            @php
                                $waText = "Assalamualaikum admin Masjid Al-Kautsar, saya ingin bertanya mengenai kajian: *" . ($kajianDetail->kajian->title ?? '') . "* bersama " . ($kajianDetail->ustadz->name ?? '') . " pada tanggal " . \Carbon\Carbon::parse($kajianDetail->date)->isoFormat('D MMMM YYYY') . ".";
                                $waUrl = "https://wa.me/6282329621484?text=" . urlencode($waText);
                            @endphp
                            <a href="{{ $waUrl }}" target="_blank"
                                class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-emerald-200 transition duration-200 block text-center">
                                Hubungi Admin Via WhatsApp
                            </a>

                            @if($kajianDetail->location->type === 'Online' && $kajianDetail->location->online_link)
                                <a href="{{ $kajianDetail->location->online_link }}" target="_blank"
                                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm py-3.5 rounded-xl shadow-lg shadow-blue-200 transition duration-200 block text-center mt-2">
                                    Gabung Link Online (Zoom/YouTube)
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Map / Location Card --}}
                    @if($kajianDetail->location->type === 'offline')
                        <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                            <div class="text-xs font-bold text-slate-900 mb-3 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7">
                                    </path>
                                </svg>
                                Lokasi Google Maps
                            </div>

                            @if($kajianDetail->location->maps_url)
                                @php
                                    // Extract coordinates if possible or check if it is an embed link, otherwise display fallback map styling
                                    $hasEmbedMap = str_contains($kajianDetail->location->maps_url, 'embed');
                                @endphp

                                @if($hasEmbedMap)
                                    <div class="w-full h-40 rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                                        <iframe src="{{ $kajianDetail->location->maps_url }}" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                @else
                                    <div
                                        class="w-full h-40 bg-slate-100 rounded-xl relative overflow-hidden border border-slate-200 flex flex-col justify-center items-center p-4 text-center">
                                        <div
                                            class="absolute inset-0 opacity-20 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:14px_24px]">
                                        </div>
                                        <div
                                            class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center text-white font-bold text-xs shadow animate-bounce relative z-10">
                                            📍</div>
                                        <div class="text-[11px] text-slate-500 font-medium mt-2 relative z-10">
                                            Peta {{ $kajianDetail->location->name }}
                                        </div>
                                        <a href="{{ $kajianDetail->location->maps_url }}" target="_blank"
                                            class="text-[10px] text-emerald-600 font-bold hover:underline mt-1 relative z-10">
                                            Buka Petunjuk Arah &rarr;
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-40 bg-slate-100 rounded-xl flex items-center justify-center border border-slate-200 text-slate-400 text-xs p-4 text-center">
                                    Peta tidak tersedia untuk lokasi ini.
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- Online Event Visual Card --}}
                        <div class="bg-linear-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-100 p-6 shadow-sm text-center">
                            <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mb-3 animate-pulse">
                                <iconify-icon icon="lucide:video" class="text-2xl"></iconify-icon>
                            </span>
                            <h4 class="font-extrabold text-sm text-blue-900 font-raleway">Kajian Online / Live Zoom</h4>
                            <p class="text-[11px] text-blue-700/80 mt-1 leading-relaxed">
                                Kajian ini diselenggarakan secara daring. Anda dapat bergabung dari mana saja melalui tautan yang disediakan.
                            </p>
                            @if($kajianDetail->location->online_link)
                                <a href="{{ $kajianDetail->location->online_link }}" target="_blank"
                                    class="inline-block mt-4 text-xs bg-blue-600 hover:bg-blue-500 text-white font-bold px-4 py-2 rounded-lg transition duration-200">
                                    Buka Link Live
                                </a>
                            @endif
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
<script>
    function shareLink() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $kajianDetail->kajian->title ?? '' }}',
                text: 'Kajian: {{ $kajianDetail->kajian->title ?? '' }} - {{ $kajianDetail->sub_title ?? '' }}',
                url: window.location.href
            }).catch(console.error);
        } else {
            navigator.clipboard.writeText(window.location.href);
            Swal.fire({
                icon: 'success',
                title: 'Tautan Berhasil Disalin',
                text: 'Tautan detail kajian telah disalin ke papan klip Anda!',
                timer: 2000,
                showConfirmButton: false
            });
        }
    }
</script>
@endpush
