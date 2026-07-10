<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DonationCategory;

class DonationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Infaq Zakat Fitrah',
                'description' => 'Infaq tambahan saat membayar Zakat Fitrah di masjid.',
                'icon' => 'mdi:hand-coin',
                'target_amount' => 50000000,
                'badge' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Infaq Ramadan',
                'description' => 'Program infaq khusus di bulan suci Ramadan untuk kegiatan berbuka dan sahur.',
                'icon' => 'mdi:moon-waning-crescent',
                'target_amount' => 100000000,
                'badge' => 'Ramadan',
                'is_active' => true,
            ],
            [
                'name' => 'Infaq Umum',
                'description' => 'Infaq untuk operasional masjid dan kegiatan umum sehari-hari.',
                'icon' => 'mdi:mosque',
                'target_amount' => 200000000,
                'badge' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Santunan Yatim & Dhuafa',
                'description' => 'Bantuan rutin bulanan untuk anak yatim dan kaum dhuafa sekitar masjid.',
                'icon' => 'mdi:hand-heart',
                'target_amount' => 150000000,
                'badge' => 'Rutin',
                'is_active' => true,
            ]
        ];

        foreach ($categories as $item) {
            DonationCategory::create($item);
        }
    }
}
