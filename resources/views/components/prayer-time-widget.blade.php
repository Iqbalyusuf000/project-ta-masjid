<div id="prayer-widget"
    class="flex flex-col lg:flex-row lg:items-center w-full bg-secondary rounded-xl border border-stone-200 shadow-sm px-4 sm:px-6 py-4 gap-4 lg:gap-0">

    {{-- Icon + Waktu Saat Ini (Jam & Tanggal) --}}
    <div class="flex items-center justify-center gap-3 min-w-0 lg:min-w-[200px] shrink-0">
        <div
            class="w-10 h-10 sm:w-11 sm:h-11 bg-primary rounded-xl flex items-center justify-center text-white shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
            </svg>
        </div>

        <div class="flex flex-col gap-0.5 text-left">
            <span class="text-[9px] sm:text-[10px] font-bold text-stone-400 tracking-widest uppercase font-lato">
                Waktu Saat Ini
            </span>
            {{-- Jam Berjalan Real-time via JavaScript --}}
            <span id="widget-live-clock"
                class="text-base sm:text-lg font-bold text-white tracking-wide font-lato leading-none">
                --:-- WIB
            </span>
        </div>
    </div>

    {{-- Divider Desktop & Mobile --}}
    <div class="hidden lg:block w-px h-12 bg-stone-200 mx-6 shrink-0"></div>
    <div class="block lg:hidden w-full h-px bg-stone-200"></div>

    {{-- Jadwal Sholat --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:flex items-center flex-1 gap-3 lg:gap-0">
        @foreach(['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'] as $waktu)

            <div data-waktu="{{ $waktu }}"
                class="prayer-item relative flex flex-col items-center justify-center gap-1 flex-1 px-3 py-3 rounded-lg transition-all duration-200 bg-white/5 lg:bg-transparent">

                @if (!$loop->first)
                    <div class="hidden lg:block absolute left-0 top-1/2 -translate-y-1/2 h-7 w-px bg-stone-200/20"></div>
                @endif

                <span
                    class="prayer-label text-[10px] sm:text-[11px] font-semibold text-stone-400 capitalize font-lato tracking-wide">
                    {{ ucfirst($waktu) }}
                </span>

                <span class="prayer-time text-base sm:text-lg font-bold text-white font-lato tracking-wide">
                    {{ $jadwalHariIni[$waktu] ?? '--:--' }}
                </span>
            </div>

        @endforeach
    </div>

    <script>
        (function () {
            const clockEl = document.getElementById('widget-live-clock');
            if (!clockEl) return;

            function updateClock() {
                const now = new Date();
                const hh = String(now.getHours()).padStart(2, '0');
                const mm = String(now.getMinutes()).padStart(2, '0');
                const clockEl = document.getElementById('widget-live-clock');
                if (clockEl) clockEl.textContent = `${hh}:${mm} WIB`;
            }
            updateClock();
            setInterval(updateClock, 1000);
        })();
    </script>
</div>