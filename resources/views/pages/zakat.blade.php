@extends('layouts.app')

@section('title', 'Zakat, Infaq & Sedekah | Masjid Al-Kautsar Cempolorejo')

@section('content')
<div x-data="{ 
    jumlahJiwa: 1, 
    ketetapanBeras: {{ $riceWeight }}, 
    opsiTambahan: 'tidak_ada', 
    nominalTambahan: '', 
    metodeBayar: '',
    isLoading: false,
    showModal: false,
    responseData: {},
    submitForm() {
        this.isLoading = true;
        fetch('{{ route('zakat.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                nama_pembayar: document.querySelector('input[name=nama_pembayar]').value,
                alamat: document.querySelector('input[name=alamat]').value,
                jumlah_jiwa: this.jumlahJiwa,
                jenis_tambahan: this.opsiTambahan,
                nominal_tambahan: this.nominalTambahan,
                metode_pembayaran: this.metodeBayar
            })
        })
        .then(response => response.json())
        .then(data => {
            this.isLoading = false;
            if(data.success) {
                this.responseData = data.data;
                this.showModal = true;
            } else {
                alert('Gagal: ' + data.message);
            }
        })
        .catch(error => {
            this.isLoading = false;
            alert('Terjadi kesalahan, silakan coba lagi.');
        });
    },
    closeModal() {
        this.showModal = false;
        window.location.reload();
    },
    getWaLink() {
        let phone = '6282329621484';
        let name = this.responseData.muzakki_name || '';
        let code = this.responseData.zakat_code || '';
        let rice = this.responseData.rice_total || 0;
        let text = '';
        
        if (!this.responseData.has_infaq) {
            text = `Assalamu'alaikum, saya ${name} dengan Kode Pendaftaran Zakat *${code}* bermaksud melakukan konfirmasi penyerahan beras sejumlah ${rice} kg.`;
        } else {
            let infaqMethod = this.responseData.infaq?.payment_method;
            let nominal = (this.responseData.infaq?.total_amount || 0).toLocaleString('id-ID');
            if (infaqMethod === 'tunai') {
                text = `Assalamu'alaikum, saya ${name} dengan Kode Pendaftaran Zakat *${code}* bermaksud melakukan konfirmasi penyerahan beras sejumlah ${rice} kg dan infaq tunai sebesar Rp ${nominal}.`;
            } else {
                text = `Assalamu'alaikum, saya ${name} dengan Kode Pendaftaran Zakat *${code}* bermaksud melakukan konfirmasi penyerahan beras sejumlah ${rice} kg, dan berikut ini adalah bukti transfer infaq sebesar Rp ${nominal}.`;
            }
        }
        return `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
    }
}">

    <section id="beranda" class="relative bg-secondary text-neutral overflow-hidden min-h-[45vh] flex items-center">

        <div class="relative mx-auto px-6 py-16 md:py-6 flex flex-col items-center justify-center text-center">
            <div class="max-w-6xl w-full">
                <h1 class="font-display font-semibold text-white text-2xl md:text-4xl leading-tight mb-2">
                    <span class="text-primary">Zakat Infaq dan Shodaqoh</span> Masjid Al Kautsar
                </h1>
                <p class="text-neutral/90 text-sm md:text-base italic mb-2 mx-auto">
                    "Ambillah zakat dari harta mereka (guna) menyucikan dan membersihkan mereka, <br>dan doakanlah mereka
                    karena
                    sesungguhnya doamu adalah ketenteraman bagi mereka."
                </p>
                <p class="text-neutral/70 text-xs md:text-sm mb-4">— QS. At-Taubah · Ayat 103</p>

                <div class="mt-8 flex flex-col sm:flex-row items-center gap-3 justify-center">
                    <a href="#kalkulator"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary hover:bg-tertiary text-secondary font-raleway font-bold px-7 py-3.5 rounded-full transition-colors shadow-lg shadow-primary/20">
                        <iconify-icon icon="mdi:calculator-variant-outline" class="text-lg"></iconify-icon>
                        Membayar Zakat
                    </a>
                    <a href="#program"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 border border-primary/40 hover:border-primary text-neutral font-raleway font-semibold px-7 py-3.5 rounded-full transition-colors">
                        Lihat Program
                        <iconify-icon icon="mdi:arrow-right" class="text-lg"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- Main Container -->
    <main id="kalkulator" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 bg-[--color-neutral]">
        <div class="text-center mb-12">
            <h2 class="font-display font-extrabold text-3xl sm:text-4xl mt-2 text-[#0F172A]">Formulir Zakat Fitrah</h2>
            <p class="text-[#0F172A]/60 mt-3 max-w-xl mx-auto">Silakan isi form pendaftaran di bawah ini secara mandiri
                untuk mempercepat proses pencatatan dan penimbangan beras di meja amil masjid.</p>
        </div>

        <!-- Grid Layout: 2 Kolom di Desktop (lg), 1 Kolom di Mobile/Tablet -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- KOLOM KIRI (LEBIH LEBAR): HERO & FORM UTAMA -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Notifikasi Aturan Beras -->
                <div class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-xl flex gap-3 items-center">
                    <div class="text-sm text-amber-900 leading-relaxed">
                        <strong class="font-semibold">Ketentuan Zakat:</strong> Zakat Fitrah wajib berupa beras fisik
                        seberat <span class="font-bold">3 Kg</span> per jiwa. Masjid <span
                            class="underline decoration-amber-500 font-bold">tidak menerima</span> uang tunai sebagai
                        pengganti beras untuk zakat fitrah. Penyerahan zakat beras dapat dilakukan <span
                            class="font-bold">langsung</span>
                        di <span class="font-bold">Masjid Al-Kautsar Cempolorejo mulai pukul 09.00 - 20.00 WIB</span>.
                    </div>
                </div>

                <!-- FORM UTAMA -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
                    <h3
                        class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-slate-100 pb-4">
                        Formulir Pendaftaran ZIS
                    </h3>

                    @if(isset($setting) && $setting->is_zakat_open)
                    <form @submit.prevent="submitForm" class="space-y-6">
                        @csrf

                        <!-- Bagian 1: Data Zakat -->
                        <div>
                            <h3
                                class="text-md font-semibold text-slate-900 mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">
                                <span
                                    class="w-6 h-6 rounded-full bg-orange-100 text-[#B8860B] flex items-center justify-center text-xs font-bold">1</span>
                                Data Muzakki & Zakat Fitrah
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kepala Keluarga /
                                        Pembayar</label>
                                    <input type="text" name="nama_pembayar" required placeholder="Masukkan nama lengkap"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 outline-hidden transition">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Domisili / RT &
                                        RW</label>
                                    <input type="text" name="alamat" required
                                        placeholder="Contoh: RT 03 / RW 02, Kampung Suka Maju"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-[#D4AF37] focus:ring-2 focus:ring-[#D4AF37]/20 outline-hidden transition">
                                </div>
                            </div>

                            <!-- Input Jumlah Jiwa Interaktif -->
                            <div
                                class="mt-4 bg-slate-50 rounded-xl p-4 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-slate-900">Jumlah Jiwa yang
                                        Dizakati</label>
                                    <span class="text-xs text-slate-500">Termasuk diri sendiri dan tanggungan
                                        keluarga</span>
                                </div>
                                <div class="flex items-center gap-3 self-start sm:self-center">
                                    <button type="button" @click="if(jumlahJiwa > 1) jumlahJiwa--"
                                        class="w-10 h-10 bg-white border border-slate-300 rounded-lg flex items-center justify-center font-bold text-lg hover:bg-slate-100 shadow-xs active:scale-95 transition">-</button>
                                    <span class="w-8 text-center font-bold text-lg text-slate-900"
                                        x-text="jumlahJiwa"></span>
                                    <input type="hidden" name="jumlah_jiwa" :value="jumlahJiwa">
                                    <button type="button" @click="jumlahJiwa++"
                                        class="w-10 h-10 bg-white border border-slate-300 rounded-lg flex items-center justify-center font-bold text-lg hover:bg-slate-100 shadow-xs active:scale-95 transition">+</button>
                                </div>
                            </div>

                            <!-- Kotak Kalkulator Real-time -->
                            <div class="mt-3 bg-orange-100 border border-orange-200 rounded-xl p-4 flex items-center gap-3">
                                <p class="text-sm text-[#B8860B] font-medium">
                                    Kewajiban Zakat Anda: <span class="text-base font-bold text-[#B8860B]"
                                        x-text="jumlahJiwa * ketetapanBeras"></span> <span
                                        class="font-bold text-[#B8860B]">Kg Beras</span>.
                                </p>
                            </div>
                        </div>

                        <!-- SECTION TENGAH: ADITIONAL SMART UI (INFAQ/SEDEKAH) -->
                        <div class="pt-4 border-t border-slate-100">
                            <h3 class="text-md font-semibold text-slate-900 mb-3 flex items-center gap-2">
                                <span
                                    class="w-6 h-6 rounded-full bg-orange-100 text-[#B8860B] flex items-center justify-center text-xs font-bold">2</span>
                                Sempurnakan dengan Infaq?
                            </h3>

                            <!-- Radio Card Selector -->
                            <div class="grid grid-cols-2 gap-3">
                                <label
                                    class="border-2 rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer transition-all gap-1 text-center"
                                    :class="opsiTambahan === 'tidak_ada' ? 'border-[#D4AF37] bg-[#D4AF37]/5 text-slate-900 font-semibold' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'">
                                    <input type="radio" name="jenis_tambahan" value="tidak_ada" x-model="opsiTambahan"
                                        class="sr-only">
                                    <iconify-icon icon="heroicons:x-mark"
                                        class="text-2xl font-bold text-red-700"></iconify-icon>
                                    <span class="text-xs font-bold">Tidak Ada</span>
                                </label>
                                <label
                                    class="border-2 rounded-xl p-3 flex flex-col items-center justify-center cursor-pointer transition-all gap-1 text-center"
                                    :class="opsiTambahan === 'infaq' ? 'border-[#D4AF37] bg-[#D4AF37]/5 text-slate-900 font-semibold' : 'border-slate-200 bg-white text-slate-600 hover:bg-slate-50'">
                                    <input type="radio" name="jenis_tambahan" value="infaq" x-model="opsiTambahan"
                                        class="sr-only">
                                    <iconify-icon icon="mdi:cash-multiple"
                                        class="text-2xl font-bold text-green-700"></iconify-icon>
                                    <span class="text-xs font-bold">Infaq</span>
                                </label>
                            </div>
                        </div>

                        <!-- INPUT NOMINAL & METODE (KONDISIONAL - MUNCUL JIKA MEMILIH INFAQ/SEDEKAH) -->
                        <div x-show="opsiTambahan !== 'tidak_ada'" x-transition
                            class="space-y-4 bg-slate-50 p-4 rounded-xl border border-slate-200" x-cloak>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Nominal
                                    Uang (Rp)</label>
                                <input type="number" name="nominal_tambahan" x-model="nominalTambahan"
                                    placeholder="Masukkan nominal, contoh: 50000"
                                    class="w-full px-4 py-2.5 border border-slate-200 bg-white rounded-lg focus:ring-2 focus:ring-[#D4AF37] focus:border-[#D4AF37] outline-none">

                                <!-- Quick Amount Buttons -->
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <button type="button" @click="nominalTambahan = 10000"
                                        class="text-xs bg-white border border-slate-200 px-3 py-1 rounded-md hover:bg-slate-100 cursor-pointer text-slate-700">10rb</button>
                                    <button type="button" @click="nominalTambahan = 20000"
                                        class="text-xs bg-white border border-slate-200 px-3 py-1 rounded-md hover:bg-slate-100 cursor-pointer text-slate-700">20rb</button>
                                    <button type="button" @click="nominalTambahan = 50000"
                                        class="text-xs bg-white border border-slate-200 px-3 py-1 rounded-md hover:bg-slate-100 cursor-pointer text-slate-700">50rb</button>
                                    <button type="button" @click="nominalTambahan = 100000"
                                        class="text-xs bg-white border border-slate-200 px-3 py-1 rounded-md hover:bg-slate-100 cursor-pointer text-slate-700">100rb</button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Metode
                                    Pembayaran Infaq</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="border rounded-xl p-3 flex items-center gap-3 cursor-pointer transition"
                                        :class="metodeBayar == 'tunai' ? 'border-[#D4AF37] bg-[#D4AF37]/5 text-slate-900 font-medium' : 'border-slate-200 bg-white hover:bg-slate-50'">
                                        <input type="radio" name="metode_pembayaran" value="tunai" x-model="metodeBayar"
                                            class="text-[#D4AF37] focus:ring-[#D4AF37]">
                                        <div>
                                            <p class="text-sm leading-none font-semibold">Tunai / Cash</p>
                                            <span class="text-xs text-slate-500">Diserahkan bersama beras</span>
                                        </div>
                                    </label>
                                    <label class="border rounded-xl p-3 flex items-center gap-3 cursor-pointer transition"
                                        :class="metodeBayar == 'transfer_qris' ? 'border-[#D4AF37] bg-[#D4AF37]/5 text-slate-900 font-medium' : 'border-slate-200 bg-white hover:bg-slate-50'">
                                        <input type="radio" name="metode_pembayaran" value="transfer_qris"
                                            x-model="metodeBayar" class="text-[#D4AF37] focus:ring-[#D4AF37]">
                                        <div>
                                            <p class="text-sm leading-none font-semibold">Transfer / QRIS</p>
                                            <span class="text-xs text-slate-500">Scan QR Code setelah ini</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION BAWAH: ADAB / PANDUAN NIAT -->
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-xs text-slate-600 space-y-1">
                            <span class="font-bold text-slate-700 block mb-1">💡 Pengingat Niat Zakat Fitrah (Diri
                                Sendiri):</span>
                            <p class="italic font-serif text-sm text-slate-800">"Nawaitu an ukhrija zakatal fitri 'an nafsi
                                fardhan lillahi ta'ala."</p>
                            <p class="text-slate-500">Artinya: "Aku niat mengeluarkan zakat fitrah untuk diriku sendiri,
                                fardhu karena Allah Ta'ala."</p>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <button type="submit"
                            :disabled="isLoading"
                            class="w-full bg-[#D4AF37] hover:bg-[#B8860B] disabled:opacity-50 active:scale-[0.99] text-[#0F172A] font-extrabold py-4 rounded-xl shadow-lg shadow-[#D4AF37]/10 transition-all text-center text-base cursor-pointer">
                            <span x-text="isLoading ? 'Memproses...' : 'Dapatkan Kode Antrean Zakat'"></span>
                        </button>
                    </form>
                    @else
                    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-8 text-center flex flex-col items-center justify-center min-h-[300px]">
                        <iconify-icon icon="mdi:calendar-lock" class="text-6xl text-slate-300 mb-4"></iconify-icon>
                        <h3 class="font-bold text-xl text-slate-700 mb-2">Penerimaan Belum Dibuka</h3>
                        <p class="text-sm text-slate-500">Mohon maaf, penerimaan Zakat Fitrah saat ini belum dibuka. Silakan tunggu informasi dari pengurus masjid.</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- KOLOM KANAN: LIVE REKAPITULASI (STICKY SIDEBAR DI DESKTOP) -->
            <div class="lg:col-span-1 lg:sticky lg:top-24 space-y-6">

                <!-- Mini Dashboard Transparansi Real-time -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h3
                        class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4 flex items-center justify-between">
                        <span>Informasi Mengenai Zakat</span>
                        <span class="w-2 h-2 bg-[#D4AF37] rounded-full animate-pulse"></span>
                    </h3>

                    <div class="space-y-4">
                        <!-- Counter Beras -->
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs font-semibold text-slate-500">Total Beras Terkumpul</p>
                            <div class="flex items-baseline gap-1 mt-1">
                                <span class="text-2xl font-black text-slate-900">{{ number_format($totalBeras, 0, ',', '.') }}</span>
                                <span class="text-sm font-bold text-slate-500">Kg</span>
                            </div>
                            {{-- <div class="w-full bg-slate-200 h-2 rounded-full mt-3 overflow-hidden">
                                <div class="bg-[#D4AF37] h-full rounded-full" style="width: 65%"></div>
                            </div> --}}
                        </div>

                        <!-- Counter Kas Infaq/Sedekah -->
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                            <p class="text-xs font-semibold text-slate-500">Kas Infaq & Sedekah Melalui Zakat</p>
                            <div class="flex items-baseline gap-1 mt-1">
                                <span class="text-2xl font-black text-slate-900">Rp {{ number_format($totalKas, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Counter Jiwa Terdata -->
                        <div class="grid grid-cols-2 gap-3">
                            <div class="p-3 bg-slate-50 rounded-xl text-center border border-slate-100">
                                <p class="text-[10px] font-bold uppercase text-slate-400">Total Muzakki</p>
                                <p class="text-lg font-bold text-slate-800 mt-0.5">{{ number_format($totalMuzakki, 0, ',', '.') }} <span
                                        class="text-xs font-normal text-slate-500">Jiwa</span></p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-xl text-center border border-slate-100">
                                <p class="text-[10px] font-bold uppercase text-slate-400">Mustahik Tetap</p>
                                <p class="text-lg font-bold text-slate-800 mt-0.5">120 <span
                                        class="text-xs font-normal text-slate-500">KK</span></p>
                            </div>
                        </div>
                    </div>

                    <p class="text-[11px] text-slate-400 text-center mt-4">Data di atas diperbarui otomatis</p>
                </div>

                <!-- Kontak Bantuan / Footer Informasi -->
                <div class="bg-slate-100 p-4 rounded-xl border border-slate-200 text-center">
                    <p class="text-xs font-semibold text-slate-600">Butuh Bantuan Pengisian?</p>
                    <p class="text-xs text-slate-500 mt-1">Hubungi Petugas Amil di Meja Utama atau melalui:</p>
                    <a href="https://wa.me/6282329621484" target="_blank"
                        class="inline-flex items-center gap-1.5 text-xs text-[#B8860B] font-bold mt-2 hover:underline">
                        <span>WhatsApp Amil: 0823-2962-1484</span>
                    </a>
                </div>

            </div>
        </div>
    </main>

    </body>

    {{-- ============ PROGRAM INFAQ & SEDEKAH ============ --}}
    <section id="program" class="py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-secondary/[0.03]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-14">
                <span class="font-script text-tertiary text-3xl">Jariyah pilihan</span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl mt-2">Program Infaq &amp; Sedekah</h2>
                <p class="text-secondary/60 mt-3 max-w-xl mx-auto">Pilih program yang ingin Anda dukung, setiap rupiah
                    tersalurkan dengan amanah.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach($programs as $p)
                    <div
                        class="bg-white rounded-2xl border border-secondary/5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                        <div class="p-6 pb-4 flex-1">
                            <div class="flex items-start justify-between">
                                <span
                                    class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 text-primary text-2xl">
                                    <iconify-icon icon="{{ $p->icon ?? 'mdi:mosque' }}"></iconify-icon>
                                </span>
                                @if($p->badge)
                                    <span
                                        class="text-[11px] font-raleway font-bold tracking-wide bg-cookies/10 text-cookies px-2.5 py-1 rounded-full flex items-center gap-1">
                                        <iconify-icon icon="mdi:alert-circle-outline"></iconify-icon>{{ $p->badge }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="font-display font-bold text-lg mt-4">{{ $p->name }}</h3>
                            <p class="text-secondary/60 text-sm mt-2 leading-relaxed">{{ $p->description }}</p>
                        </div>

                        <div class="px-6 pb-6">
                            @php 
                                $terkumpul = $p->donationTransactions()->where('status', 'success')->sum('amount');
                                $target = $p->target_amount ?: 1;
                                $percent = min(100, round(($terkumpul / $target) * 100)); 
                            @endphp
                            <div class="w-full h-2 rounded-full progress-track overflow-hidden">
                                <div class="h-full rounded-full bg-gradient-to-r from-primary to-tertiary"
                                    style="width: {{ $percent }}%"></div>
                            </div>
                            <div class="flex justify-between items-center mt-2.5 text-xs font-raleway">
                                <span class="text-secondary font-bold">Rp
                                    {{ number_format($terkumpul, 0, ',', '.') }}</span>
                                <span class="text-secondary/50">{{ $percent }}% dari Rp
                                    {{ number_format($p->target_amount, 0, ',', '.') }}</span>
                            </div>
                            <a href="#pembayaran"
                                class="mt-4 w-full inline-flex items-center justify-center gap-2 border border-secondary/15 hover:bg-secondary hover:text-neutral hover:border-secondary font-raleway font-semibold text-sm py-2.5 rounded-full transition-colors">
                                Salurkan Donasi
                                <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ TESTIMONI ============ --}}
    <section class="py-20 lg:py-28 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-14">
                <span class="font-script text-tertiary text-3xl">Kisah Penyaluran Zakat</span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl mt-2">Dampak Bagi Sesama</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($testimoni as $t)
                    <div class="bg-white border border-secondary/5 rounded-2xl p-6 shadow-sm">
                        <iconify-icon icon="mdi:format-quote-open" class="text-3xl text-primary/40"></iconify-icon>
                        <p class="text-secondary/70 text-sm leading-relaxed mt-2">{{ $t->content }}</p>
                        <div class="flex items-center gap-3 mt-5 pt-4 border-t border-secondary/5">
                            <span class="w-9 h-9 rounded-full bg-secondary/5 flex items-center justify-center text-tertiary">
                                <iconify-icon icon="mdi:account"></iconify-icon>
                            </span>
                            <p class="font-raleway font-semibold text-sm">{{ $t->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ FAQ ============ --}}
    <section id="faq" class="py-20 lg:py-28 px-4 sm:px-6 lg:px-8 bg-secondary/[0.03]">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12">
                <span class="font-script text-tertiary text-3xl">Sering ditanyakan</span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl mt-2">Pertanyaan Umum</h2>
            </div>

            <div x-data="{ open: 0 }" class="space-y-3">
                @foreach($faqs as $i => $faq)
                    <div class="bg-white border border-secondary/5 rounded-xl overflow-hidden">
                        <button @click="open = (open === {{ $i }} ? -1 : {{ $i }})"
                            class="w-full flex items-center justify-between gap-4 p-5 text-left">
                            <span class="font-raleway font-semibold">{{ $faq->question }}</span>
                            <iconify-icon icon="mdi:chevron-down"
                                class="text-xl text-tertiary shrink-0 transition-transform duration-300"
                                :class="open === {{ $i }} ? 'rotate-180' : ''"></iconify-icon>
                        </button>
                        <div x-show="open === {{ $i }}" x-cloak x-collapse
                            class="px-5 pb-5 text-secondary/60 text-sm leading-relaxed">
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ CTA BANNER ============ --}}
    <section class="px-4 sm:px-6 lg:px-8 pb-20 lg:pb-28">
        <div
            class="max-w-7xl mx-auto bg-secondary rounded-3xl px-6 sm:px-12 py-14 text-center relative overflow-hidden star-pattern">
            <span class="font-script text-primary text-3xl">Jangan tunda kebaikan</span>
            <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-neutral mt-2 max-w-2xl mx-auto">
                Mari Berbagi Melalui Zakat, Infaq, dan Sedekah Hari Ini
            </h2>
            <a href="#kalkulator"
                class="mt-8 inline-flex items-center gap-2 bg-primary hover:bg-tertiary text-secondary font-raleway font-bold px-8 py-4 rounded-full transition-colors shadow-lg shadow-primary/20">
                <iconify-icon icon="mdi:hand-heart-outline" class="text-lg"></iconify-icon>
                Tunaikan Sekarang
            </a>
        </div>
    </section>

    {{-- ============ MODAL KODE ANTREAN ZAKAT ============ --}}
    <div
        x-show="showModal"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px);"
        @keydown.escape.window="closeModal()"
    >
        <div
            x-show="showModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-y-auto max-h-[90vh] md:max-h-[85vh] scrollbar-thin"
            @click.stop
        >
            <div class="bg-gradient-to-br from-secondary to-slate-800 p-6 text-center">
                <div class="w-16 h-16 bg-green-400/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <iconify-icon icon="mdi:check-circle" class="text-4xl text-green-400"></iconify-icon>
                </div>
                <h3 class="text-white font-bold text-lg">Pendaftaran Berhasil!</h3>
                <p class="text-white/70 text-xs mt-1">Tunjukkan kode ini kepada amil di meja penerimaan atau konfirmasi via Whatsapp.</p>
            </div>

            {{-- Body Modal --}}
            <div class="p-6 space-y-3">
                {{-- Kode Zakat --}}
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-center">
                    <p class="text-xs text-amber-700 mb-1">Kode Antrean Zakat Anda</p>
                    <p class="text-2xl font-bold text-secondary tracking-widest font-mono" x-text="responseData.zakat_code ?? '-'"></p>
                    <p class="text-xs text-amber-600 mt-1">Tunjukkan kepada amil di meja penerimaan</p>
                </div>

                {{-- Detail Zakat --}}
                <div class="space-y-2">
                    <div class="flex justify-between text-sm border-b border-slate-100 pb-2">
                        <span class="text-slate-500">Nama</span>
                        <span class="font-semibold text-slate-900" x-text="responseData.muzakki_name ?? '-'"></span>
                    </div>
                    <div class="flex justify-between text-sm pb-2 border-b border-slate-100">
                        <span class="text-slate-500">Total Jiwa</span>
                        <span class="font-semibold text-slate-900 text-right" x-text="(responseData.jumlah_jiwa ?? 0) + ' Orang'"></span>
                    </div>
                    <div class="flex justify-between text-sm pb-2">
                        <span class="text-slate-500">Total Beras Zakat</span>
                        <span class="font-semibold text-slate-900 text-right" x-text="(responseData.rice_total ?? 0) + ' Kg'"></span>
                    </div>
                </div>

                {{-- Bagian Infaq (Kondisional) --}}
                <template x-if="responseData.has_infaq">
                    <div class="mt-4">
                        {{-- Infaq: Tunai --}}
                        <template x-if="responseData.infaq && responseData.infaq.payment_method === 'tunai'">
                            <div class="bg-green-50 border border-green-200 rounded-2xl p-4 text-center">
                                <iconify-icon icon="mdi:cash-multiple" class="text-3xl text-green-600 mb-1"></iconify-icon>
                                <p class="text-xs font-bold uppercase tracking-wider text-green-700">Infaq Tunai</p>
                                <p class="text-sm text-green-800 mt-1">Serahkan infaq berikut bersama beras zakat Anda kepada Amil:</p>
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
                                    Gunakan Kode Zakat <span class="font-mono font-bold" x-text="responseData.zakat_code"></span> sebagai Berita Transfer / Referensi saat mengonfirmasi Infaq Anda.
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                {{-- Info tambahan untuk tunai saja --}}
                <div class="text-center text-xs text-slate-400 mt-2" x-show="!responseData.has_infaq">
                    Segera serahkan beras zakat Anda kepada petugas Amil di Masjid Al-Kautsar.
                </div>

                <div class="text-center text-xs text-slate-500 mt-4 p-3 bg-slate-50 rounded-xl border border-slate-200">
                    Konfirmasi Zakat dan Infaq Anda: <br>
                    <a :href="getWaLink()" target="_blank" 
                    class="text-blue-600 hover:text-blue-800 font-bold">082329621484 (WA Admin)</a>
                </div>

                <button @click="closeModal()"
                    class="w-full bg-secondary text-white font-bold py-3.5 rounded-2xl hover:bg-secondary/90 transition-all active:scale-[0.99] mt-4">
                    Selesai
                </button>
            </div>
        </div>

    </div>{{-- end x-data outer wrapper --}}
@endsection