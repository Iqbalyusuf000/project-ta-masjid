@extends('layouts.app')

@section('title', 'Profil | Masjid Al-Kautsar Cempolorejo')

@section('content')

    @php
        $masjid = [
            'nama' => 'Masjid Al Kautsar Cempolorejo',
            'tahun_berdiri' => 1992,
            'luas_tanah' => '800 m²',
            'jamaah_tetap' => '250+',
            'alamat' => 'Jl. Cempolorejo V No.21, Krobokan, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50141',
        ];

        $sejarah = [
            ['tahun' => '1992', 'judul' => 'Pembangunan awal', 'desk' => 'Pembangunan awal berbentuk mushola di area Jalan Cempolorejo'],
            ['tahun' => '2000', 'judul' => 'Membangun Panti Asuhan', 'desk' => 'Membangun panti asuhan untuk menampung anak tidak mampu dari berbagai wilayah.'],
            ['tahun' => '2005', 'judul' => 'Diubah Menjadi Masjid', 'desk' => 'Jamaah semakin banyak dan luas, maka mushola dibangun menjadi sebuah masjid yang cukup megah.'],
            ['tahun' => '2010', 'judul' => 'Memiliki TK Al Kautsar', 'desk' => 'Dibuka unit Taman Kanak-Kanak di Depan Masjid untuk pemberdayaan anak usia dini.'],
            ['tahun' => '2020', 'judul' => 'Perombakan Kegunaan Bangunan', 'desk' => 'Lantai 1 dari masjid diubah menjadi ruang serba guna, sementara ruang ibadah hanya berfokus di lantai 2.'],
        ];

        $fasilitas = [
            ['icon' => 'cool', 'nama' => 'Masjid yang luas, sejuk dan sirkulasi udara baik'],
            ['icon' => 'droplet', 'nama' => 'Tempat wudhu pria & wanita terpisah'],
            ['icon' => 'water', 'nama' => 'Isi ulang air mineral gratis'],
            ['icon' => 'wifi', 'nama' => 'Wifi Gratis'],
            ['icon' => 'food', 'nama' => 'Bagi takjil gratis setelah sholat jumat'],
        ];

        $kegiatan = [
            ['nama' => 'Kajian Fiqih', 'waktu' => 'Setiap Senin Genap, Bada Maghrib'],
            ['nama' => 'Kajian Sirah Nabawiyah', 'waktu' => 'Setiap Rabu, Bada Maghrib'],
            ['nama' => 'Kajian Tafsir', 'waktu' => 'Setiap Kamis Ganjil, Bada Maghrib'],
        ];

        $galeri = [
            asset('images/history-1.jpg'),
            asset('images/masjid-alkautsar.webp'),
            asset('images/galery-1.jpeg'),
            asset('images/galery-2.jpeg'),
            asset('images/galery-3.jpeg'),
            asset('images/galery-4.jpeg'),
        ];
    @endphp

    <body class="bg-ivory text-ink font-sans antialiased">
        {{-- ================= HERO ================= --}}
        <section id="beranda" class="relative bg-tertiary text-neutral overflow-hidden min-h-[45vh] flex items-center">
            {{-- Background Decor Elements --}}
            <div class="absolute -top-24 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-20 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none">
            </div>

            {{-- Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/10"></div>

            <div class="relative mx-auto px-6 py-16 md:py-6 flex flex-col items-center justify-center text-center">
                <div class="max-w-6xl w-full">
                    <h1 class="font-display font-semibold text-white text-2xl md:text-4xl leading-tight mb-2">
                        Profil Masjid Al Kautsar
                    </h1>
                    <p class="text-neutral/90 text-lg md:text-base italic mb-2 mx-auto">
                        "Dan berpegangteguhlah kamu semuanya pada tali (agama) Allah, dan janganlah kamu bercerai
                        berai"
                    </p>
                    <p class="text-neutral/70 text-sm mb-4">— QS. Ali 'Imran: 103</p>

                    {{-- Bagian Statistik / Kotak Informasi --}}
                    <div class="flex flex-wrap justify-center gap-8 md:gap-16 border-t border-neutral/15 pt-4 w-full">
                        <div class="flex flex-col items-center">
                            <p class="font-raleway text-xl md:text-2xl text-neutral/80 font-bold">
                                {{ $masjid['tahun_berdiri'] }}
                            </p>
                            <p class="text-xs md:text-sm text-neutral/60 mt-1 uppercase tracking-wider">Tahun berdiri</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="font-raleway text-2xl md:text-2xl text-neutral/80 font-bold">
                                {{ $masjid['luas_tanah'] }}
                            </p>
                            <p class="text-xs md:text-sm text-neutral/60 mt-1 uppercase tracking-wider">Luas tanah</p>
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="font-raleway text-2xl md:text-2xl text-neutral/80 font-bold">
                                {{ $masjid['jamaah_tetap'] }}
                            </p>
                            <p class="text-xs md:text-sm text-neutral/60 mt-1 uppercase tracking-wider">Jamaah tetap</p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        {{-- ================= PROFIL SINGKAT ================= --}}
        <section id="profil" class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-5 gap-12 items-center">
            <div class="md:col-span-2 items-center justify-center">
                <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2">Profil Singkat
                </p>
                <h2 class="font-display text-3xl text-secondary">Tentang {{ $masjid['nama'] }}</h2>
            </div>
            <div class="md:col-span-3 space-y-4 text-ink/80 leading-relaxed">
                <p>{{ $masjid['nama'] }} berdiri sejak tahun {{ $masjid['tahun_berdiri'] }} atas prakarsa warga sekitar yang
                    mewakafkan tanah seluas {{ $masjid['luas_tanah'] }}. Sejak saat itu, masjid ini tumbuh menjadi pusat
                    ibadah sekaligus ruang belajar dan silaturahmi bagi warga.</p>
                <p>Selain sebagai tempat salat lima waktu dan Jumat, masjid ini aktif menyelenggarakan kajian rutin,
                    baik ikhwan maupun akhwat, serta kegiatan sosial seperti santunan yatim dan penyembelihan qurban
                    setiap tahun.</p>
                <p>Pengelolaan masjid dijalankan oleh Dewan Kemakmuran Masjid (DKM) bersama para jamaah lain, dengan prinsip
                    transparansi dan gotong royong.</p>
            </div>
        </section>

        <div class="max-w-6xl mx-auto px-6">
            <div class="h-px bg-secondary/10"></div>
        </div>

        {{-- ================= SEJARAH (timeline) ================= --}}
        <section id="sejarah" class="max-w-6xl mx-auto px-6 py-20">
            <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2 text-center">Perjalanan</p>
            <h2 class="font-display text-3xl text-secondary text-center mb-14">Sejarah Singkat</h2>

            <div class="relative max-w-3xl mx-auto">
                <div class="absolute left-[27px] md:left-1/2 top-0 bottom-0 w-px bg-secondary/15 md:-translate-x-1/2"></div>
                <div class="space-y-10">
                    @foreach ($sejarah as $i => $item)
                        <div class="relative flex md:justify-center">
                            <div
                                class="absolute left-0 md:left-1/2 md:-translate-x-1/2 w-3.5 h-3.5 rounded-full bg-primary border-4 border-neutral ring-1 ring-secondary/20 mt-1.5">
                            </div>
                            <div
                                class="ml-12 md:ml-0 md:w-[calc(50%-2.5rem)] {{ $i % 2 === 0 ? 'md:mr-auto md:pr-10 md:text-right' : 'md:ml-auto md:pl-10' }}">
                                <p class="font-raleway text-sm text-cookies mb-1">{{ $item['tahun'] }}</p>
                                <p class="font-display text-lg text-secondary mb-1">{{ $item['judul'] }}</p>
                                <p class="text-sm text-ink/70">{{ $item['desk'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ================= VISI MISI ================= --}}
        <section class="bg-secondary/5">
            <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-8">
                <div class="bg-primary text-white p-6 sm:p-8 rounded-3xl shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center mb-6">
                            <iconify-icon icon="mdi:eye-outline" class="text-xl"></iconify-icon>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Visi</h3>
                        <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                            {{ $visionMission->visi }}
                        </p>
                    </div>
                </div>
                <div class=" bg-white p-6 sm:p-8 rounded-3xl border border-stone-200/60 shadow-sm">
                    <div class="w-10 h-10 rounded-2xl bg-stone-100 text-primary flex items-center justify-center mb-6">
                        <iconify-icon icon="mdi:bullseye-arrow" class="text-xl"></iconify-icon>
                    </div>
                    <h3 class="text-xl font-bold text-stone-950 mb-4">Misi</h3>
                    <ul class="space-y-3 text-stone-600 text-sm sm:text-base">
                        @foreach ($visionMission->misi as $misi)
                            <li class="flex gap-3 items-start">
                                <span class="w-1.5 h-1.5 rounded-full bg-primary mt-2 shrink-0"></span>
                                <span>{{ $misi }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- ================= JADWAL SHOLAT (signature) ================= --}}
        <section class="max-w-6xl mx-auto px-6 py-20">
            <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2 text-center">Waktu Ibadah</p>
            <h2 class="font-display text-3xl text-secondary text-center mb-12">Jadwal Sholat Hari Ini</h2>

            <div class="relative bg-secondary p-8 md:p-10">
                <svg class="absolute top-4 right-4 w-10 h-10 text-primary/30" viewBox="0 0 50 50" fill="none"
                    stroke="currentColor" stroke-width="1">
                    <path d="M25 4 L30 18 L44 18 L33 27 L37 41 L25 32 L13 41 L17 27 L6 18 L20 18 Z" />
                </svg>
                <svg class="absolute bottom-4 left-4 w-10 h-10 text-primary/30" viewBox="0 0 50 50" fill="none"
                    stroke="currentColor" stroke-width="1">
                    <path d="M25 4 L30 18 L44 18 L33 27 L37 41 L25 32 L13 41 L17 27 L6 18 L20 18 Z" />
                </svg>
                <x-prayer-time-widget />
                <p class="text-center text-neutral/50 text-xs mt-6">Jadwal menyesuaikan kalender hijriah setempat — cek
                    pengumuman terbaru di papan masjid.</p>
            </div>
        </section>

        {{-- ================= STRUKTUR PENGURUS ================= --}}

        <section id="pengurus" class="bg-secondary/5">
            <div class="max-w-6xl mx-auto px-6 py-20">
                <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2 text-center">Dewan Kemakmuran
                    Masjid</p>
                <h2 class="font-display text-3xl text-secondary text-center mb-6">Struktur Pengurus</h2>

                {{-- 1. DEWAN PENASEHAT --}}
                <div class="bg-white p-6 sm:p-8 rounded-3xl border border-stone-200/60 shadow-sm text-center">
                    <p class="text-sm sm:text-base font-bold uppercase tracking-wider text-stone-400 mb-6">
                        Dewan Penasehat
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 md:gap-8">
                        @foreach ($advisors as $advisor)
                            <div
                                class="flex flex-col items-center text-center gap-3 p-6 bg-stone-50 rounded-2xl border border-stone-100 shrink-0 shadow-xs transition-all duration-200 hover:scale-[1.02]">

                                <x-member-avatar :member="$advisor->member" size="w-14 h-14" textSize="text-lg" />
                                <div class="space-y-1">
                                    <h4 class="font-bold text-sm text-stone-900 leading-tight">
                                        {{ $advisor->member->name ?? 'Nama' }}
                                    </h4>
                                    <p class="text-xs text-primary font-semibold">
                                        {{ $advisor->position->name ?? 'Penasehat' }}
                                    </p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- 2. PENGURUS HARIAN --}}
                <div class="space-y-6 py-6">
                    {{-- Ketua (Solo Center) --}}
                    @if($chairman)
                        <div class="flex justify-center">
                            <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm text-center w-full sm:w-56">
                                <x-member-avatar :member="$chairman->member" size="w-16 h-16" textSize="text-xl" />
                                <h4 class="font-bold text-base text-stone-900 mt-3 leading-tight">{{ $chairman->member->name }}
                                </h4>
                                <span
                                    class="mt-1.5 inline-block bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full">
                                    {{ $chairman->position->name }}
                                </span>
                            </div>
                        </div>
                    @endif

                    {{-- Sekre & Bendahara (Berdampingan di Tengah) --}}
                    <div class="flex flex-wrap justify-center gap-6">
                        @if ($secretary)
                            <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm text-center w-full sm:w-56">
                                <x-member-avatar :member="$secretary->member" size="w-14 h-14" textSize="text-lg" />
                                <h4 class="font-bold text-sm text-stone-900 mt-3 leading-tight">{{ $secretary->member->name }}
                                </h4>
                                <span
                                    class="mt-1.5 inline-block bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full">
                                    {{ $secretary->position->name }}
                                </span>
                            </div>
                        @endif
                        @if ($treasurer)
                            <div class="bg-white p-5 rounded-2xl border border-stone-200 shadow-sm text-center w-full sm:w-56">
                                <x-member-avatar :member="$treasurer->member" size="w-14 h-14" textSize="text-lg" />
                                <h4 class="font-bold text-sm text-stone-900 mt-3 leading-tight">{{ $treasurer->member->name }}
                                </h4>
                                <span
                                    class="mt-1.5 inline-block bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full">
                                    {{ $treasurer->position->name }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- 3. BIDANG-BIDANG / DIVISI (Terpusat secara keseluruhan) --}}
                <div class="flex flex-wrap justify-center gap-6">
                    @foreach ($divisions as $divisionName => $members)
                        <div
                            class="bg-white rounded-2xl border border-stone-200/70 shadow-sm overflow-hidden flex flex-col justify-between w-full sm:w-[280px] md:w-[320px] shrink-0">
                            <div class="bg-stone-50 border-b border-stone-100 px-5 py-3 text-center md:text-left">
                                <h3 class="text-stone-900 font-bold text-sm">{{ $divisionName }}</h3>
                            </div>
                            <div class="p-4 space-y-3">
                                @foreach ($members as $organization)
                                    <div class="flex items-center gap-3">
                                        {{-- Avatar Mini --}}
                                        <div
                                            class="w-9 h-9 rounded-full overflow-hidden border border-stone-200 bg-stone-100 shrink-0 flex items-center justify-center">
                                            @if ($organization->member->photo)
                                                <img src="{{ Storage::url($organization->member->photo) }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <span class="text-stone-500 font-bold text-xs">
                                                    {{ strtoupper(substr($organization->member->name, 0, 1)) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-left">
                                            <h4 class="font-semibold text-stone-950 text-xs leading-none mb-1">
                                                {{ $organization->member->name }}
                                            </h4>
                                            <p class="text-[10px] text-stone-400 leading-none">{{ $organization->position->name }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-5">
                    @foreach ($pengurus as $orang)
                    <div class="bg-neutral border border-secondary/10 p-6 flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center font-display text-secondary text-lg shrink-0">
                            {{ collect(explode(' ', $orang['nama']))->map(fn($w) => mb_substr($w, 0,
                            1))->take(2)->implode('') }}
                        </div>
                        <div>
                            <p class="font-medium text-ink">{{ $orang['nama'] }}</p>
                            <p class="text-sm text-ink/60">{{ $orang['jabatan'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
            </div>
        </section>

        {{-- ================= FASILITAS & KEGIATAN ================= --}}
        <section class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-16">
            <div>
                <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2">Fasilitas</p>
                <h2 class="font-display text-2xl text-secondary mb-6">Fasilitas Masjid</h2>
                <ul class="space-y-4">
                    @foreach ($fasilitas as $f)
                        <li class="flex items-center gap-3 text-ink/80 border-b border-secondary/10 pb-4">
                            <span class="w-1.5 h-1.5 bg-primary rounded-full shrink-0"></span>
                            {{ $f['nama'] }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2">Agenda Rutin</p>
                <h2 class="font-display text-2xl text-secondary mb-6">Kegiatan Masjid</h2>
                <ul class="space-y-4">
                    @foreach ($kegiatan as $k)
                        <li class="flex items-center justify-between gap-3 text-ink/80 border-b border-secondary/10 pb-4">
                            <span>{{ $k['nama'] }}</span>
                            <span class="font-raleway text-sm text-cookies">{{ $k['waktu'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        {{-- ================= GALERI ================= --}}
        <section id="galeri" class="bg-secondary/5">
            <div class="max-w-6xl mx-auto px-6 py-20">
                <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2 text-center">Dokumentasi</p>
                <h2 class="font-display text-3xl text-secondary text-center mb-12">Galeri</h2>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($galeri as $foto)
                        <div class="overflow-hidden aspect-[4/3]">
                            <img src="{{ $foto }}" alt="Dokumentasi kegiatan {{ $masjid['nama'] }}"
                                class="w-full h-full object-cover hover:scale-105 transition duration-300">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ================= KONTAK & LOKASI ================= --}}
        <section id="kontak" class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10">
            <div>
                <p class="font-raleway text-xs tracking-widest text-tertiary uppercase mb-2">Kontak</p>
                <h2 class="font-display text-3xl text-secondary mb-6">Hubungi & Kunjungi Kami</h2>

                <ul class="space-y-4 text-ink/80">
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-tertiary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $masjid['alamat'] }}
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-tertiary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +62 823-2962-1484
                    </li>
                    <li class="flex gap-3">
                        <svg class="w-5 h-5 text-tertiary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        info@masjid-alkautsar.id
                    </li>
                </ul>

                <a href="https://wa.me/6282329621484" target="_blank"
                    class="inline-block mt-8 bg-secondary text-neutral text-sm font-medium px-6 py-3 hover:bg-secondary-light transition">
                    Kirim Pesan via WhatsApp
                </a>
            </div>

            <div class="h-72 md:h-full min-h-[280px] border border-secondary/10">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.252412677235!2d110.3958452!3d-6.9795148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b33808fa249%3A0x80e777853de7417!2sMasjid%20Al-Kautsar!5e0!3m2!1sen!2sid!4v1783599415762!5m2!1sen!2sid"
                    class="w-full h-full grayscale-20" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                    title="Lokasi {{ $masjid['nama'] }}">
                </iframe>
            </div>
        </section>
@endsection