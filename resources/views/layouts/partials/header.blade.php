<header class="bg-neutral shadow-md fixed top-0 left-0 right-0 z-[1000]">

    <div class="container mx-auto flex justify-between items-center py-4 px-8 lg:px-[30px] xl:px-[60px]">

        {{-- Logo --}}
        <div class="flex gap-4 items-center">

            <img src="{{ asset('images/logo-alkautsar.png') }}" alt="Logo" class="w-10 lg:w-12">

            <p class="font-bold text-base sm:text-lg xl:text-xl leading-tight">
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
                        Home
                    </a>
                </li>

                {{-- Profile --}}
                <li>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-primary' : 'text-secondary' }} 
                        font-semibold hover:text-primary transition">
                        Profile
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

                        <a href="#" class="block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Air Minum ALKA Tirta
                        </a>

                        <a href="#" class="block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Umroh dan Haji ALKA
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

                        <a href="#" class="block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Kajian Umum
                        </a>

                        <a href="#" class="block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            Zakat, Infaq dan Sedekah
                        </a>

                        <a href="#" class="block px-5 py-3 hover:bg-primary/10 hover:text-primary transition">
                            I'tikaf Ramadan
                        </a>

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

            <iconify-icon icon="mdi:menu"></iconify-icon>

        </button>

    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-stone-200 shadow-md">

        <div class="px-6 py-5 space-y-2">

            {{-- Home --}}
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-secondary' }}
                block py-3 px-4 rounded-xl font-semibold
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">

                Home
            </a>

            {{-- Profile --}}
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'text-primary bg-primary/10' : 'text-secondary' }}
                block py-3 px-4 rounded-xl font-semibold
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">

                Profile
            </a>

            {{-- Unit Usaha Dropdown --}}
            <div>

                <button id="unit-usaha-button" class="w-full flex justify-between items-center py-3 px-4 rounded-xl font-semibold text-secondary
                    hover:bg-primary/10 hover:text-primary
                    transition-all duration-200">

                    <span>Unit Usaha Masjid</span>

                    <iconify-icon icon="mdi:chevron-down"></iconify-icon>

                </button>

                <div id="unit-usaha-menu"
                    class="max-h-0 opacity-0 overflow-hidden pl-4 mt-2 space-y-2 transition-all duration-300 ease-out">

                    <a href="#" class="block py-2 text-stone-600 hover:text-primary transition">
                        Air Minum ALKA Tirta
                    </a>

                    <a href="#" class="block py-2 text-stone-600 hover:text-primary transition">
                        Umroh dan Haji ALKA
                    </a>

                </div>

            </div>

            {{-- Program Dropdown --}}
            <div>

                <button id="program-button" class="w-full flex justify-between items-center py-3 px-4 rounded-xl font-semibold text-secondary
                    hover:bg-primary/10 hover:text-primary
                    transition-all duration-200">

                    <span>Program</span>

                    <iconify-icon icon="mdi:chevron-down"></iconify-icon>

                </button>

                <div id="program-menu"
                    class="max-h-0 opacity-0 overflow-hidden pl-4 mt-2 space-y-2 transition-all duration-300 ease-out">

                    <a href="#" class="block py-2 text-stone-600 hover:text-primary transition">
                        Kajian Umum
                    </a>

                    <a href="#" class="block py-2 text-stone-600 hover:text-primary transition">
                        Zakat, Infaq dan Sedekah
                    </a>

                    <a href="#" class="block py-2 text-stone-600 hover:text-primary transition">
                        I'tikaf Ramadan
                    </a>

                </div>

            </div>

            {{-- Laporan --}}
            <a href="#" class="block py-3 px-4 rounded-xl font-semibold text-secondary
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">

                Laporan Keuangan
            </a>

            {{-- Kontak --}}
            <a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.index') ? 'text-primary bg-primary/10' : 'text-secondary' }}
                block py-3 px-4 rounded-xl font-semibold
                hover:bg-primary/10 hover:text-primary
                active:scale-[0.98]
                transition-all duration-200">

                Kontak
            </a>

        </div>

    </div>

</header>