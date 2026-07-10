<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class PrayerTimeWidget extends Component
{
    public $jadwalHariIni;

    public function __construct()
    {
        $dateString = Carbon::now()->format('Y-m-d');
        $cityId = '74db120f0a8e5646ef5a30154e9f6deb'; // Semarang

        // Logika API dipindah ke sini dan di-cache 24 jam
        $this->jadwalHariIni = Cache::remember("jadwal_sholat_{$dateString}", now()->addHours(24), function () use ($cityId, $dateString) {
            try {
                $response = Http::get("https://api.myquran.com/v3/sholat/jadwal/{$cityId}/{$dateString}");
                if ($response->successful()) {
                    return $response->json()['data']['jadwal'][$dateString] ?? null;
                }
            } catch (\Exception $e) {
                \Log::error("Gagal fetch jadwal sholat di komponen: " . $e->getMessage());
            }
            return null;
        });
    }

    public function render(): View|Closure|string
    {
        return view('components.prayer-time-widget');
    }
}