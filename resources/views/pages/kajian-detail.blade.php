@extends('layouts.app')

@section('title', ($kajianDetail->kajian->title ?? 'Detail Kajian') . ' | Masjid Al-Kautsar Cempolorejo')

@section('content')
    @php
        $ustadzName = $kajianDetail->ustadz->name ?? 'Ustadz';
        $cleanName = preg_replace('/^(ustadz|ust\.|dr\.|h\.|haji)\s+/i', '', $ustadzName);
        $words = explode(' ', $cleanName);
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) $initials .= strtoupper($word[0]);
        }
        $initials = substr($initials, 0, 2);
        $isPast = \Carbon\Carbon::parse($kajianDetail->date)->isPast();
        $categorySlug = $kajianDetail->kajian->kajianCategory->slug ?? '';
        $accentHex = '#d97706'; // default yellow
        $accentClass = 'bg-yellow-500';
        $accentTextClass = 'text-yellow-600';
        $accentLightBg = 'bg-yellow-50 border-yellow-200 text-yellow-800';
    @endphp

    {{-- ================================================================
    HERO / BREADCRUMB STRIP
    ================================================================ --}}
    <div class="bg-slate-950 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <div class="flex items-center gap-2 text-sm text-slate-400">
                <a href="{{ route('home') }}" class="hover:text-yellow-400 transition-colors">Beranda</a>
                <iconify-icon icon="mdi:chevron-right" class="text-slate-600"></iconify-icon>
                <a href="{{ route('kajian') }}" class="hover:text-yellow-400 transition-colors">Jadwal Kajian</a>
                <iconify-icon icon="mdi:chevron-right" class="text-slate-600"></iconify-icon>
                <span class="text-slate-300 font-medium truncate max-w-xs">{{ $kajianDetail->sub_title ?? $kajianDetail->kajian->title ?? '' }}</span>
            </div>
        </div>
    </div>

    {{-- ================================================================
    PAGE HEADER
    ================================================================ --}}
    <div class="relative bg-slate-950 pb-16 pt-10 overflow-hidden">
        {{-- Background blobs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Tags --}}
            <div class="flex flex-wrap items-center gap-2 mb-5">
                <span class="inline-flex items-center gap-1.5 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">
                    <iconify-icon icon="mdi:book-open"></iconify-icon>
                    {{ $kajianDetail->kajian->kajianCategory->name ?? 'Kajian' }}
                </span>
                @if($kajianDetail->location->type === 'Online')
                    <span class="inline-flex items-center gap-1.5 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold uppercase px-3 py-1.5 rounded-full">
                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full animate-ping"></span>
                        Online / Live
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold uppercase px-3 py-1.5 rounded-full">
                        <iconify-icon icon="mdi:map-marker"></iconify-icon>
                        Offline
                    </span>
                @endif
                @if($isPast)
                    <span class="inline-flex items-center gap-1.5 bg-slate-700/50 border border-slate-600 text-slate-400 text-xs font-bold uppercase px-3 py-1.5 rounded-full">
                        Kajian Selesai
                    </span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="font-raleway font-black text-3xl sm:text-4xl lg:text-5xl text-white leading-tight max-w-4xl mb-4">
                {{ $kajianDetail->sub_title ?? $kajianDetail->kajian->title ?? '' }}
            </h1>
            <p class="text-slate-400 text-base max-w-2xl leading-relaxed">{{ $kajianDetail->kajian->title ?? '' }}</p>

            {{-- Quick info strip --}}
            <div class="flex flex-wrap gap-6 mt-8 pt-8 border-t border-white/5">
                <div class="flex items-center gap-2.5 text-sm text-slate-300">
                    <iconify-icon icon="mdi:calendar" class="text-yellow-400 text-xl shrink-0"></iconify-icon>
                    <span>{{ \Carbon\Carbon::parse($kajianDetail->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                </div>
                <div class="flex items-center gap-2.5 text-sm text-slate-300">
                    <iconify-icon icon="mdi:clock-outline" class="text-yellow-400 text-xl shrink-0"></iconify-icon>
                    <span>
                        @if($kajianDetail->time_type === 'fixed')
                            {{ \Carbon\Carbon::parse($kajianDetail->start_time)->format('H:i') }} WIB s/d Selesai
                        @else
                            {{ $kajianDetail->time_phrase }}
                        @endif
                    </span>
                </div>
                <div class="flex items-center gap-2.5 text-sm text-slate-300">
                    <iconify-icon icon="mdi:map-marker" class="text-yellow-400 text-xl shrink-0"></iconify-icon>
                    <span>{{ $kajianDetail->location->name ?? '' }}</span>
                </div>
                <div class="flex items-center gap-2.5 text-sm text-slate-300">
                    <iconify-icon icon="mdi:ticket-outline" class="text-yellow-400 text-xl shrink-0"></iconify-icon>
                    <span class="text-emerald-400 font-bold">Gratis / Terbuka Untuk Umum</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================
    MAIN CONTENT
    ================================================================ --}}
    <div class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- ============================
                LEFT COLUMN: Main Content
                ============================ --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Poster --}}
                    @if($kajianDetail->poster)
                        <div class="rounded-2xl overflow-hidden shadow-xl bg-white border border-slate-100">
                            <img src="{{ asset('storage/' . $kajianDetail->poster) }}"
                                alt="Poster {{ $kajianDetail->kajian->title ?? '' }}"
                                class="w-full object-contain max-h-[600px] hover:scale-[1.01] transition-transform duration-500">
                        </div>
                    @endif

                    {{-- Description --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-1 h-6 bg-yellow-500 rounded-full"></div>
                                <h2 class="text-lg font-bold text-slate-900">Deskripsi Kajian</h2>
                            </div>
                            <div class="text-slate-600 text-sm md:text-base leading-relaxed prose max-w-none">
                                {!! nl2br(e($kajianDetail->description)) !!}
                            </div>

                            @if($kajianDetail->note)
                                <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3">
                                    <iconify-icon icon="mdi:alert-circle" class="text-amber-500 text-xl shrink-0 mt-0.5"></iconify-icon>
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-wider text-amber-700 mb-0.5">Catatan Penting</p>
                                        <p class="text-sm text-amber-800">{{ $kajianDetail->note }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Ustadz Info --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-900 to-slate-800 px-6 md:px-8 py-4">
                            <p class="text-yellow-400 text-xs font-bold uppercase tracking-widest">Pemateri Utama</p>
                        </div>
                        <div class="p-6 md:p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6">
                            @if($kajianDetail->ustadz->photo)
                                <img src="{{ asset('storage/' . $kajianDetail->ustadz->photo) }}"
                                    alt="{{ $kajianDetail->ustadz->name }}"
                                    class="w-24 h-24 rounded-2xl object-cover shrink-0 shadow-lg border border-slate-200">
                            @else
                                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-yellow-500 to-amber-600 text-white font-black text-3xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                    {{ $initials ?: 'U' }}
                                </div>
                            @endif
                            <div class="text-center sm:text-left flex-1">
                                <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $kajianDetail->ustadz->name }}</h3>
                                <p class="text-yellow-600 text-sm font-semibold mb-3">Ustadz / Pemateri Kajian</p>
                                <p class="text-slate-500 text-sm leading-relaxed">
                                    {{ $kajianDetail->ustadz->description ?? 'Pemateri Kajian Islam Masjid Al-Kautsar Cempolorejo. Mengajarkan ilmu agama dengan pendekatan yang mudah dipahami.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ============================
                RIGHT SIDEBAR
                ============================ --}}
                <div class="space-y-5 lg:sticky lg:top-24">

                    {{-- Registration / Action Card --}}
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-md overflow-hidden">
                        <div class="bg-gradient-to-br from-slate-900 to-slate-800 p-6 text-center">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-yellow-500/10 border border-yellow-500/20 rounded-2xl mb-3">
                                <iconify-icon icon="mdi:ticket-confirmation" class="text-yellow-400 text-2xl"></iconify-icon>
                            </div>
                            <p class="text-white font-black text-2xl">Gratis</p>
                            <p class="text-slate-400 text-xs mt-1">Terbuka Untuk Seluruh Jamaah</p>
                        </div>

                        <div class="p-6 space-y-3">
                            {{-- Date & Time --}}
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="w-8 h-8 rounded-lg bg-yellow-500/10 flex items-center justify-center shrink-0 mt-0.5">
                                    <iconify-icon icon="mdi:calendar" class="text-yellow-600"></iconify-icon>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-0.5">Waktu</p>
                                    <p class="text-sm font-bold text-slate-900">{{ \Carbon\Carbon::parse($kajianDetail->date)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        @if($kajianDetail->time_type === 'fixed')
                                            {{ \Carbon\Carbon::parse($kajianDetail->start_time)->format('H:i') }} WIB s/d Selesai
                                        @else
                                            {{ $kajianDetail->time_phrase }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center shrink-0 mt-0.5">
                                    <iconify-icon icon="mdi:map-marker" class="text-emerald-600"></iconify-icon>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-0.5">Lokasi</p>
                                    <p class="text-sm font-bold text-slate-900">{{ $kajianDetail->location->name }}</p>
                                    @if($kajianDetail->location->address)
                                        <p class="text-xs text-slate-500 mt-0.5 line-clamp-2">{{ $kajianDetail->location->address }}</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            @php
                                $waText = "Assalamualaikum admin Masjid Al-Kautsar, saya ingin bertanya mengenai kajian: *" . ($kajianDetail->kajian->title ?? '') . "* bersama " . ($kajianDetail->ustadz->name ?? '') . " pada tanggal " . \Carbon\Carbon::parse($kajianDetail->date)->locale('id')->isoFormat('D MMMM YYYY') . ".";
                                $waUrl = "https://wa.me/6282329621484?text=" . urlencode($waText);
                            @endphp

                            <div class="space-y-2 pt-2">
                                <a href="{{ $waUrl }}" target="_blank"
                                    class="w-full bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-sm py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all duration-200 shadow-lg shadow-emerald-500/20">
                                    <iconify-icon icon="mdi:whatsapp" class="text-lg"></iconify-icon>
                                    Hubungi Admin via WhatsApp
                                </a>

                                @if($kajianDetail->location->type === 'Online' && $kajianDetail->location->online_link)
                                    <a href="{{ $kajianDetail->location->online_link }}" target="_blank"
                                        class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all duration-200 shadow-lg shadow-blue-600/20">
                                        <iconify-icon icon="mdi:video" class="text-lg"></iconify-icon>
                                        Gabung Link Online
                                    </a>
                                @endif

                                <button onclick="shareLink()"
                                    class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm py-3 rounded-xl flex items-center justify-center gap-2 transition-all duration-200">
                                    <iconify-icon icon="mdi:share-variant"></iconify-icon>
                                    Bagikan Kajian
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Map Card --}}
                    @if($kajianDetail->location->type !== 'Online')
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                            <div class="flex items-center gap-2 px-4 py-3 border-b border-slate-100">
                                <iconify-icon icon="mdi:map" class="text-slate-400"></iconify-icon>
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wide">Peta Lokasi</span>
                            </div>
                            @if($kajianDetail->location->maps_url)
                                @php $hasEmbedMap = str_contains($kajianDetail->location->maps_url, 'embed'); @endphp
                                @if($hasEmbedMap)
                                    <div class="w-full h-48">
                                        <iframe src="{{ $kajianDetail->location->maps_url }}" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
                                    </div>
                                @else
                                    <div class="w-full h-48 bg-slate-100 flex flex-col items-center justify-center relative overflow-hidden">
                                        <div class="absolute inset-0 opacity-20 bg-[linear-gradient(to_right,#808080_1px,transparent_1px),linear-gradient(to_bottom,#808080_1px,transparent_1px)] bg-[size:14px_24px]"></div>
                                        <div class="w-9 h-9 bg-red-500 rounded-full flex items-center justify-center text-white shadow-lg relative z-10 animate-bounce text-lg">📍</div>
                                        <p class="text-xs text-slate-500 font-medium mt-2 relative z-10">{{ $kajianDetail->location->name }}</p>
                                        <a href="{{ $kajianDetail->location->maps_url }}" target="_blank"
                                            class="text-xs text-yellow-600 font-bold hover:underline mt-1.5 relative z-10 flex items-center gap-1">
                                            Buka Petunjuk Arah <iconify-icon icon="mdi:open-in-new"></iconify-icon>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="h-48 flex items-center justify-center text-slate-400 text-xs p-4 text-center">
                                    <div>
                                        <iconify-icon icon="mdi:map-marker-off" class="text-3xl mb-2 text-slate-300"></iconify-icon>
                                        <p>Peta tidak tersedia untuk lokasi ini.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- Online Card --}}
                        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-center shadow-lg">
                            <iconify-icon icon="mdi:video-wireless" class="text-white/80 text-4xl mb-3"></iconify-icon>
                            <h4 class="font-bold text-white text-sm mb-1">Kajian Online / Live</h4>
                            <p class="text-blue-100 text-xs leading-relaxed mb-4">Bergabung dari mana saja. Pastikan koneksi internet Anda stabil sebelum bergabung.</p>
                            @if($kajianDetail->location->online_link)
                                <a href="{{ $kajianDetail->location->online_link }}" target="_blank"
                                    class="inline-block text-xs bg-white hover:bg-blue-50 text-blue-700 font-bold px-5 py-2.5 rounded-full transition duration-200">
                                    Buka Link Live Streaming
                                </a>
                            @endif
                        </div>
                    @endif

                    {{-- Back Button --}}
                    <a href="{{ route('kajian') }}"
                        class="w-full flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-600 hover:text-slate-900 font-semibold text-sm py-3 rounded-xl border border-slate-200 transition-all duration-200">
                        <iconify-icon icon="mdi:arrow-left"></iconify-icon>
                        Kembali ke Daftar Kajian
                    </a>

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
                showConfirmButton: false,
                confirmButtonColor: '#d97706'
            });
        }
    }
</script>
@endpush
