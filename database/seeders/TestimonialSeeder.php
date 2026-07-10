<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Bapak Ghofur, Penerima Zakat',
                'content' => 'Penyaluran zakat di Masjid Al Kautsar sangat membantu bagi saya dan keluarga. Bantuan ini sangat berarti bagi kami yang membutuhkan.',
                'is_active' => true,
            ],
            [
                'name' => 'Bapak Slamet, Donatur Tetap',
                'content' => 'Laporan keuangannya jelas dan bisa diakses kapan saja, jadi saya percaya penuh menyalurkan zakat lewat masjid ini.',
                'is_active' => true,
            ],
            [
                'name' => 'Udin, Hansip',
                'content' => 'Alhamdulillah biaya kebutuhan keluarga saya terbantu, semoga program ini terus berlanjut untuk membantu sesama.',
                'is_active' => true,
            ]
        ];

        foreach ($testimonials as $item) {
            Testimonial::create($item);
        }
    }
}
