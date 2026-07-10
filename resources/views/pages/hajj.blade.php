@extends('layouts.app')

@section('title', 'Haji & Umroh ALKA | Masjid Al-Kautsar Cempolorejo')

@section('content')

    <section
        class="relative w-full min-h-[70vh] md:min-h-[90vh] bg-gray-900 overflow-hidden flex items-center justify-center">

        <div class="absolute inset-0 z-0" data-aos="fade-up">
            <img src="{{ asset('images/kakbah2.webp') }}" alt="Kaaba Background"
                class="w-full h-full object-cover object-center scale-105 filter blur-[1px] md:blur-0 transform group-hover:scale-100 transition-transform duration-700">
            <div class="bg-linear-to-b from-black/25 via-black/35 to-black/25 absolute inset-0"></div>

        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-16 md:py-24 text-center">

            <div
                class="inline-block bg-primary text-neutral px-5 py-2.5 rounded-full mb-8 shadow-xl transform transition-transform hover:scale-105">
                <span class="text-xs md:text-sm font-semibold tracking-wider uppercase">
                    BIRO UMROH & HAJI AL KAUTSAR
                </span>
            </div>

            <h1
                class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight text-shadow-md tracking-tight">
                Perjalanan Suci Penuh Makna
            </h1>

            <p
                class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-12 font-light leading-relaxed px-4 text-shadow-sm">
                Wujudkan niat suci Anda ke Baitullah dengan bimbingan sesuai Sunnah dan pelayanan profesional yang amanah.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 sm:gap-8 px-4">

                <a href="#"
                    class="group w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 border border-transparent capitalize text-base md:text-lg font-semibold rounded-full text-black bg-primary hover:bg-white transition-all duration-300 shadow-lg hover:shadow-2xl">
                    <span>segera hadir</span>
                    {{-- <svg class="ml-3 -mr-1 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                        </path>
                    </svg> --}}
                </a>

                {{-- <a href="#"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 border-2 border-gold-primary text-base md:text-lg font-medium rounded-full text-neutral hover:text-primary hover:bg-gold-primary transition-all duration-300 shadow-md hover:shadow-xl">
                    <span>{{ __('Konsultasi Gratis') }}</span>
                    <svg class="ml-3 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                        </path>
                    </svg>
                </a> --}}

            </div>

            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/50 hidden md:block">
                <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
            </div>
        </div>
    </section>

@endsection