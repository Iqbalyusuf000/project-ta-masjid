<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            'Dewan Penasehat',
            'Pengurus Harian',
            "Ibadah & Kejama'ahan",
            'Kesejahteraan Sosial',
            'Ekonomi & Usaha',
            'Pendidikan',
            'Humas',
            'Media',
            'Lingkungan Hidup & Keamanan',
            'Koordinator Ummahat',
        ];

        foreach ($divisions as $division) {
            Division::firstOrCreate([
                'name' => $division,
            ]);
        }
    }
}
