<header class="bg-neutral shadow-md fixed top-0 left-0 right-0 z-[1000]">

    <div class="container mx-auto flex justify-between items-center py-4 px-8 lg:px-[30px] xl:px-[60px]">

        {{-- Logo --}}
        <div class="flex gap-4 items-center">

            <img src="{{ asset('images/logo-alkautsar.png') }}" alt="Logo" class="w-10 lg:w-12">

            <p class="hidden sm:block font-bold text-base sm:text-lg xl:text-xl leading-tight ">
                <span class="text-secondary">Masjid</span>
                <span class="text-primary">Al Kautsar Cempolorejo</span>
            </p>

        </div>

        {{-- Desktop Navbar --}}
        <nav class="hidden lg:block">

            <ul class="flex gap-6 list-none items-center text-sm xl:text-base">

                {{-- Home --}}
                <li>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary' : 'text-secondary' }}
                        font-semibold hover:text-primary transition">
                        Beranda
                    </a>
                </li>

                {{-- Profile --}}
                <li>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-primary' : 'text-secondary' }} 
                        font-semibold hover:text-primary transition">
                        Profil
                    </a>
                </li>

                {{-- Unit Usaha Dropdown --}}
                <li class="relative group">

                    <button
                        class="flex items-center gap-1 text-secondary lg:font-semibold hover:text-primary transition">

                        Unit Usaha Masjid

                        <iconify-icon icon="mdi:chevron-down"></iconify-icon>
                    </button>

                    {{-- Dropdown --}}
                    <div class="absolute top-full left-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-stone-200
                        opacity-0 invisible translate-y-2 scale-95
                        group-hover:opacity-100
                        group-hover:visible
                        group-hover:translate-y-0
                        group-hover:scale-100
                        transition-all duration-300 ease-out
                        z-50 overflow-hidden">

                        <a href=" {{ route('water-refill') }} " class=" {{ request()->routeIs('water-refill') ? 'text-primary' : 'text-secondary' }} 
                                block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Air Isi Ulang - ALKA
                        </a>

                        <a href=" {{ route('hajj') }} " class=" {{ request()->routeIs('hajj') ? 'text-primary' : 'text-secondary' }} 
                                block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Biro Haji & Umroh
                        </a>

                    </div>

                </li>

                {{-- Program Dropdown --}}
                <li class="relative group">

                    <button class="flex items-center gap-1 text-secondary font-semibold hover:text-primary transition">

                        Program

                        <iconify-icon icon="mdi:chevron-down"></iconify-icon>
                    </button>

                    {{-- Dropdown --}}
                    <div class="absolute top-full left-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-stone-200
                        opacity-0 invisible translate-y-2 scale-95
                        group-hover:opacity-100
                        group-hover:visible
                        group-hover:translate-y-0
                        group-hover:scale-100
                        transition-all duration-300 ease-out
                        z-50 overflow-hidden">

                        <a href=" {{ route('kajian') }} " class=" {{ request()->routeIs('kajian') ? 'text-primary' : 'text-secondary' }} 
                                block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Informasi Kajian Islam
                        </a>

                        <a href=" {{ route('zakat') }} " class=" {{ request()->routeIs('zakat') ? 'text-primary' : 'text-secondary' }} 
                                block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Zakat, Infaq & Sedekah
                        </a>

                        <a href=" {{ route('itikaf') }} " class=" {{ request()->routeIs('itikaf') ? 'text-primary' : 'text-secondary' }} 
                                block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            I'tikaf Ramadan
                        </a>

                        {{-- <a href="#" class="block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            I'tikaf Ramadan
                        </a> --}}

                    </div>

                </li>

                {{-- Laporan --}}
                <li>
                    <a href="#" class="text-secondary font-semibold hover:text-primary transition">
                        Laporan Keuangan
                    </a>
                </li>

                {{-- Kontak --}}
                <li>
                    <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.index') ? 'text-primary' : 'text-secondary' }}
                        font-semibold hover:text-primary transition">
                        Kontak
                    </a>
                </li>

            </ul>

        </nav>

        {{-- Mobile Button --}}
        <button id="mobile-menu-button" class="lg:hidden text-secondary text-3xl flex items-center">

            <iconify-icon icon="mdi:menu" class="transition-transform duration-300"></iconify-icon>

        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu"
        class="lg:hidden bg-white border-t border-stone-200 shadow-md max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out">

        <div class="px-6 py-4 space-y-3">

            {{-- Home --}}
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-secondary' }}
                flex items-center gap-3 py-2.5 px-4 rounded-xl font-semibold text-sm
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">
                <iconify-icon icon="lucide:home" class="text-lg"></iconify-icon>
                <span>Beranda</span>
            </a>

            {{-- Profile --}}
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-primary bg-primary/10' : 'text-secondary' }}
                flex items-center gap-3 py-2.5 px-4 rounded-xl font-semibold text-sm
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">
                <iconify-icon icon="lucide:user" class="text-lg"></iconify-icon>
                <span>Profil</span>
            </a>

            {{-- Unit Usaha Dropdown --}}
            <div>

                <button id="unit-usaha-button" class="w-full flex justify-between items-center py-2.5 px-4 rounded-xl font-semibold text-secondary
                    hover:bg-primary/10 hover:text-primary text-sm
                    transition-all duration-200">

                    <div class="flex items-center gap-3">
                        <iconify-icon icon="lucide:store" class="text-lg"></iconify-icon>
                        <span>Unit Usaha Masjid</span>
                    </div>

                    <iconify-icon id="unit-usaha-icon" icon="mdi:chevron-down"
                        class="transition-transform duration-300"></iconify-icon>

                </button>

                <div id="unit-usaha-menu"
                    class="max-h-0 opacity-0 overflow-hidden border-l-2 border-slate-100 ml-7 pl-3 space-y-1 transition-all duration-300 ease-out">

                    <a href="{{ route('water-refill') }}" class=" {{ request()->routeIs('water-refill') ? 'text-primary bg-primary/10' : 'text-stone-600' }} 
                        flex items-center gap-2.5 py-2 px-3 rounded-lg font-medium text-sm
                        hover:bg-primary/5 hover:text-primary hover:translate-x-1
                        active:scale-[0.98]
                        transition-all duration-200">
                        <iconify-icon icon="line-md:water-twotone" class="text-base"></iconify-icon>
                        <span>Air Isi Ulang - ALKA</span>
                    </a>

                    <a href="{{ route('hajj') }}" class=" {{ request()->routeIs('hajj') ? 'text-primary bg-primary/10' : 'text-stone-600' }} 
                        flex items-center gap-2.5 py-2 px-3 rounded-lg font-medium text-sm
                        hover:bg-primary/5 hover:text-primary hover:translate-x-1
                        active:scale-[0.98]
                        transition-all duration-200">
                        <iconify-icon icon="hugeicons:haji" class="text-base"></iconify-icon>
                        <span>Biro Haji & Umroh</span>
                    </a>

                </div>

            </div>

            {{-- Program Dropdown --}}
            <div>

                <button id="program-button" class="w-full flex justify-between 
                    items-center py-2.5 px-4 rounded-xl font-semibold text-secondary text-sm
                    hover:bg-primary/10 hover:text-primary
                    transition-all duration-200">

                    <div class="flex items-center gap-3">
                        <iconify-icon icon="lucide:calendar" class="text-lg"></iconify-icon>
                        <span>Program</span>
                    </div>

                    <iconify-icon icon="mdi:chevron-down" id="program-icon"
                        class="transition-transform duration-300"></iconify-icon>

                </button>

                <div id="program-menu"
                    class="max-h-0 opacity-0 overflow-hidden border-l-2 border-slate-100 ml-7 pl-3 space-y-1 transition-all duration-300 ease-out">

                    <a href="{{ route('kajian') }}" class=" {{ request()->routeIs('kajian') ? 'text-primary bg-primary/10' : 'text-stone-600' }} 
                        flex items-center gap-2.5 py-2 px-3 rounded-lg font-medium text-sm
                        hover:bg-primary/5 hover:text-primary hover:translate-x-1
                        active:scale-[0.98]
                        transition-all duration-200">
                        <iconify-icon icon="line-md:water-twotone" class="text-base"></iconify-icon>
                        <span>Informasi Kajian Islam</span>
                    </a>

                    <a href="{{ route('zakat') }}" class=" {{ request()->routeIs('zakat') ? 'text-primary bg-primary/10' : 'text-stone-600' }} 
                        flex items-center gap-2.5 py-2 px-3 rounded-lg font-medium text-sm
                        hover:bg-primary/5 hover:text-primary hover:translate-x-1
                        active:scale-[0.98]
                        transition-all duration-200">
                        <iconify-icon icon="fa6-solid:sack-dollar" class="text-base"></iconify-icon>
                        <span>Zakat, Infaq & Sedekah</span>
                    </a>

                    <a href="{{ route('itikaf') }}" class=" {{ request()->routeIs('itikaf') ? 'text-primary bg-primary/10' : 'text-stone-600' }} 
                        flex items-center gap-2.5 py-2 px-3 rounded-lg font-medium text-sm
                        hover:bg-primary/5 hover:text-primary hover:translate-x-1
                        active:scale-[0.98]
                        transition-all duration-200">
                        <iconify-icon icon="fa6-solid:moon" class="text-base"></iconify-icon>
                        <span>I'tikaf Ramadan</span>
                    </a>

                    {{-- <a href="#" class="flex items-center gap-2.5 py-2 px-3 rounded-lg font-medium text-xs md:text-sm text-stone-600
                        hover:bg-primary/5 hover:text-primary hover:translate-x-1
                        active:scale-[0.98]
                        transition-all duration-200">
                        <iconify-icon icon="lucide:corner-down-right" class="text-xs opacity-60"></iconify-icon>
                        <span>I'tikaf Ramadan</span>
                    </a> --}}

                </div>

            </div>

            {{-- Laporan --}}
            <a href="#" class="flex items-center gap-3 py-2.5 px-4 rounded-xl font-semibold text-secondary text-sm
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">
                <iconify-icon icon="lucide:file-text" class="text-lg"></iconify-icon>
                <span>Laporan Keuangan</span>
            </a>

            {{-- Kontak --}}
            <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.index') ? 'text-primary bg-primary/10' : 'text-secondary' }}
                flex items-center gap-3 py-2.5 px-4 rounded-xl font-semibold text-sm
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">
                <iconify-icon icon="lucide:phone" class="text-lg"></iconify-icon>
                <span>Kontak</span>
            </a>

        </div>

    </div>

</header>