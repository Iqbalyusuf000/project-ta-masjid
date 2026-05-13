document.addEventListener('DOMContentLoaded', function () {
    const CITY_ID = '1433'; // Kota Semarang
    const PRAYER_ORDER = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];

    // ── Skeleton shimmer ──────────────────────────────────────
    document.querySelectorAll('.prayer-time').forEach(el => {
        el.classList.add('animate-pulse', 'bg-stone-200', 'rounded', 'text-transparent', 'w-12', 'h-5');
    });

    // ── Jam real-time ─────────────────────────────────────────
    function updateClock() {
        const now = new Date();
        const hh = String(now.getHours()).padStart(2, '0');
        const mm = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('prayer-clock').textContent = `${hh}:${mm} WIB`;
    }
    updateClock();
    setInterval(updateClock, 1000);

    // ── Highlight waktu sholat berikutnya ─────────────────────
    function setActivePrayer(jadwal) {
        const now = new Date();
        const nowMin = now.getHours() * 60 + now.getMinutes();
        let active = 'subuh'; // default jika sudah lewat Isya

        for (const waktu of PRAYER_ORDER) {
            const [h, m] = (jadwal[waktu] || '00:00').split(':').map(Number);
            if (nowMin < h * 60 + m) { active = waktu; break; }
        }

        // Ganti bagian ini di dalam setActivePrayer
        document.querySelectorAll('.prayer-item').forEach(el => {
            const isActive = el.dataset.waktu === active;

            // Gunakan class atau selektor yang lebih aman
            const label = el.querySelector('.prayer-label'); // atau 'span:first-of-type'
            const timeDisplay = el.querySelector('.prayer-time');

            el.classList.remove('bg-amber-50', 'border', 'border-primary');
            if (label) label.classList.remove('!text-primary', '!font-bold');
            if (timeDisplay) timeDisplay.classList.remove('!text-primary');

            if (isActive) {
                el.classList.add('bg-amber-50', 'border', 'border-primary');
                if (label) label.classList.add('!text-primary', '!font-bold');
                if (timeDisplay) timeDisplay.classList.add('!text-primary');
            }
        });
    }

    // ── Fetch MyQuran API v2 langsung dari browser ────────────
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');

    fetch(`https://api.myquran.com/v2/sholat/jadwal/${CITY_ID}/${yyyy}/${mm}/${dd}`)
        .then(res => res.json())
        .then(json => {
            if (!json.data?.jadwal) throw new Error('Data tidak tersedia');

            const jadwal = json.data.jadwal;

            PRAYER_ORDER.forEach(waktu => {
                const el = document.getElementById('time-' + waktu);
                if (!el) return;
                // Hapus skeleton
                el.classList.remove('animate-pulse', 'bg-stone-200', 'rounded', 'text-transparent', 'w-12', 'h-5');
                el.textContent = jadwal[waktu] ?? '--:--';
            });

            setActivePrayer(jadwal);
            setInterval(() => setActivePrayer(jadwal), 60_000);
        })
        .catch(() => {
            document.querySelectorAll('.prayer-time').forEach(el => {
                el.classList.remove('animate-pulse', 'bg-stone-200', 'rounded', 'text-transparent', 'w-12', 'h-5');
                el.textContent = '--:--';
            });
        });
});