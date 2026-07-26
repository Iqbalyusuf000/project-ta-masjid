@extends('layouts.app')

@section('title', "Pendaftaran I'tikaf Ramadhan | Masjid Al-Kautsar Cempolorejo")

@section('content')

    {{-- ================================================================
         ALPINE.JS ROOT STATE
         ================================================================ --}}
    <div x-data="{
        gender: '',
        daysSelected: [],
        opsiTambahan: 'tidak_ada',
        nominalTambahan: '',
        metodeBayar: '',
        isLoading: false,
        showModal: false,
        responseData: {},

        toggleDay(day) {
            const idx = this.daysSelected.indexOf(day);
            if (idx === -1) {
                this.daysSelected.push(day);
            } else {
                this.daysSelected.splice(idx, 1);
            }
        },

        isDaySelected(day) {
            return this.daysSelected.includes(day);
        },

        formatRupiah(num) {
            return 'Rp ' + Number(num).toLocaleString('id-ID');
        },

        submitForm() {
            const name      = document.querySelector('input[name=name]').value;
            const whatsapp  = document.querySelector('input[name=whatsapp]').value;

            if (!name || !whatsapp || !this.gender || this.daysSelected.length === 0) {
                alert('Mohon lengkapi semua data yang wajib diisi.');
                return;
            }
            if (this.opsiTambahan === 'infaq' && (!this.nominalTambahan || this.nominalTambahan < 1000)) {
                alert('Nominal infaq minimal Rp 1.000.');
                return;
            }

            this.isLoading = true;
            fetch('{{ route('itikaf.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    name:              name,
                    whatsapp:          whatsapp,
                    gender:            this.gender,
                    days_selected:     this.daysSelected,
                    jenis_tambahan:    this.opsiTambahan,
                    nominal_tambahan:  this.nominalTambahan,
                    metode_pembayaran: this.metodeBayar
                })
            })
            .then(res => res.json())
            .then(data => {
                this.isLoading = false;
                if(data.success) {
                    this.responseData = data.data;
                    this.showModal = true;
                } else {
                    alert('Gagal: ' + data.message);
                }
            })
            .catch(err => {
                this.isLoading = false;
                alert('Terjadi kesalahan sistem.');
            });
        },

        closeModal() {
            this.showModal = false;
            window.location.reload();
        },

        getWaLink() {
            let phone = '6282329621484';
            let name = this.responseData.name || '';
            let code = this.responseData.itikaf_code || '';
            let days = this.responseData.days_selected ? this.responseData.days_selected.join(', ') : '';
            let text = '';
            
            if (!this.responseData.has_infaq) {
                text = `Assalamu'alaikum, saya ${name} dengan Kode Pendaftaran I'tikaf *${code}* bermaksud melakukan konfirmasi keikutsertaan I'tikaf pada ${days}.`;
            } else {
                let infaqMethod = this.responseData.infaq?.payment_method;
                let nominal = (this.responseData.infaq?.total_amount || 0).toLocaleString('id-ID');
                if (infaqMethod === 'tunai') {
                    text = `Assalamu'alaikum, saya ${name} dengan Kode Pendaftaran I'tikaf *${code}* bermaksud melakukan konfirmasi keikutsertaan I'tikaf dan penyerahan infaq tunai sebesar Rp ${nominal}.`;
                } else {
                    text = `Assalamu'alaikum, saya ${name} dengan Kode Pendaftaran I'tikaf *${code}* bermaksud melakukan konfirmasi keikutsertaan I'tikaf, dan berikut ini adalah bukti transfer infaq sebesar Rp ${nominal}.`;
                }
            }
            return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
        }
    }">

    {{-- ================================================================
         SECTION 1: HERO & STATISTIK KUOTA
         ================================================================ --}}
    <section class="relative bg-secondary text-neutral overflow-hidden min-h-[50vh] flex items-center">
        {{-- Ornamen latar --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none">
            <div class="absolute top-10 left-10 w-72 h-72 rounded-full bg-primary blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 rounded-full bg-primary blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 py-16 md:py-20 w-full">
            <div class="text-center mb-10">
                <span class="inline-block bg-primary/10 text-primary font-semibold text-xs uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">
                    Ramadhan {{ now()->format('Y') }}
                </span>
                <h1 class="font-display font-bold text-white text-3xl md:text-5xl leading-tight mb-3">
                    Pendaftaran <span class="text-primary">I'tikaf Ramadhan</span>
                </h1>
                <p class="text-neutral/80 text-sm md:text-base italic max-w-2xl mx-auto mb-2">
                    "Rasulullah ﷺ beri'tikaf pada sepuluh hari terakhir Ramadhan hingga beliau wafat,
                    kemudian istri-istri beliau beri'tikaf sepeninggal beliau."
                </p>
                <p class="text-neutral/50 text-xs md:text-sm mb-8">— HR. Bukhari & Muslim</p>

                <div class="flex flex-col sm:flex-row items-center gap-3 justify-center">
                    <a href="#form-pendaftaran"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-secondary font-bold px-8 py-3.5 rounded-full transition-all shadow-lg shadow-primary/30 active:scale-95">
                        <iconify-icon icon="mdi:mosque" class="text-xl"></iconify-icon>
                        Daftar Sekarang
                    </a>
                    <a href="#faq"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-primary/40 hover:border-primary text-neutral font-semibold px-8 py-3.5 rounded-full transition-all">
                        Lihat FAQ
                        <iconify-icon icon="mdi:chevron-down" class="text-xl"></iconify-icon>
                    </a>
                </div>
            </div>

            {{-- Kartu Statistik Kuota --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl mx-auto">
                {{-- Total Jamaah --}}
                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-5 text-center">
                    <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <iconify-icon icon="mdi:account-group" class="text-xl text-primary"></iconify-icon>
                    </div>
                    <div class="text-3xl font-bold text-white mb-1">{{ $totalJamaah }}</div>
                    <div class="text-xs text-neutral/60 uppercase tracking-wider">Total Jamaah Terdaftar</div>
                </div>
                {{-- Ikhwan --}}
                <div class="bg-sky-900/30 backdrop-blur-sm border border-sky-400/20 rounded-2xl p-5 text-center">
                    <div class="w-10 h-10 bg-sky-400/20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <iconify-icon icon="mdi:human-male" class="text-xl text-sky-400"></iconify-icon>
                    </div>
                    <div class="text-3xl font-bold text-sky-300 mb-1">{{ $totalIkhwan }}</div>
                    <div class="text-xs text-sky-300/60 uppercase tracking-wider">Jamaah Ikhwan (L)</div>
                </div>
                {{-- Akhwat --}}
                <div class="bg-rose-900/30 backdrop-blur-sm border border-rose-400/20 rounded-2xl p-5 text-center">
                    <div class="w-10 h-10 bg-rose-400/20 rounded-full flex items-center justify-center mx-auto mb-3">
                        <iconify-icon icon="mdi:human-female" class="text-xl text-rose-400"></iconify-icon>
                    </div>
                    <div class="text-3xl font-bold text-rose-300 mb-1">{{ $totalAkhwat }}</div>
                    <div class="text-xs text-rose-300/60 uppercase tracking-wider">Jamaah Akhwat (P)</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         SECTION 2: FASILITAS
         ================================================================ --}}
    <section class="bg-slate-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="font-display font-bold text-2xl sm:text-3xl text-slate-900">Fasilitas I'tikaf <span class="text-primary">Gratis</span></h2>
                <p class="text-slate-500 mt-2 text-sm max-w-lg mx-auto">Nikmati kemudahan beribadah dengan fasilitas lengkap yang telah kami siapkan</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach([
                        ['icon' => 'mdi:bed-outline', 'label' => 'Tempat Tidur', 'desc' => 'Kasur & bantal tersedia'],
                        ['icon' => 'mdi:food-variant', 'label' => 'Makan Gratis', 'desc' => 'Sahur & buka puasa'],
                        ['icon' => 'mdi:wifi', 'label' => 'Wi-Fi Masjid', 'desc' => 'Akses internet 24 jam'],
                        ['icon' => 'mdi:book-open-variant', 'label' => 'Bimbingan Ustadz', 'desc' => 'Kajian setiap malam'],
                        ['icon' => 'mdi:shower', 'label' => 'Kamar Mandi', 'desc' => 'Fasilitas MCK bersih'],
                        ['icon' => 'mdi:lock-outline', 'label' => 'Area Aman', 'desc' => 'Dilengkapi CCTV 24 Jam'],
                    ] as $fasilitas)
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 flex flex-col items-center text-center shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                        <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center mb-3">
                            <iconify-icon icon="{{ $fasilitas['icon'] }}" class="text-2xl text-[#B8860B]"></iconify-icon>
                        </div>
                        <div class="font-semibold text-slate-900 text-sm mb-0.5">{{ $fasilitas['label'] }}</div>
                        <div class="text-xs text-slate-500">{{ $fasilitas['desc'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================================================================
         SECTION 3: FORM UTAMA (2 KOLOM)
         ================================================================ --}}
    <section id="form-pendaftaran" class="bg-white py-16 lg:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display font-bold text-2xl sm:text-3xl text-slate-900">Formulir Pendaftaran I'tikaf</h2>
                <p class="text-slate-500 mt-2 text-sm max-w-xl mx-auto">Isi data di bawah ini dengan benar. Kode pendaftaran akan diberikan setelah proses berhasil.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- ============================================================
                     KOLOM KIRI (col-span-2): FORM PENDAFTARAN
                     ============================================================ --}}
                <div class="lg:col-span-2">
                    @if(isset($setting) && $setting->is_itikaf_open)
                    <form @submit.prevent="submitForm" class="space-y-6">
                        @csrf

                        {{-- BAGIAN 1: DATA DIRI --}}
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
                            <h3 class="text-base font-bold text-slate-900 mb-5 flex items-center gap-2 border-b border-slate-100 pb-4">
                                <span class="w-7 h-7 rounded-full bg-amber-100 text-[#B8860B] flex items-center justify-center text-xs font-bold flex-shrink-0">1</span>
                                Data Diri Peserta
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" required placeholder="Masukkan nama lengkap"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 outline-none transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="tel" name="whatsapp" required placeholder="Contoh: 08123456789"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 outline-none transition">
                                </div>
                            </div>

                            {{-- Radio Gender --}}
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="border-2 rounded-xl p-4 flex items-center gap-3 cursor-pointer transition-all"
                                        :class="gender === 'L' ? 'border-sky-500 bg-sky-50' : 'border-slate-200 bg-white hover:bg-slate-50'">
                                        <input type="radio" name="gender" value="L" x-model="gender" class="sr-only">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0"
                                            :class="gender === 'L' ? 'bg-sky-100' : 'bg-slate-100'">
                                            <iconify-icon icon="mdi:human-male" class="text-xl"
                                                :class="gender === 'L' ? 'text-sky-600' : 'text-slate-400'"></iconify-icon>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-sm" :class="gender === 'L' ? 'text-sky-700' : 'text-slate-700'">Ikhwan</div>
                                            <div class="text-xs text-slate-400">Saf Laki-laki</div>
                                        </div>
                                    </label>
                                    <label class="border-2 rounded-xl p-4 flex items-center gap-3 cursor-pointer transition-all"
                                        :class="gender === 'P' ? 'border-rose-500 bg-rose-50' : 'border-slate-200 bg-white hover:bg-slate-50'">
                                        <input type="radio" name="gender" value="P" x-model="gender" class="sr-only">
                                        <div class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0"
                                            :class="gender === 'P' ? 'bg-rose-100' : 'bg-slate-100'">
                                            <iconify-icon icon="mdi:human-female" class="text-xl"
                                                :class="gender === 'P' ? 'text-rose-600' : 'text-slate-400'"></iconify-icon>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-sm" :class="gender === 'P' ? 'text-rose-700' : 'text-slate-700'">Akhwat</div>
                                            <div class="text-xs text-slate-400">Area Muslimah</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- BAGIAN 2: PILIH MALAM I'TIKAF --}}
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
                            <h3 class="text-base font-bold text-slate-900 mb-1 flex items-center gap-2 border-b border-slate-100 pb-4">
                                <span class="w-7 h-7 rounded-full bg-amber-100 text-[#B8860B] flex items-center justify-center text-xs font-bold flex-shrink-0">2</span>
                                Pilih Hari I'tikaf
                                <span class="ml-auto text-xs font-normal text-slate-400">Boleh pilih lebih dari satu</span>
                            </h3>
                            <p class="text-xs text-slate-500 mb-4 mt-3">Pilih hari-hari pada 10 malam terakhir Ramadhan yang akan Anda ikuti. Malam ganjil (★) adalah malam prioritas pencarian Lailatul Qadr.</p>

                            {{-- Grid 5 kolom untuk 10 malam --}}
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                                @php
                                    $malamItikaf = [
                                        ['label' => 'Malam 20', 'ganjil' => false],
                                        ['label' => 'Malam 21', 'ganjil' => true],
                                        ['label' => 'Malam 22', 'ganjil' => false],
                                        ['label' => 'Malam 23', 'ganjil' => true],
                                        ['label' => 'Malam 24', 'ganjil' => false],
                                        ['label' => 'Malam 25', 'ganjil' => true],
                                        ['label' => 'Malam 26', 'ganjil' => false],
                                        ['label' => 'Malam 27', 'ganjil' => true],
                                        ['label' => 'Malam 28', 'ganjil' => false],
                                        ['label' => 'Malam 29', 'ganjil' => true],
                                    ];
                                @endphp

                                @foreach($malamItikaf as $malam)
                                    <button type="button" @click="toggleDay('{{ $malam['label'] }}')"
                                        class="relative rounded-xl border-2 p-3 flex flex-col items-center text-center cursor-pointer transition-all duration-200 hover:-translate-y-0.5"
                                        :class="isDaySelected('{{ $malam['label'] }}')
                                            ? 'border-[#D4AF37] bg-amber-50 shadow-md shadow-amber-100'
                                            : 'border-slate-200 bg-white hover:border-slate-300'">
                                        {{-- Ikon berbeda: bulan sabit untuk ganjil, bulan penuh untuk genap --}}
                                        <iconify-icon icon="{{ $malam['ganjil'] ? 'mdi:moon-waning-crescent' : 'mdi:moon-full' }}"
                                            :class="isDaySelected('{{ $malam['label'] }}') ? 'text-[#B8860B]' : 'text-slate-300'"
                                            class="text-2xl mb-1 transition-colors"></iconify-icon>
                                        <span class="text-xs font-bold"
                                            :class="isDaySelected('{{ $malam['label'] }}') ? 'text-slate-900' : 'text-slate-500'">
                                            {{ $malam['label'] }}@if($malam['ganjil'])<span class="text-amber-500 ml-0.5">★</span>@endif
                                        </span>
                                        <span class="text-[10px]"
                                            :class="isDaySelected('{{ $malam['label'] }}') ? 'text-[#B8860B]' : 'text-slate-400'">Ramadhan</span>
                                        <div x-show="isDaySelected('{{ $malam['label'] }}')"
                                            class="absolute top-1.5 right-1.5 w-4 h-4 bg-[#D4AF37] rounded-full flex items-center justify-center">
                                            <iconify-icon icon="mdi:check" class="text-[10px] text-white font-bold"></iconify-icon>
                                        </div>
                                    </button>
                                @endforeach
                            </div>

                            {{-- Legenda --}}
                            <div class="mt-3 flex items-center gap-4 text-xs text-slate-400">
                                <span class="flex items-center gap-1"><iconify-icon icon="mdi:moon-waning-crescent" class="text-amber-400"></iconify-icon> Malam Ganjil (★) — prioritas Lailatul Qadr</span>
                                <span class="flex items-center gap-1"><iconify-icon icon="mdi:moon-full" class="text-slate-300"></iconify-icon> Malam Genap</span>
                            </div>
                            {{-- Ringkasan pilihan --}}
                            <div x-show="daysSelected.length > 0" x-transition
                                class="mt-4 bg-amber-50 border border-amber-200 rounded-xl p-3 flex items-center gap-2">
                                <iconify-icon icon="mdi:calendar-check" class="text-[#B8860B] text-lg flex-shrink-0"></iconify-icon>
                                <p class="text-xs text-amber-900">
                                    Anda memilih <span class="font-bold" x-text="daysSelected.length"></span> malam:
                                    <span class="font-semibold" x-text="daysSelected.join(', ')"></span>
                                </p>
                            </div>
                        </div>

                        {{-- BAGIAN 3: INFAQ RAMADHAN (CONDITIONAL) --}}
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
                            <h3 class="text-base font-bold text-slate-900 mb-5 flex items-center gap-2 border-b border-slate-100 pb-4">
                                <span class="w-7 h-7 rounded-full bg-amber-100 text-[#B8860B] flex items-center justify-center text-xs font-bold flex-shrink-0">3</span>
                                Ingin melakuakan infaq?
                            </h3>

                            <div class="grid grid-cols-2 gap-3">
                                <label class="border-2 rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer transition-all gap-1 text-center"
                                    :class="opsiTambahan === 'tidak_ada' ? 'border-[#D4AF37] bg-[#D4AF37]/5 text-slate-900 font-semibold' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'">
                                    <input type="radio" name="jenis_tambahan" value="tidak_ada" x-model="opsiTambahan" class="sr-only">
                                    <iconify-icon icon="heroicons:x-mark" class="text-2xl text-red-500"></iconify-icon>
                                    <span class="text-xs font-bold">Tidak Sekarang</span>
                                </label>
                                <label class="border-2 rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer transition-all gap-1 text-center"
                                    :class="opsiTambahan === 'infaq' ? 'border-[#D4AF37] bg-[#D4AF37]/5 text-slate-900 font-semibold' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'">
                                    <input type="radio" name="jenis_tambahan" value="infaq" x-model="opsiTambahan" class="sr-only">
                                    <iconify-icon icon="mdi:cash-multiple" class="text-2xl text-green-600"></iconify-icon>
                                    <span class="text-xs font-bold">Ya, Mau Berinfaq</span>
                                </label>
                            </div>

                            {{-- Smart UI Conditional: muncul jika pilih infaq --}}
                            <div x-show="opsiTambahan === 'infaq'" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                                class="mt-5 space-y-4 pt-5 border-t border-slate-100">

                                {{-- Nominal Cepat --}}
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Nominal Infaq</label>
                                    <div class="grid grid-cols-4 gap-2 mb-3">
                                        @foreach([50000, 100000, 200000, 500000] as $nom)
                                            <button type="button" @click="nominalTambahan = {{ $nom }}"
                                                class="rounded-xl py-2 text-xs font-semibold border-2 transition-all"
                                                :class="nominalTambahan == {{ $nom }}
                                                    ? 'border-[#D4AF37] bg-amber-50 text-[#B8860B]'
                                                    : 'border-slate-200 bg-white text-slate-600 hover:border-slate-300'">
                                                Rp {{ number_format($nom, 0, ',', '.') }}
                                            </button>
                                        @endforeach
                                    </div>
                                    <input type="number" name="nominal_tambahan" x-model="nominalTambahan"
                                        placeholder="Atau masukkan nominal lain (min. Rp 1.000)" min="1000"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 outline-none transition">
                                </div>

                                {{-- Metode Pembayaran --}}
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">Metode Pembayaran</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <label class="border-2 rounded-xl p-3 flex items-center gap-2 cursor-pointer transition-all"
                                            :class="metodeBayar === 'tunai' ? 'border-[#D4AF37] bg-amber-50' : 'border-slate-200 hover:border-slate-300'">
                                            <input type="radio" name="metode_pembayaran" value="tunai" x-model="metodeBayar" class="sr-only">
                                            <iconify-icon icon="mdi:cash" class="text-xl"
                                                :class="metodeBayar === 'tunai' ? 'text-[#B8860B]' : 'text-slate-400'"></iconify-icon>
                                            <span class="text-sm font-semibold"
                                                :class="metodeBayar === 'tunai' ? 'text-slate-900' : 'text-slate-600'">Tunai</span>
                                        </label>
                                        <label class="border-2 rounded-xl p-3 flex items-center gap-2 cursor-pointer transition-all"
                                            :class="metodeBayar === 'transfer_qris' ? 'border-[#D4AF37] bg-amber-50' : 'border-slate-200 hover:border-slate-300'">
                                            <input type="radio" name="metode_pembayaran" value="transfer_qris" x-model="metodeBayar" class="sr-only">
                                            <iconify-icon icon="mdi:qrcode-scan" class="text-xl"
                                                :class="metodeBayar === 'transfer_qris' ? 'text-[#B8860B]' : 'text-slate-400'"></iconify-icon>
                                            <span class="text-sm font-semibold"
                                                :class="metodeBayar === 'transfer_qris' ? 'text-slate-900' : 'text-slate-600'">Transfer / QRIS</span>
                                        </label>
                                    </div>
                                </div>

                                {{-- Info total bayar realtime --}}
                                <div x-show="nominalTambahan > 0" class="bg-green-50 border border-green-200 rounded-xl p-3">
                                    <p class="text-xs text-green-800">
                                        Nominal infaq Anda: <span class="font-bold" x-text="formatRupiah(nominalTambahan)"></span><br>
                                        <span class="text-green-600">+ Kode unik 3 digit akan ditambahkan untuk memudahkan verifikasi transfer.</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL SUBMIT --}}
                        <button type="submit"
                            :disabled="isLoading"
                            class="w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-4 px-8 rounded-2xl transition-all shadow-lg shadow-secondary/20 flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed active:scale-[0.99]">
                            <template x-if="!isLoading">
                                <span class="flex items-center gap-2">
                                    <iconify-icon icon="mdi:mosque" class="text-xl"></iconify-icon>
                                    Daftarkan Saya
                                </span>
                            </template>
                            <template x-if="isLoading">
                                <span class="flex items-center gap-2">
                                    <iconify-icon icon="mdi:loading" class="text-xl animate-spin"></iconify-icon>
                                    Memproses...
                                </span>
                            </template>
                        </button>
                    </form>
                    @else
                    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-8 text-center flex flex-col items-center justify-center min-h-[300px]">
                        <iconify-icon icon="mdi:calendar-lock" class="text-6xl text-slate-300 mb-4"></iconify-icon>
                        <h3 class="font-bold text-xl text-slate-700 mb-2">Pendaftaran Belum Dibuka</h3>
                        <p class="text-sm text-slate-500">Mohon maaf, pendaftaran I'tikaf saat ini sedang ditutup atau belum dimulai. Silakan pantau terus informasi dari kami.</p>
                    </div>
                    @endif
                </div>

                {{-- ============================================================
                     KOLOM KANAN (col-span-1): STICKY SIDEBAR
                     ============================================================ --}}
                <div class="lg:col-span-1 space-y-6 lg:sticky lg:top-24">

                    {{-- Timeline Jadwal Harian --}}
                    <div class="bg-secondary text-white rounded-2xl p-6 shadow-lg">
                        <h3 class="font-bold text-base mb-5 flex items-center gap-2">
                            <iconify-icon icon="mdi:calendar-clock" class="text-primary text-xl"></iconify-icon>
                            Jadwal Harian I'tikaf
                        </h3>
                        <div class="space-y-0">
                            @foreach([
                                    ['time' => '18.00', 'event' => 'Berbuka Puasa', 'icon' => 'mdi:food-variant', 'color' => 'text-amber-400'],
                                    ['time' => '19.15', 'event' => 'Shalat Isya Berjamaah', 'icon' => 'mdi:mosque', 'color' => 'text-green-400'],
                                    ['time' => '20.00', 'event' => 'Shalat Tarawih', 'icon' => 'mdi:star-crescent', 'color' => 'text-purple-400'],
                                    ['time' => '21.30', 'event' => 'Kajian & Tadarus', 'icon' => 'mdi:book-open-variant', 'color' => 'text-blue-400'],
                                    ['time' => '23.00', 'event' => 'Istirahat', 'icon' => 'mdi:sleep', 'color' => 'text-slate-400'],
                                    ['time' => '02.30', 'event' => 'Shalat Tahajjud', 'icon' => 'mdi:weather-night', 'color' => 'text-indigo-400'],
                                    ['time' => '03.30', 'event' => 'Makan Sahur', 'icon' => 'mdi:silverware-fork-knife', 'color' => 'text-orange-400'],
                                    ['time' => '04.15', 'event' => 'Shalat Subuh', 'icon' => 'mdi:weather-sunset-up', 'color' => 'text-yellow-400'],
                                    ['time' => '05.00', 'event' => 'Dzikir & Doa Pagi', 'icon' => 'mdi:hands-pray', 'color' => 'text-rose-400'],
                                ] as $jadwal)
                                <div class="flex items-start gap-3 pb-4 relative">
                                    <div class="flex flex-col items-center flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
                                            <iconify-icon icon="{{ $jadwal['icon'] }}" class="text-sm {{ $jadwal['color'] }}"></iconify-icon>
                                        </div>
                                        <div class="w-px h-full bg-white/10 mt-1 min-h-[16px]"></div>
                                    </div>
                                    <div class="pt-1 pb-2">
                                        <div class="text-xs text-primary font-bold">{{ $jadwal['time'] }}</div>
                                        <div class="text-xs text-white/80">{{ $jadwal['event'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Panduan Niat I'tikaf --}}
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6">
                        <h3 class="font-bold text-sm text-slate-900 mb-4 flex items-center gap-2">
                            <iconify-icon icon="mdi:hands-pray" class="text-[#B8860B] text-lg"></iconify-icon>
                            Niat I'tikaf
                        </h3>
                        <div class="text-center mb-3">
                            <p class="text-xl text-slate-800 leading-loose font-arabic" dir="rtl">
                                نَوَيْتُ الِاعْتِكَافَ فِي هَذَا الْمَسْجِدِ لِلَّهِ تَعَالَى
                            </p>
                        </div>
                        <p class="text-xs text-slate-600 italic text-center mb-1">
                            <em>"Nawaytu al-i'tikāfa fī hādzā al-masjidi lillāhi ta'ālā"</em>
                        </p>
                        <p class="text-xs text-slate-700 text-center font-medium">
                            "Aku berniat i'tikaf di masjid ini karena Allah Ta'ala."
                        </p>
                    </div>

                    {{-- Info Barang Bawaan --}}
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="font-bold text-sm text-slate-900 mb-4 flex items-center gap-2">
                            <iconify-icon icon="mdi:bag-personal-outline" class="text-slate-600 text-lg"></iconify-icon>
                            Barang yang Perlu Dibawa
                        </h3>
                        <ul class="space-y-2">
                            @foreach([
                                    'Pakaian ganti & perlengkapan mandi',
                                    'Al-Qur\'an & buku dzikir',
                                    'Mukena / sajadah pribadi',
                                    'Obat-obatan pribadi',
                                    'Charger handphone',
                                    'Tas / koper secukupnya',
                                ] as $item)
                                <li class="flex items-start gap-2 text-xs text-slate-600">
                                    <iconify-icon icon="mdi:check-circle" class="text-green-500 text-sm mt-0.5 flex-shrink-0"></iconify-icon>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================================================================
         SECTION 4: FAQ ACCORDION
         ================================================================ --}}
    <section id="faq" class="bg-slate-50 py-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="font-display font-bold text-2xl sm:text-3xl text-slate-900">Pertanyaan yang Sering Ditanyakan</h2>
                <p class="text-slate-500 mt-2 text-sm">Temukan jawaban atas pertanyaan umum seputar I'tikaf Ramadhan</p>
            </div>

            @if($faqs->isNotEmpty())
                <div class="space-y-3" x-data="{ openFaq: null }">
                    @foreach($faqs as $index => $faq)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                            <button type="button"
                                @click="openFaq === {{ $index }} ? openFaq = null : openFaq = {{ $index }}"
                                class="w-full flex items-center justify-between px-6 py-4 text-left gap-4 hover:bg-slate-50 transition-colors">
                                <span class="font-semibold text-sm text-slate-900 flex-1">{{ $faq->question }}</span>
                                <div class="w-7 h-7 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0 transition-transform duration-300"
                                    :class="openFaq === {{ $index }} ? 'rotate-180 bg-amber-100' : ''">
                                    <iconify-icon icon="mdi:chevron-down"
                                        :class="openFaq === {{ $index }} ? 'text-[#B8860B]' : 'text-slate-400'"
                                        class="text-base transition-colors"></iconify-icon>
                                </div>
                            </button>
                            <div x-show="openFaq === {{ $index }}"
                                x-transition:enter="transition ease-out duration-250"
                                x-transition:enter-start="opacity-0 -translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 -translate-y-1">
                                <div class="px-6 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <iconify-icon icon="mdi:help-circle-outline" class="text-5xl text-slate-300 mb-3"></iconify-icon>
                    <p class="text-slate-400 text-sm">FAQ belum tersedia. Silakan hubungi pengurus masjid.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ================================================================
         MODAL SUKSES PENDAFTARAN
         ================================================================ --}}
    <div 
        x-show="showModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
        @keydown.escape.window="closeModal()"
    >
        <div 
        x-show="showModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" 
        x-transition:enter-end="opacity-100 scale-100"
            class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-y-auto max-h-[90vh] md:max-h-[85vh] scrollbar-thin"
            @click.stop
        >

            {{-- Header Modal --}}
            <div class="bg-gradient-to-br from-secondary to-slate-800 p-6 text-center">
                <div class="w-16 h-16 bg-green-400/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <iconify-icon icon="mdi:check-circle" class="text-4xl text-green-400"></iconify-icon>
                </div>
                <h3 class="text-white font-bold text-lg">Pendaftaran Berhasil!</h3>
                <p class="text-white/70 text-xs mt-1">Barakallahu fiikum. Sampai jumpa di I'tikaf Ramadhan.</p>
            </div>

            {{-- Body Modal --}}
            <div class="p-6 space-y-3">
                {{-- Kode I'tikaf --}}
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-center">
                    <p class="text-xs text-amber-700 mb-1">Kode Pendaftaran I'tikaf Anda</p>
                    <p class="text-2xl font-bold text-secondary tracking-widest" x-text="responseData.itikaf_code"></p>
                    <p class="text-xs text-amber-600 mt-1">Simpan kode ini untuk konfirmasi kepada panitia</p>
                </div>

                {{-- Detail Diri --}}
                <div class="space-y-2">
                    <div class="flex justify-between text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Nama</span>
                        <span class="font-semibold text-slate-900" x-text="responseData.name"></span>
                    </div>
                    <div class="flex justify-between text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Jenis Kelamin</span>
                        <span class="font-semibold" x-text="responseData.gender === 'L' ? 'Ikhwan (L)' : 'Akhwat (P)'"></span>
                    </div>
                    <div class="flex justify-between text-sm pb-2">
                        <span class="text-slate-500">Hari I'tikaf</span>
                        <span class="font-semibold text-slate-900 text-right" x-text="responseData.days_selected ? responseData.days_selected.join(', ') : '-'"></span>
                    </div>
                </div>

                {{-- Info Infaq (conditional) --}}
                <template x-if="responseData.has_infaq">
                    <div class="mt-4">
                        {{-- Infaq: Tunai --}}
                        <template x-if="responseData.infaq && responseData.infaq.payment_method === 'tunai'">
                            <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-center">
                                <iconify-icon icon="mdi:cash-multiple" class="text-3xl text-green-600 mb-1"></iconify-icon>
                                <p class="text-xs font-bold uppercase tracking-wider text-green-700">Infaq Tunai</p>
                                <p class="text-sm text-green-800 mt-1">Serahkan infaq Anda kepada Amil di masjid:</p>
                                <div class="mt-3 bg-white rounded-xl border border-green-200 py-3 px-4">
                                    <p class="text-2xl font-black text-green-700">
                                        Rp <span x-text="(responseData.infaq?.total_amount ?? 0).toLocaleString('id-ID')"></span>
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        (Nominal: Rp <span x-text="(responseData.infaq?.nominal ?? 0).toLocaleString('id-ID')"></span>
                                        + Kode Unik: <span x-text="responseData.infaq?.unique_code ?? 0"></span>)
                                    </p>
                                </div>
                            </div>
                        </template>

                        {{-- Infaq: Transfer / QRIS --}}
                        <template x-if="responseData.infaq && responseData.infaq.payment_method === 'transfer_qris'">
                            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 text-center">
                                <iconify-icon icon="mdi:qrcode-scan" class="text-3xl text-blue-600 mb-1"></iconify-icon>
                                <p class="text-xs font-bold uppercase tracking-wider text-blue-700">Infaq via Transfer / QRIS</p>
                                <p class="text-sm text-blue-800 mt-1">Scan QR Code berikut untuk membayar infaq:</p>

                                {{-- QRIS Image --}}
                                <template x-if="responseData.infaq?.qris_image_url">
                                    <div class="mt-3 bg-white rounded-xl border border-blue-200 p-3 inline-block">
                                        <img :src="responseData.infaq.qris_image_url" alt="QRIS Masjid Al-Kautsar" class="w-40 h-40 object-contain mx-auto rounded-lg">
                                    </div>
                                </template>
                                <template x-if="!responseData.infaq?.qris_image_url">
                                    <div class="mt-3 bg-white rounded-xl border border-blue-200 p-6 text-slate-400 text-xs">
                                        Gambar QRIS belum tersedia.<br>Hubungi pengurus masjid.
                                    </div>
                                </template>

                                <div class="mt-3 bg-white rounded-xl border border-blue-200 py-3 px-4">
                                    <p class="text-xs text-slate-500 mb-1">Total yang harus ditransfer:</p>
                                    <p class="text-2xl font-black text-blue-700">
                                        Rp <span x-text="(responseData.infaq?.total_amount ?? 0).toLocaleString('id-ID')"></span>
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        (Nominal: Rp <span x-text="(responseData.infaq?.nominal ?? 0).toLocaleString('id-ID')"></span>
                                        + Kode Unik: <span x-text="responseData.infaq?.unique_code ?? 0"></span>)
                                    </p>
                                </div>

                                <div class="mt-3 text-xs text-blue-700 text-left space-y-1 bg-white p-3 border border-blue-200 rounded-xl">
                                    <p>Bank Tujuan: <span class="font-bold" x-text="responseData.infaq ? (responseData.infaq.bank_name || '-') : ''"></span></p>
                                    <p>No. Rekening: <span class="font-bold" x-text="responseData.infaq ? (responseData.infaq.account_number || '-') : ''"></span></p>
                                    <p>Atas Nama: <span class="font-bold" x-text="responseData.infaq ? (responseData.infaq.account_name || '-') : ''"></span></p>
                                </div>
                                <div class="mt-3 p-3 bg-blue-100 rounded-xl border border-blue-300 text-xs text-blue-900 text-left">
                                    <span class="font-bold flex items-center gap-1">
                                        <iconify-icon icon="mdi:information" class="text-sm"></iconify-icon> Penting:
                                    </span>
                                    Gunakan Kode Pendaftaran <span class="font-mono font-bold" x-text="responseData.itikaf_code"></span> sebagai Berita Transfer / Referensi saat mengonfirmasi Infaq Anda.
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                <div class="text-center text-xs text-slate-500 mt-4 p-3 bg-slate-50 rounded-xl border border-slate-200">
                    Konfirmasi Pendaftaran I'tikaf dan Infaq Anda: <br>
                    <a :href="getWaLink()" target="_blank" 
                    class="text-blue-600 hover:text-blue-800 font-bold">082329621484 (WA Admin)</a>
                </div>

                <button @click="closeModal()"
                    class="w-full bg-secondary text-white font-bold py-3.5 rounded-2xl hover:bg-secondary/90 transition-all active:scale-[0.99] mt-4">
                    Selesai
                </button>
            </div>
        </div>
    </div>

    </div>{{-- end x-data --}}

@endsection