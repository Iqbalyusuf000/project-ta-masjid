<?php

namespace Database\Seeders;

use App\Models\WaterRefill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterRefillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WaterRefill::updateOrCreate([
            'name' => 'Isi Ulang Galon',
            'description' => 'Layanan pengisian ulang galon standar 19 liter dengan air yang telah melalui 12 tahap filtrasi dan sterilisasi UV.',
            'price' => '5000',
            'is_active' => true,
        ]);
    }
}
