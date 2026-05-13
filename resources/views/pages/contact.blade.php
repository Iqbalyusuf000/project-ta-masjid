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
    <section class="sm:pt-1 pb-1 md:pt-2 pb-2 lg:pt-2 py-2">
        <div class="container mx-auto px-10">
            @include('components.prayer-time')
        </div>
    </section>

    {{-- Hero Contact --}}
    <section class="relative bg-tertiary py-20 overflow-hidden">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/20"></div>

        <div class="relative container mx-auto px-6 text-center text-white">

            <h1 class="text-5xl font-bold mb-6 font-raleway">
                Hubungi Kami
            </h1>

            <p class="max-w-3xl mx-auto text-base leading-8 text-stone-200">
                Masjid Al Kautsar berkomitmen untuk selalu hadir bagi jamaah dan masyarakat.
                Kami membuka pintu selebar-lebarnya untuk pertanyaan, masukan, maupun koordinasi
                kegiatan keumatan.
            </p>

        </div>
    </section>

    {{-- Contact Content --}}
    <section class="bg-neutral py-20">
        <div class="container mx-auto px-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- left --}}
                <div class="lg:col-span-1">

                    {{-- Title --}}
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-1 h-8 bg-primary rounded-full"></div>

                        <h2 class="text-3xl font-bold text-secondary">
                            Informasi Kontak
                        </h2>
                    </div>

                    {{-- Card --}}
                    <div class="space-y-5">

                        {{-- Address --}}
                        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-xl bg-primary/15 flex justify-center items-center text-primary shrink-0">
                                    <iconify-icon icon="mdi:map-marker-outline" class="text-2xl"></iconify-icon>
                                </div>

                                <div>
                                    <h3 class="font-bold text-secondary mb-1">
                                        Alamat
                                    </h3>

                                    <p class="text-sm text-stone-600 leading-6">
                                        {{ $info->address }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">

                            <div class="flex gap-4 items-center">

                                <div
                                    class="w-12 h-12 rounded-xl bg-primary/15 flex justify-center items-center text-primary shrink-0">
                                    <iconify-icon icon="mdi:phone-outline" class="text-2xl"></iconify-icon>
                                </div>

                                <div>
                                    <h3 class="font-bold text-secondary mb-1">
                                        Telepon
                                    </h3>

                                    <p class="text-sm text-stone-600">
                                        {{ $info->phone_number }}
                                    </p>
                                </div>

                            </div>

                        </div>

                        {{-- Email --}}
                        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-sm">

                            <div class="flex gap-4 items-center">

                                <div
                                    class="w-12 h-12 rounded-xl bg-primary/15 flex justify-center items-center text-primary shrink-0">
                                    <iconify-icon icon="mdi:email-outline" class="text-2xl"></iconify-icon>
                                </div>

                                <div>
                                    <h3 class="font-bold text-secondary mb-1">
                                        Email
                                    </h3>

                                    <p class="text-sm text-stone-600">
                                        {{ $info->email }}
                                    </p>
                                </div>

                            </div>

                        </div>

                        {{-- WhatsApp Button --}}
                        <a href="https://wa.me/+6282329621484" target="_blank" rel="noopener noreferrer"
                            class="mt-8 w-full bg-green-500 hover:bg-green-600 active:scale-[0.98] transition-all text-white py-4 rounded-xl flex justify-center items-center gap-3 font-semibold shadow-md shadow-green-200">

                            <!-- Iconify Icon -->
                            <iconify-icon icon="mdi:whatsapp" class="text-2xl"></iconify-icon>

                            <span>Hubungi Via WhatsApp</span>
                        </a>

                        {{-- Social Media --}}
                        <div class="mt-10 flex flex-col items-center">

                            <h3 class="text-sm font-bold tracking-widest text-stone-400 uppercase mb-5">
                                Media Sosial
                            </h3>

                            <div class="flex gap-8">

                                <a href="https://www.instagram.com/masjidalkautsarcmplrjo/" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-11 h-11 rounded-xl border border-primary/30 flex justify-center items-center text-primary hover:bg-primary hover:text-white transition-all">

                                    <iconify-icon icon="mdi:instagram" class="text-xl"></iconify-icon>
                                </a>

                                <a href="https://www.youtube.com/@MasjidAlkautsarCempolorejo" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-11 h-11 rounded-xl border border-primary/30 flex justify-center items-center text-primary hover:bg-primary hover:text-white transition-all">

                                    <iconify-icon icon="mdi:youtube" class="text-xl"></iconify-icon>
                                </a>

                                <a href="https://www.tiktok.com/@masjidalkautsarcmplrjo" target="_blank"
                                    rel="noopener noreferrer"
                                    class="w-11 h-11 rounded-xl border border-primary/30 flex justify-center items-center text-primary hover:bg-primary hover:text-white transition-all">

                                    <iconify-icon icon="akar-icons:tiktok-fill" class="text-xl"></iconify-icon>
                                </a>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- Right --}}
                <div class="lg:col-span-2 ">

                    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">

                        {{-- Top Border --}}
                        <div class="h-2 bg-primary"></div>

                        <div class="p-10 shadow-2xl">

                            <h2 class="text-secondary text-3xl font-bold mb-2">Kirim Pesan</h2>

                            <p class="text-stone-500 leading-7 mb-8">Silakan isi formulir di bawah ini, tim admin kami akan
                                merespons pesan
                                Anda segera.</p>

                            <!-- @if (session('success'))
                                                                                                                                                                                                                        <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl">
                                                                                                                                                                                                                            {{ session('success') }}
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                    @endif -->

                            <form action="{{ route('contact.store') }}" method="post">

                                @csrf

                                {{-- row 1 --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 ">

                                    {{-- Name --}}
                                    <div>

                                        <label for="name"
                                            class="block text-sm font-semibold text-stone-600 mb-2 tracking-widest">
                                            Nama Lengkap
                                        </label>

                                        <input type="text" name="name" id="name" placeholder="Masukkan Nama Anda"
                                            required="required"
                                            class="w-full border border-stone-200 rounded-xl px-4 py-2 outline-none focus:border-primary mb-6">

                                    </div>

                                    {{-- Email --}}
                                    <div>

                                        <label for="email"
                                            class="block text-sm font-semibold text-stone-600 mb-2 tracking-widest">
                                            Alamat Email
                                        </label>

                                        <input type="email" name="email" id="email" placeholder="Masukkan Email Anda"
                                            required="required"
                                            class="w-full border border-stone-200 rounded-xl px-4 py-2 outline-none focus:border-primary mb-6">

                                    </div>

                                </div>

                                {{-- row 2 --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    {{-- Nomor Telp --}}
                                    <div>

                                        <label for="phone_number"
                                            class="block text-sm font-semibold text-stone-600 mb-2 tracking-widest">
                                            Nomor Telepon
                                        </label>

                                        <input type="tel" name="phone_number" id="phone_number" pattern="[0-9]{10,13}"
                                            required placeholder="Masukkan Nomor Telepon Anda"
                                            class="w-full border border-stone-200 rounded-xl px-4 py-2 outline-none focus:border-primary mb-6">

                                    </div>

                                    {{-- Subjek --}}
                                    <div>

                                        <label for="subject"
                                            class="block text-sm font-semibold text-stone-600 mb-2 tracking-widest">
                                            Subjek
                                        </label>

                                        <select name="subject" id="subject" required="required"
                                            class="w-full border border-stone-200 rounded-xl px-4 py-2 outline-none focus:border-primary mb-6">
                                            <option value="">Pilih Subjek</option>
                                            <option value="saran">Saran</option>
                                            <option value="keluhan">Keluhan</option>
                                            <option value="pertanyaan">Pertanyaan</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>

                                    </div>

                                </div>

                                {{-- row 3 --}}
                                {{-- Description --}}
                                <div>

                                    <label for="description"
                                        class="block text-sm font-semibold text-stone-600 mb-2 tracking-widest">
                                        Pesan Anda
                                    </label>

                                    <textarea name="description" id="description" rows="6" required="required"
                                        placeholder="Tuliskan detail pesan Anda di sini..."
                                        class="w-full border border-stone-200 rounded-xl px-4 py-2 outline-none focus:border-primary mb-6"></textarea>

                                </div>

                                {{-- button --}}
                                <button type="submit"
                                    class="bg-primary hover:bg-tertiary transition-all text-white px-8 py-4 rounded-xl font-semibold flex items-center gap-3 shadow-sm">

                                    <iconify-icon icon="mdi:send-outline" class="text-xl"></iconify-icon>

                                    Kirim Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- LOCATION SECTION --}}
    <section class="relative">

        <div class="bg-white overflow-hidden shadow-sm border border-stone-200">

            <div class="h-[300px] sm:h-[400px] lg:h-[500px]">

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2524127362867!2d110.39327027451989!3d-6.97951479302131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b33808fa249%3A0x80e777853de7417!2sMasjid%20Al-Kautsar!5e0!3m2!1sen!2sid!4v1778660184157!5m2!1sen!2sid"
                    width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>

        </div>
    </section>

@endsection