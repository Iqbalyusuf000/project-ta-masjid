<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VisionMissionSeeder::class,
            PositionSeeder::class,
            DivisionSeeder::class,
            InfoSeeder::class,
            WaterRefillSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            DonationCategorySeeder::class,
        ]);
    }
}
