<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Info;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::createOrFirst([
            'address' => 'Jl. Cempolorejo V No.21, Krobokan, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50141',
            'phone_number' => '082329621484',
            'email' => 'alkautsar@gmail.com',
        ]);
    }
}
