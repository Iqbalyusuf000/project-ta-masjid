@extends('layouts.app')

@section('title', 'Isi Ulang ALKA | Masjid Al-Kautsar Cempolorejo')

@section('content')

    {{-- HERO SECTION: Simpel, Bersih, & Minimalis Elegan --}}
    <section class="px-4 sm:px-6 lg:px-16 max-w-[1440px] mx-auto w-full pt-6 sm:pt-10">
        <div class="bg-linear-to-br from-tertiary to-yellow-600 rounded-3xl p-6 sm:p-10 lg:p-14 shadow-sm">
            <div class="max-w-4xl">

                {{-- Badge Unit Usaha --}}
                <div class="flex items-center gap-2 mb-4">
                    <span class="w-2 h-2 rounded-full bg-amber-300 animate-pulse"></span>
                    <span class="text-xs sm:text-sm font-bold tracking-widest text-amber-200 uppercase">
                        Unit Usaha Masjid • Air ALKA
                    </span>
                </div>

                {{-- Judul Utama --}}
                <h1
                    class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-tight mb-6 font-raleway">
                    Segar, Murni, &amp; <span class="italic text-amber-200 font-serif">Berkah</span>
                </h1>

                {{-- Deskripsi dengan Gaya Border Kiri (Sama seperti teks ayat di gambar ref) --}}
                <div class="border-l-4 border-amber-300/60 pl-4 mb-4 sm:mb-8">
                    <p class="text-stone-100 text-sm sm:text-base leading-relaxed max-w-2xl font-medium">
                        "Hadirkan kemurnian air pegunungan yang diproses dengan teknologi filtrasi modern di bawah naungan
                        Masjid Al Kautsar. Setiap tetesnya mengalirkan manfaat untuk ummat."
                    </p>
                </div>

                {{-- Tombol Aksi Minimalis Putih --}}
                <div class="flex flex-wrap gap-4 mb-4 sm:mb-4 md:mb-2">
                    <a href="https://wa.me/6282329621484" target="_blank"
                        class="bg-white hover:bg-stone-100 text-stone-950 font-bold px-6 py-3 rounded-xl shadow-md transition-all duration-300 flex items-center gap-2 text-sm transform hover:-translate-y-0.5">
                        <iconify-icon icon="lucide:shopping-cart" class="text-base text-amber-600"></iconify-icon>
                        Pesan Sekarang
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- STATS SECTION: Floating Grid Tetap Dipertahankan --}}
    <section class="relative z-20 -mt-6 sm:-mt-8 px-6 lg:px-16 max-w-[1440px] mx-auto w-full mb-10">
        <div class="grid grid-cols-3 gap-3 md:gap-6 max-w-5xl mx-auto">

            <!-- Card 1: Harga Terjangkau -->
            <div
                class="bg-white rounded-2xl border border-stone-200/60 shadow-[0_12px_30px_rgba(0,0,0,0.03)] py-4 px-3 sm:p-5 flex items-center gap-3 lg:gap-5 group hover:-translate-y-0.5 hover:shadow-[0_15px_30px_rgba(212,175,55,0.06)] hover:border-amber-500/40 transition-all duration-300">
                <div
                    class="flex w-10 h-10 md:w-12 md:h-12 rounded-xl bg-amber-50 text-primary items-center justify-center shrink-0 transition-all duration-300 group-hover:bg-tertiary group-hover:text-stone-950">
                    <iconify-icon icon="lucide:tags" class="text-lg md:text-xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-stone-400">Mulai Dari</p>
                    <p class="text-xs sm:text-base md:text-xl font-extrabold text-stone-900 mt-0.5 font-raleway">
                        Rp. {{ $price->price }}
                        <span class="hidden lg:inline text-xs font-medium text-stone-400 font-lato"> / Refill</span>
                    </p>
                </div>
            </div>

            <!-- Card 2: Layanan Antar -->
            <div
                class="bg-white rounded-2xl border border-stone-200/60 shadow-[0_12px_30px_rgba(0,0,0,0.03)] py-4 px-3 sm:p-5 flex items-center gap-3 lg:gap-5 group hover:-translate-y-0.5 hover:shadow-[0_15px_30px_rgba(212,175,55,0.06)] hover:border-amber-500/40 transition-all duration-300">
                <div
                    class="flex w-10 h-10 md:w-12 md:h-12 rounded-xl bg-amber-50 text-primary items-center justify-center shrink-0 transition-all duration-300 group-hover:bg-tertiary group-hover:text-stone-950">
                    <iconify-icon icon="lucide:truck" class="text-lg md:text-xl"></iconify-icon>
                </div>
                <div>
                    <p
                        class="hidden sm:inline text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-stone-400">
                        Layanan Antar</p>
                    <p
                        class="inline sm:hidden text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-stone-400">
                        Antar Gratis</p>
                    <p class="text-xs sm:text-base md:text-xl font-extrabold text-stone-900 mt-0.5 font-raleway">
                        Jarak 2 Km
                        <span class="hidden lg:inline text-xs font-medium text-stone-400 font-lato"> / Gratis</span>
                    </p>
                </div>
            </div>

            <!-- Card 3: Higienitas Terjamin -->
            <div
                class="bg-white rounded-2xl border border-stone-200/60 shadow-[0_12px_30px_rgba(0,0,0,0.03)] py-4 px-3 sm:p-5 flex items-center gap-3 lg:gap-5 group hover:-translate-y-0.5 hover:shadow-[0_15px_30px_rgba(212,175,55,0.06)] hover:border-amber-500/40 transition-all duration-300">
                <div
                    class="flex w-10 h-10 md:w-12 md:h-12 rounded-xl bg-amber-50 text-primary items-center justify-center shrink-0 transition-all duration-300 group-hover:bg-tertiary group-hover:text-stone-950">
                    <iconify-icon icon="lucide:shield-check" class="text-lg md:text-xl"></iconify-icon>
                </div>
                <div>
                    <p class="text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-stone-400">Higienitas</p>
                    <p
                        class="hidden sm:inline text-xs sm:text-base md:text-xl font-extrabold text-stone-900 mt-0.5 font-raleway">
                        Terjamin &amp; Aman
                    </p>
                    <p
                        class="inline sm:hidden text-xs sm:text-base md:text-xl font-extrabold text-stone-900 mt-0.5 font-raleway">
                        Terjamin
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- Section about service -->
    <section class="bg-neutral py-8 md:py-8 relative overflow-hidden">
        <div class="relative z-10 px-6 md:px-12 lg:px-16 max-w-[1440px] mx-auto w-full">
            <!-- Section Header -->
            <div class="text-center mb-8">
                <h2 class="font-extrabold text-3xl md:text-4xl text-tertiary mb-3 font-raleway tracking-tight">
                    Layanan Kami
                </h2>
                <div class="w-16 h-1 bg-tertiary mx-auto mb-4 rounded-full"></div>
                <p class="font-light text-slate-500 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                    Pilihan kemasan air minum sesuai kebutuhan Anda
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 md:gap-8">
                @foreach ($waterRefill as $waterRefills)
                    @php
                        // Check if the price is a valid numeric value greater than 0
                        $isNumericPrice = is_numeric($waterRefills->price) && $waterRefills->price > 0;

                        // WhatsApp order/contact link
                        $waText = $isNumericPrice
                            ? "Assalamualaikum admin ALKA, saya ingin memesan produk: *" . $waterRefills->name . "* dengan harga Rp " . number_format($waterRefills->price, 0, ',', '.') . ". Mohon info selanjutnya."
                            : "";
                        $waLink = "https://wa.me/6282329621484?text=" . urlencode($waText);

                        // Determine badge text and background color
                        $badgeText = null;
                        $badgeBg = 'bg-tertiary';

                        if ($waterRefills->info && strtolower($waterRefills->info) !== 'tersedia') {
                            $badgeText = $waterRefills->info;
                            if (strtolower($waterRefills->info) === 'tidak tersedia') {
                                $badgeBg = 'bg-rose-600';
                            }
                        } elseif ($waterRefills->name === 'Isi Ulang Galon' || 'Isi Ulang Air Minum Galon') {
                            $badgeText = $waterRefills->info;
                            $badgeBg = 'bg-tertiary'; // Beautiful dark-gold/olive badge matching mockup
                        }
                    @endphp

                    <div
                        class="group bg-white rounded-2xl border border-slate-100 shadow-[0_8px_30px_rgba(0,0,0,0.02)] overflow-hidden hover:shadow-[0_20px_50px_rgba(212,175,55,0.08)] hover:-translate-y-2 hover:border-primary/30 transition-all duration-300">

                        <!-- Image Container -->
                        <div
                            class="relative overflow-hidden h-44 md:aspect-[4/3] md:h-auto w-full bg-slate-50 border-b border-slate-100">
                            <!-- Badge Info (e.g. Terlaris) -->
                            @if($badgeText)
                                <div
                                    class="absolute top-4 left-4 z-10 {{ $badgeBg }} text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1.5 rounded-lg shadow-sm">
                                    {{ $badgeText }}
                                </div>
                            @endif

                            <!-- Product Image -->
                            @if($waterRefills->photo)
                                <img src="{{ Str::startsWith($waterRefills->photo, 'http') ? $waterRefills->photo : asset('storage/' . $waterRefills->photo) }}"
                                    alt="{{ $waterRefills->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            @else
                                <!-- Fallback Images matching mockup if photo is not yet uploaded -->
                                @php
                                    $fallbackImage = '';
                                    if ($waterRefills->name === 'Isi Ulang Galon') {
                                        $fallbackImage = 'https://images.unsplash.com/photo-1523362628745-0c100150b504?auto=format&fit=crop&q=80&w=800';
                                    } elseif ($waterRefills->name === 'Galon Baru') {
                                        $fallbackImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAoUfAkMZoR6XzjzMlIkqm8748tQLQPynXHgkfdv1nScUYJcP-Vs2b4R7NcnUTVp_ryRWg_tv9ORz0seMTdJhedO5cWrtISwX-FsDqHAEgMqLb8-qtUovOmDOZv_aj7vk6SVtHdTYIVkq-lWiQomkXEgYLa8JPkBsAGU1buBwj3thFUlpb7nV2ok_YSy9yEIx-eUP3c4FZvrRqd071bxnJYX9pSN6XwJl6TlmwByucrcotskfFGXxPIrrhVPbNtUHzqARSH9KN-D-E';
                                    } else {
                                        $fallbackImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuDBq7f-JnFuycpXb__WcihFL89S6KjBlDPW8XQt0CMlm8G9oEaqU6FGJysJiB6HImaNPQDeqR4xm9IGx43_yR0yxANWvgkzF_r7dnQwizu_XBcMVCj4Y9iGz8MaGdNencMfF9Wzxyr-5WbEJj_YOEy1YZPVmVI7TuxyPUtECH8v7_6WXbYX4P4e1zSx6PamtYxnMG-kHa8y9eVHN5b0hO1lBlo2f3v-5fUAT7lS3lF2cYdC0FI28__6O9fzlI1pbu1DFP-bvPd6RSE';
                                    }
                                @endphp
                                <img src="{{ $fallbackImage }}" alt="{{ $waterRefills->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            @endif
                        </div>

                        <!-- Card Content -->
                        <div class="p-4 md:p-6 flex flex-col flex-grow">
                            <!-- Product Title -->
                            <h3 class="font-extrabold text-lg md:text-xl text-secondary mb-3 font-raleway leading-snug">
                                @if($isNumericPrice)
                                    <a href="{{ $waLink }}" target="_blank"
                                        class="hover:text-tertiary transition-colors duration-300">
                                        {{ $waterRefills->name }}
                                    </a>
                                @else
                                    <span>
                                        {{ $waterRefills->name }}
                                    </span>
                                @endif
                            </h3>

                            <!-- Product Description -->
                            <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow font-light">
                                {{ $waterRefills->description }}
                            </p>

                            <!-- Card Footer -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                                <!-- Price -->
                                <div>
                                    @if($isNumericPrice)
                                        <p class="text-lg md:text-xl font-extrabold text-tertiary font-raleway">
                                            Rp {{ number_format($waterRefills->price, 0, ',', '.') }}
                                        </p>
                                    @else
                                        <p class="text-lg md:text-xl font-extrabold text-tertiary font-raleway">
                                            Stok Kosong
                                        </p>
                                    @endif
                                </div>

                                <!-- Action Link -->
                                @if($isNumericPrice)
                                    <a href="{{ $waLink }}" target="_blank" class="flex items-center group/btn"
                                        title="Pesan via WhatsApp">

                                        <iconify-icon icon="lucide:arrow-right"
                                            class="text-lg md:text-xl text-tertiary group-hover/btn:translate-x-1.5 transition-transform duration-300">
                                        </iconify-icon>

                                    </a>
                                @else
                                    <span class="text-stone-400 cursor-not-allowed">
                                        <iconify-icon icon="mdi:lock"></iconify-icon>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Section: Why Choose ALKA (Split Content Layout) -->
    <section class="bg-white py-6 relative overflow-hidden border-t border-slate-100">
        <!-- Subtle decorative backgrounds -->
        <div class="absolute top-0 right-0 w-80 h-80 bg-tertiary/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 px-6 md:px-12 lg:px-16 max-w-[1440px] mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-16 items-center">

                <!-- Left Side: Title and Value Proposition -->
                <div class="lg:col-span-5 space-y-2 sm:space-y-6">
                    <!-- Badge -->
                    <span
                        class="inline-flex items-center gap-1.5 py-1 px-3 bg-tertiary/10 text-tertiary font-semibold text-xs md:text-sm rounded-full border border-tertiary/15 uppercase tracking-wider">
                        <iconify-icon icon="lucide:award" class="text-sm"></iconify-icon>
                        Keunggulan Kami
                    </span>

                    <!-- Heading -->
                    <h2
                        class="font-extrabold text-3xl md:text-4xl text-secondary font-raleway leading-tight tracking-tight">
                        Mengapa Memilih <span class="text-tertiary">ALKA</span>?
                    </h2>

                    <div class="w-16 h-1 bg-tertiary rounded-full"></div>

                    <!-- Subtitle / Short description -->
                    <p class="text-slate-500 font-light text-base leading-relaxed">
                        Kualitas teknis yang mumpuni dengan landasan nilai syariah, menghadirkan kesegaran alami untuk
                        keberkahan bersama.
                    </p>
                </div>

                <!-- Right Side: Vertical Stack of Features -->
                <div class="lg:col-span-7 space-y-6">

                    <!-- Card 1: Kemaslahatan Umat -->
                    <div
                        class="group bg-neutral/40 p-6 rounded-2xl border border-slate-100/80 shadow-[0_4px_20px_rgba(0,0,0,0.01)] hover:shadow-[0_20px_40px_rgba(212,175,55,0.05)] hover:border-primary/20 hover:bg-white transition-all duration-300 flex flex-row items-center gap-5">
                        <div
                            class="w-14 h-14 rounded-2xl bg-white text-tertiary flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-tertiary group-hover:text-white group-hover:border-tertiary transition-all duration-300 shadow-sm">
                            <iconify-icon icon="fa6-solid:mosque" class="text-2xl"></iconify-icon>
                        </div>
                        <div class="space-y-2">
                            <h4
                                class="font-extrabold text-lg text-secondary font-raleway group-hover:text-tertiary transition-colors duration-300">
                                Kemaslahatan Umat
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed font-light">
                                Keuntungan dari unit usaha ini sepenuhnya digunakan untuk membiayai program ibadah,
                                sosial, dan pemeliharaan Masjid Al Kautsar Cempolorejo.
                            </p>
                        </div>
                    </div>

                    <!-- Card 2: Kualitas Air Terjaga -->
                    <div
                        class="group bg-neutral/40 p-6 rounded-2xl border border-slate-100/80 shadow-[0_4px_20px_rgba(0,0,0,0.01)] hover:shadow-[0_20px_40px_rgba(212,175,55,0.05)] hover:border-primary/20 hover:bg-white transition-all duration-300 flex flex-row items-center gap-5">
                        <div
                            class="w-14 h-14 rounded-2xl bg-white text-tertiary flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-tertiary group-hover:text-white group-hover:border-tertiary transition-all duration-300 shadow-sm">
                            <iconify-icon icon="icon-park-outline:protect" class="text-2xl"></iconify-icon>
                        </div>
                        <div class="space-y-2">
                            <h4
                                class="font-extrabold text-lg text-secondary font-raleway group-hover:text-tertiary transition-colors duration-300">
                                Kualitas Air Terjaga
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed font-light">
                                Setiap proses pengolahan dilakukan secara terkontrol untuk menjaga kualitas air tetap baik
                                dan nyaman dikonsumsi setiap hari oleh konsumen.
                            </p>
                        </div>
                    </div>

                    <!-- Card 1: Layanan Antar -->
                    <div
                        class="group bg-neutral/40 p-6 rounded-2xl border border-slate-100/80 shadow-[0_4px_20px_rgba(0,0,0,0.01)] hover:shadow-[0_20px_40px_rgba(212,175,55,0.05)] hover:border-primary/20 hover:bg-white transition-all duration-300 flex flex-row items-center gap-5">
                        <div
                            class="w-14 h-14 rounded-2xl bg-white text-tertiary flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-tertiary group-hover:text-white group-hover:border-tertiary transition-all duration-300 shadow-sm">
                            <iconify-icon icon="carbon:delivery" class="text-3xl"></iconify-icon>
                        </div>
                        <div class="space-y-2">
                            <h4
                                class="font-extrabold text-lg text-secondary font-raleway group-hover:text-tertiary transition-colors duration-300">
                                Siap Antar Sampai Rumah
                            </h4>
                            <p class="text-slate-500 text-sm leading-relaxed font-light">
                                Tidak perlu repot datang ke lokasi! Kami siap memberikan layanan pesan antar hingga sampai
                                tujuan, membantu memenuhi kebutuhan air minum keluarga dengan lebih mudah dan efisien.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- Call to Action Section (WhatsApp Banner) -->
    <section class="bg-white py-6 relative overflow-hidden">
        <div class="relative z-10 px-6 md:px-12 lg:px-16 1max-w-[1440px] mx-auto w-full justify-center items-center">
            <div
                class="relative bg-secondary rounded-3xl p-8 md:p-12 lg:p-14 overflow-hidden border border-slate-800 shadow-[0_20px_50px_rgba(15,23,42,0.15)]">
                <!-- Background Decorative Glows -->
                <div class="absolute -top-32 -left-32 w-96 h-96 bg-primary/10 rounded-full blur-[80px] pointer-events-none">
                </div>
                <div
                    class="absolute -bottom-32 -right-32 w-96 h-96 bg-primary/10 rounded-full blur-[80px] pointer-events-none">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <!-- Left: Text -->
                    <div class="max-w-2xl text-center md:text-left space-y-4">
                        <h3
                            class="font-extrabold text-3xl md:text-4xl lg:text-5xl text-transparent bg-clip-text bg-gradient-to-r from-amber-200 via-primary to-yellow-300 font-raleway tracking-tight">
                            Gak Perlu Angkat-angkat!
                        </h3>
                        <p class="text-slate-300 font-light text-base leading-relaxed">
                            Cukup WhatsApp, petugas kami akan mengantarkan air mineral ALKA langsung ke depan pintu rumah
                            Anda.
                        </p>
                    </div>

                    <!-- Right: WhatsApp Button -->
                    <div class="shrink-0 w-full md:w-auto flex justify-center">
                        <a href="https://wa.me/6282329621484?text={{ urlencode('Assalamualaikum admin ALKA, saya ingin memesan isi ulang air mineral ALKA. Mohon info selanjutnya.') }}"
                            target="_blank"
                            class="w-full md:w-auto inline-flex items-center justify-center gap-3 bg-[#25D366] hover:bg-[#20ba5a] text-white font-extrabold text-base md:text-lg px-8 py-4.5 rounded-2xl shadow-lg shadow-emerald-500/20 hover:shadow-xl hover:shadow-emerald-500/35 hover:-translate-y-1 active:translate-y-0 active:scale-95 transition-all duration-300 group">
                            <iconify-icon icon="mdi:whatsapp"
                                class="text-2xl md:text-3xl group-hover:rotate-6 transition-transform duration-300"></iconify-icon>
                            <span>Hubungi via WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Store Location Section -->
    <section class="bg-white py-16 md:py-24 relative overflow-hidden border-t border-slate-100">
        <!-- Background decorative elements matching design patterns -->
        <div class="absolute top-0 left-0 w-80 h-80 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-tertiary/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 px-6 md:px-12 lg:px-16 max-w-[1440px] mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-16 items-center">

                <!-- Left Side: Address Details -->
                <div class="lg:col-span-5 space-y-8">
                    <!-- Heading -->
                    <div class="space-y-2 md:space-y-6">
                        <h2
                            class="font-extrabold text-3xl md:text-4xl text-secondary font-raleway leading-tight tracking-tight">
                            Lokasi <span class="text-tertiary">Gerai</span>
                        </h2>
                        <div class="w-16 h-1 bg-tertiary rounded-full"></div>
                    </div>

                    <!-- Details Stack -->
                    <div class="space-y-3 md:space-y-6">
                        <!-- Address -->
                        <div class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/80 transition-all duration-300">
                            <div
                                class="w-12 h-12 rounded-xl bg-tertiary/10 text-tertiary flex items-center justify-center shrink-0 shadow-sm">
                                <iconify-icon icon="lucide:map-pin" class="text-xl"></iconify-icon>
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-bold text-base md:text-lg text-secondary font-raleway">Masjid Al Kautsar
                                    Cempolorejo
                                </h4>
                                <p class="text-slate-500 text-sm font-light leading-relaxed">
                                    Jl. Cempolorejo V No.21, Krobokan, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50141
                                </p>
                            </div>
                        </div>

                        <!-- Operating Hours -->
                        <div class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/80 transition-all duration-300">
                            <div
                                class="w-12 h-12 rounded-xl bg-tertiary/10 text-tertiary flex items-center justify-center shrink-0 shadow-sm">
                                <iconify-icon icon="lucide:clock" class="text-xl"></iconify-icon>
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-bold text-base md:text-lg text-secondary font-raleway">Jam Operasional</h4>
                                <p class="text-slate-500 text-sm font-semibold leading-relaxed">
                                    Setiap Hari: 06.00 - 21.00 WIB<br>
                                    <span class="text-rose-500/80 font-semibold text-md">(Tutup saat waktu Shalat
                                        Fardhu)</span>
                                </p>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="flex items-center gap-4 p-4 rounded-2xl hover:bg-white/80 transition-all duration-300">
                            <div
                                class="w-12 h-12 rounded-xl bg-tertiary/10 text-tertiary flex items-center justify-center shrink-0 shadow-sm">
                                <iconify-icon icon="lucide:phone" class="text-xl"></iconify-icon>
                            </div>
                            <div class="space-y-1">
                                <h4 class="font-bold text-base md:text-lg text-secondary font-raleway">Kontak Layanan</h4>
                                <p class="text-slate-500 text-sm font-light leading-relaxed">
                                    +62 823-2962-1484 (Ust. Eko)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Google Map Embed -->
                <div class="lg:col-span-7">
                    <div
                        class="relative rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100/80 h-[320px] sm:h-[380px] md:h-[450px] group transition-all duration-300 hover:shadow-[0_30px_60px_rgba(212,175,55,0.08)] hover:border-primary/20">
                        <iframe
                            src="https://maps.google.com/maps?q=Masjid%20Al-Kautsar%20Cempolorejo%20Krobokan%20Semarang&t=h&z=18&ie=UTF8&iwloc=&output=embed"
                            class="w-full h-full border-0 grayscale-10 contrast-110 group-hover:grayscale-0 transition-all duration-500"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection