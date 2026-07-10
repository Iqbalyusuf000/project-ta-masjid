@extends('layouts.app')

@section('title', 'Kontak | Masjid Al-Kautsar Cempolorejo')

@section('content')

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#D4AF37',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#dc2626',
            });
        </script>
    @endif

    {{-- Prayer Time --}}
    <section class="py-4 bg-neutral/40">
        <div class="container mx-auto px-6 md:px-10">
            <x-prayer-time-widget />
        </div>
    </section>

    {{-- Hero Contact --}}
    <section class="relative bg-tertiary py-24 overflow-hidden">
        {{-- Background Decor Elements --}}
        <div class="absolute -top-24 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-20 w-96 h-96 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/10"></div>

        <div class="relative container mx-auto px-6 text-center text-white z-10">
            <span class="text-primary font-semibold tracking-widest uppercase text-xs sm:text-sm mb-3 block">Silaturahmi &
                Koordinasi</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 font-raleway tracking-tight">
                Hubungi Kami
            </h1>
            <p class="max-w-2xl mx-auto text-sm md:text-base leading-relaxed text-stone-200 font-light">
                Masjid Al Kautsar berkomitmen untuk selalu hadir bagi jamaah dan masyarakat.
                Kami membuka pintu selebar-lebarnya untuk pertanyaan, masukan, maupun koordinasi kegiatan keumatan.
            </p>
        </div>
    </section>

    {{-- Contact Content --}}
    <section class="bg-neutral/30 py-16 md:py-24">
        <div class="container mx-auto px-6 md:px-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">

                {{-- Left Column: Info --}}
                <div class="lg:col-span-1 space-y-6">
                    {{-- Title Section --}}
                    <div class="flex items-center gap-3.5 mb-2 pb-3">
                        <div class="w-1.5 h-8 bg-primary rounded-full shadow-sm shadow-primary/50"></div>
                        <h2 class="text-2xl md:text-3xl font-bold text-secondary tracking-tight">
                            Informasi Kontak
                        </h2>
                    </div>

                    {{-- Info Cards Container --}}
                    <div class="space-y-4">
                        {{-- Address Card --}}
                        <div
                            class="bg-white rounded-2xl border border-stone-200/60 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                            <div class="flex gap-4 items-start">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary/10 flex justify-center items-center text-primary shrink-0 transition-colors group-hover:bg-primary group-hover:text-white duration-300">
                                    <iconify-icon icon="mdi:map-marker-outline" class="text-2xl"></iconify-icon>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-bold text-secondary text-base">Alamat Masjid</h3>
                                    <p class="text-sm text-stone-600 leading-relaxed font-light">
                                        {{ $info->address }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Phone Card --}}
                        <div
                            class="bg-white rounded-2xl border border-stone-200/60 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                            <div class="flex gap-4 items-start">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary/10 flex justify-center items-center text-primary shrink-0 transition-colors group-hover:bg-primary group-hover:text-white duration-300">
                                    <iconify-icon icon="mdi:phone-outline" class="text-2xl"></iconify-icon>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-bold text-secondary text-base">Telepon</h3>
                                    <p class="text-sm text-stone-600 font-medium">
                                        {{ $info->phone_number }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Email Card --}}
                        <div
                            class="bg-white rounded-2xl border border-stone-200/60 p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                            <div class="flex gap-4 items-start">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary/10 flex justify-center items-center text-primary shrink-0 transition-colors group-hover:bg-primary group-hover:text-white duration-300">
                                    <iconify-icon icon="mdi:email-outline" class="text-2xl"></iconify-icon>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-bold text-secondary text-base">Email Resmi</h3>
                                    <p class="text-sm text-stone-600 font-light break-all">
                                        {{ $info->email }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- WhatsApp Button --}}
                        <a href="https://wa.me/6282329621484" target="_blank" rel="noopener noreferrer"
                            class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 active:scale-[0.98] transition-all duration-300 text-white py-4 rounded-xl flex justify-center items-center gap-2.5 font-semibold shadow-md shadow-green-100 mt-2">
                            <iconify-icon icon="mdi:whatsapp" class="text-2xl animate-pulse"></iconify-icon>
                            <span>Hubungi Via WhatsApp</span>
                        </a>

                        {{-- Social Media --}}
                        <div class="pt-6 flex flex-col items-center border-t border-stone-200/60 mt-4">
                            <h3 class="text-xs font-bold tracking-widest text-stone-400 uppercase mb-4">
                                Media Sosial Resmi
                            </h3>
                            <div class="flex gap-5">
                                <a href="https://www.instagram.com/masjidalkautsarcmplrjo/" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-10 h-10 rounded-xl border border-stone-200 bg-white flex justify-center items-center text-stone-600 hover:border-primary hover:text-primary hover:shadow-sm transition-all duration-300 hover:-translate-y-0.5">
                                    <iconify-icon icon="mdi:instagram" class="text-xl"></iconify-icon>
                                </a>
                                <a href="https://www.youtube.com/@MasjidAlkautsarCempolorejo" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-10 h-10 rounded-xl border border-stone-200 bg-white flex justify-center items-center text-stone-600 hover:border-primary hover:text-primary hover:shadow-sm transition-all duration-300 hover:-translate-y-0.5">
                                    <iconify-icon icon="mdi:youtube" class="text-xl"></iconify-icon>
                                </a>
                                <a href="https://www.tiktok.com/@masjidalkautsarcmplrjo" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-10 h-10 rounded-xl border border-stone-200 bg-white flex justify-center items-center text-stone-600 hover:border-primary hover:text-primary hover:shadow-sm transition-all duration-300 hover:-translate-y-0.5">
                                    <iconify-icon icon="akar-icons:tiktok-fill" class="text-lg"></iconify-icon>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Message Form --}}
                <div class="lg:col-span-2">
                    <div
                        class="bg-white rounded-3xl border border-stone-200/60 shadow-xl shadow-stone-100/50 overflow-hidden relative">
                        {{-- Top Accent Bar --}}
                        <div class="h-1.5 bg-linear-to-r from-primary via-primary/80 to-tertiary"></div>

                        <div class="p-6 sm:p-10 md:p-12">
                            <h2 class="text-secondary text-2xl md:text-3xl font-bold tracking-tight mb-2">Kirim Pesan</h2>
                            <p class="text-stone-500 text-sm md:text-base leading-relaxed font-light mb-8">
                                Silakan isi formulir di bawah ini, tim admin kami akan merespons pesan Anda
                                secepatnya.
                            </p>

                            <form action="{{ route('contact.store') }}" method="post" class="space-y-5">
                                @csrf

                                {{-- Row 1: Name & Email --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {{-- Name input --}}
                                    <div class="space-y-2">
                                        <label for="name"
                                            class="block text-xs font-bold text-stone-700 tracking-wider uppercase">
                                            Nama Lengkap
                                        </label>
                                        <input type="text" name="name" id="name" placeholder="Masukkan nama Anda" required
                                            class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-stone-800 placeholder-stone-400 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none">
                                    </div>

                                    {{-- Email input --}}
                                    <div class="space-y-2">
                                        <label for="email"
                                            class="block text-xs font-bold text-stone-700 tracking-wider uppercase">
                                            Alamat Email
                                        </label>
                                        <input type="email" name="email" id="email" placeholder="contoh@email.com" required
                                            class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-stone-800 placeholder-stone-400 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none">
                                    </div>
                                </div>

                                {{-- Row 2: Phone & Subject --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {{-- Phone input --}}
                                    <div class="space-y-2">
                                        <label for="phone_number"
                                            class="block text-xs font-bold text-stone-700 tracking-wider uppercase">
                                            Nomor Telepon / WA
                                        </label>
                                        <input type="tel" name="phone_number" id="phone_number" pattern="[0-9]{10,14}"
                                            required placeholder="Contoh: 08123456789"
                                            class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-stone-800 placeholder-stone-400 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none">
                                    </div>

                                    {{-- Subject input --}}
                                    <div class="space-y-2">
                                        <label for="subject"
                                            class="block text-xs font-bold text-stone-700 tracking-wider uppercase">
                                            Subjek Pesan
                                        </label>
                                        <div class="relative">
                                            <select name="subject" id="subject" required
                                                class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-stone-800 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none appearance-none cursor-pointer">
                                                <option value="" disabled selected class="text-stone-400">Pilih Subjek
                                                </option>
                                                <option value="saran">Saran & Kritik</option>
                                                <option value="keluhan">Keluhan Layanan</option>
                                                <option value="pertanyaan">Pertanyaan Umum</option>
                                                <option value="lainnya">Lainnya</option>
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-stone-500">
                                                <iconify-icon icon="tabler:chevron-down"></iconify-icon>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Row 3: Description --}}
                                <div class="space-y-2">
                                    <label for="description"
                                        class="block text-xs font-bold text-stone-700 tracking-wider uppercase">
                                        Isi Pesan Anda
                                    </label>
                                    <textarea name="description" id="description" rows="5" required
                                        placeholder="Tuliskan detail pesan, saran, atau pertanyaan Anda di sini..."
                                        class="w-full bg-stone-50 border border-stone-200 rounded-xl px-4 py-3 text-stone-800 placeholder-stone-400 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all duration-200 outline-none resize-none"></textarea>
                                </div>

                                {{-- Submit Button --}}
                                <div class="pt-2">
                                    <button type="submit"
                                        class="w-full sm:w-auto bg-primary hover:bg-tertiary active:scale-[0.98] transition-all duration-300 text-white px-8 py-3.5 rounded-xl font-semibold flex items-center justify-center gap-2.5 shadow-md shadow-primary/10">
                                        <iconify-icon icon="mdi:send-outline" class="text-xl"></iconify-icon>
                                        <span>Kirim Pesan Sekarang</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Location Map Section --}}
    <section class="w-full relative border-t border-stone-200">
        <div class="w-full h-[350px] sm:h-[450px] lg:h-[520px] bg-stone-100 overflow-hidden">
            <iframe
                src="https://maps.google.com/maps?q=Masjid%20Al-Kautsar%20Cempolorejo%20Krobokan%20Semarang&t=h&z=18&ie=UTF8&iwloc=&output=embed"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" class="w-full h-full grayscale-15 contrast-110 tracking-normal">
            </iframe>
        </div>
    </section>

@endsection