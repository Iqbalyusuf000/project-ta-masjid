{{-- FOOTER --}}
<footer class="bg-secondary/90 text-white pt-16 pb-4">

    <div class="container mx-auto px-15">

        {{-- Grid Footer --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12">

            {{-- Column 1 --}}
            <div class="lg:col-span-5">

                <div class="flex items-center gap-3 mb-6">
                    {{--
                    <iconify-icon icon="mdi:bookmark" class="text-primary text-3xl">
                    </iconify-icon> --}}
                    <img src="{{ asset('images/logo-alkautsar.png') }}" alt="Logo" class="w-10 lg:w-12">

                    <h3 class="font-raleway text-2xl font-bold text-primary hover:text-neutral transition-all">
                        Masjid Al Kautsar Cempolorejo
                    </h3>

                </div>

                <div class="space-y-4 text-stone-300 leading-7">

                    <p>
                        Jl. Cempolorejo V No.21, Krobokan, Kec. Semarang Barat,
                        <span class="block">Kota Semarang, Jawa Tengah 50141</span>
                    </p>

                    <p>
                        Email:
                        info@masjid-alkautsar.id
                    </p>

                    <p>
                        Telp:
                        +62 823-2962-1484
                    </p>

                </div>

            </div>

            {{-- Column 2 --}}
            <div class="lg:col-span-2">

                <h3 class="text-primary text-xl font-semibold mb-6">
                    Navigasi
                </h3>

                <ul class="space-y-4 text-stone-300">

                    <li>
                        <a href="{{ route('home') }}" class="hover:text-primary transition-all">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('profile') }}" class="hover:text-primary transition-all">
                            Profil
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-primary transition-all">
                            Laporan Keuangan
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact.index') }}" class="hover:text-primary transition-all">
                            Kontak
                        </a>
                    </li>

                </ul>

            </div>

            {{-- Column 3 --}}
            <div class="lg:col-span-2">

                <h3 class="text-primary text-xl font-semibold mb-6">
                    Layanan Jamaah
                </h3>

                <ul class="space-y-4 text-stone-300">

                    <li>Kajian Umum</li>
                    <li>Zakat Infaq dan Sedekah</li>
                    <li>I'tikaf Ramadhan</li>

                </ul>

            </div>

            {{-- Column 4 --}}
            <div class="lg:col-span-3">

                <h3 class="text-primary text-xl font-semibold mb-6">
                    Unit Usaha Masjid
                </h3>

                <ul class="space-y-4 text-stone-300">

                    <li>
                        <a href="{{ route('water-refill') }}" class="hover:text-primary transition-all">
                            Isi Ulang Air Mineral Alka
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('hajj') }}" class="hover:text-primary transition-all">
                            Biro Haji dan Umroh
                        </a>
                    </li>

                </ul>

            </div>

        </div>

        {{-- Divider --}}
        <div class="border-t border-white/10 mt-4 pt-4">

            <div class="flex flex-col md:flex-row justify-between items-center gap-5 text-sm text-stone-400">

                <p class="">
                    © 2026 Masjid Al Kautsar Development Team.
                </p>

                <div class="flex gap-6">

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

                    <a href="https://www.tiktok.com/@masjidalkautsarcmplrjo" target="_blank" rel="noopener noreferrer"
                        class="w-11 h-11 rounded-xl border border-primary/30 flex justify-center items-center text-primary hover:bg-primary hover:text-white transition-all">

                        <iconify-icon icon="akar-icons:tiktok-fill" class="text-xl"></iconify-icon>
                    </a>

                </div>

            </div>

        </div>

    </div>

</footer>