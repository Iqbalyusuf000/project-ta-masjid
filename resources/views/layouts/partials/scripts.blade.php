<script src="https://cdn.jsdelivr.net/npm/iconify-icon/dist/iconify-icon.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hero = document.querySelector("section.relative.h-screen");
        if (hero) {
            window.addEventListener("scroll", function() {
                const scrollY = window.scrollY;
                if (scrollY > 100) {
                    hero.style.transition = "filter 0.3s ease, opacity 0.3s ease";
                    hero.style.filter = "blur(2px)";
                    hero.style.opacity = "0.95";
                } else {
                    hero.style.filter = "";
                    hero.style.opacity = "";
                }
            });
        }

        const clockEl = document.getElementById("live-clock");
        if (clockEl) {
            const updateClock = function() {
                const now = new Date();
                clockEl.textContent = now.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit", second: "2-digit", hour12: false, timeZone: "Asia/Jakarta" });
            };
            updateClock();
            setInterval(updateClock, 1000);
        }

        const marqueeEl = document.getElementById("prayer-marquee");
        if (marqueeEl && window.axios) {
            window.axios.get("https://api.aladhan.com/v1/timingsByCity", { params: { city: "Semarang", country: "Indonesia", method: 2 } })
                .then(function(resp) {
                    const t = resp?.data?.data?.timings;
                    if (t) {
                        marqueeEl.textContent = "Semarang — Subuh " + t.Fajr + " • Dzuhur " + t.Dhuhr + " • Ashar " + t.Asr + " • Maghrib " + t.Maghrib + " • Isya " + t.Isha;
                    }
                })
                .catch(function() {
                    marqueeEl.textContent = "Gagal memuat jadwal sholat Semarang";
                });
        }
    });
</script>
