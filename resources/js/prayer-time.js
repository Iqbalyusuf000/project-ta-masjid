document.addEventListener('DOMContentLoaded', function () {
    const CITY_ID = '74db120f0a8e5646ef5a30154e9f6deb'; // Kota Semarang
    const PRAYER_ORDER = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];

    // ── Skeleton shimmer ──────────────────────────────────────
    document.querySelectorAll('prayer-time').forEach(el => {
        el.classList.add('animate-pulse', 'bg-stone-200/20', 'rounded', 'text-transparent');
    });

    // ── Jam real-time ─────────────────────────────────────────
    function updateClock() {
        const now = new Date();
        const hh = String(now.getHours()).padStart(2, '0');
        const mm = String(now.getMinutes()).padStart(2, '0');
        const clockEl = document.getElementById('prayer-clock');
        if (clockEl) clockEl.textContent = `${hh}:${mm} WIB`;
    }
    updateClock();
    setInterval(updateClock, 1000);

    // ── Highlight waktu sholat berikutnya ─────────────────────
    function setActivePrayer(jadwalHariIni) {
        const now = new Date();
        const nowMin = now.getHours() * 60 + now.getMinutes();
        let active = 'subuh'; 

        for (const waktu of PRAYER_ORDER) {
            const [h, m] = (jadwalHariIni[waktu] || '00:00').split(':').map(Number);
            if (nowMin < h * 60 + m) { active = waktu; break; }
        }

        document.querySelectorAll('.prayer-item').forEach(el => {
            const isActive = el.dataset.waktu === active;
            const label = el.querySelector('.prayer-label');
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

    // ── Fetch MyQuran API v3 ──────────────────────────────────
    const today = new Date();
    const yyyy = today.getFullYear();
    // Menggunakan padStart untuk memastikan format 2 digit (07, 09, dst)
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    
    const dateString = `${yyyy}-${mm}-${dd}`;

    fetch(`https://api.myquran.com/v3/sholat/jadwal/${CITY_ID}/${dateString}`)
        .then(res => res.json())
        .then(json => {
            if (!json.data?.jadwal || !json.data.jadwal[dateString]) {
                throw new Error('Struktur data tanggal tidak cocok atau kosong');
            }

            const jadwalHariIni = json.data.jadwal[dateString];

            PRAYER_ORDER.forEach(waktu => {
                const el = document.getElementById('time-' + waktu);
                if (!el) return;
                
                // Bersihkan semua class skeleton secara total sebelum mengisi text
                el.classList.remove('animate-pulse', 'bg-stone-200', 'bg-stone-200/20', 'rounded', 'text-transparent');
                el.textContent = jadwalHariIni[waktu] ?? '--:--';
            });

            setActivePrayer(jadwalHariIni);
            setInterval(() => setActivePrayer(jadwalHariIni), 60_000);
        })
        .catch((err) => {
            console.error("Error Fetching:", err);
            // Jika gagal, pastikan text-transparent dihapus agar tulisan "--:--" terlihat kembali
            document.querySelectorAll('.prayer-time').forEach(el => {
                el.classList.remove('animate-pulse', 'bg-stone-200', 'bg-stone-200/20', 'rounded', 'text-transparent');
                el.textContent = '--:--';
            });
        });
});