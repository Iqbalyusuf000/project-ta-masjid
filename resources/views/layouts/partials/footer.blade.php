{{-- FOOTER --}}
<footer class="bg-secondary/90 text-white pt-16 pb-4">

    <div class="container mx-auto px-10">

        {{-- Grid Footer --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- Column 1 --}}
            <div>

                <div class="flex items-center gap-3 mb-6">

                    <iconify-icon icon="mdi:bookmark" class="text-primary text-3xl">
                    </iconify-icon>

                    <h3 class="text-xl font-bold">
                        Masjid Al Kautsar Cempolorejo
                    </h3>

                </div>

                <p class="text-stone-300 leading-8">
                    Menjadi pusat peradaban umat yang unggul,
                    profesional, dan berlandaskan nilai-nilai
                    Al-Qur'an dan Sunnah.
                </p>

            </div>

            {{-- Column 2 --}}
            <div>

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
                        <a href="#" class="hover:text-primary transition-all">
                            Unit Usaha Masjid
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-primary transition-all">
                            Program & Kegiatan
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-primary transition-all">
                            Laporan Keuangan
                        </a>
                    </li>

                </ul>

            </div>

            {{-- Column 3 --}}
            <div>

                <h3 class="text-primary text-xl font-semibold mb-6">
                    Layanan Jamaah
                </h3>

                <ul class="space-y-4 text-stone-300">

                    <li>Kajian Umum</li>
                    <li>Air Mineral Alka</li>
                    <li>Bakti Sosial</li>
                    <li>Zakat & Infaq</li>

                </ul>

            </div>

            {{-- Column 4 --}}
            <div>

                <h3 class="text-primary text-xl font-semibold mb-6">
                    Sekretariat
                </h3>

                <div class="space-y-4 text-stone-300 leading-7">

                    <p>
                        Jl. Cempolorejo V No.21, Krobokan, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50141
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

        </div>

        {{-- Divider --}}
        <div class="border-t border-white/10 mt-4 pt-4">

            <div class="flex flex-col md:flex-row justify-between items-center gap-5 text-sm text-stone-400">

                <p class="">
                    © 2024 Masjid Al Kautsar.
                    Seluruh Hak Cipta Dilindungi.
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