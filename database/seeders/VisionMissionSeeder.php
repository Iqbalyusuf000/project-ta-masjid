<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\VisionMission;

class VisionMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('name', 'Admin Al Kautsar 1')->first();

        if (!$admin) {
            $this->command->warn('User "Admin Al Kautsar 1" tidak ditemukan. Pastikan UserSeeder telah dijalankan terlebih dahulu.');
            return;
        }

        $misi = [
            "Mengembangkan sistem tata kelola masjid yang profesional, akuntabel, dan berbasis digital.",
            "Menyelenggarakan program dakwah yang inovatif and relevan dengan perkembangan zaman bagi generasi muda.",
            "Memfasilitasi sarana ibadah yang nyaman, aman, dan inklusif bagi seluruh lapisan masyarakat.",
            "Membangun jejaring komunikasi dan kolaborasi digital antar jamaah."
        ];

        VisionMission::updateOrCreate(
            ['created_by' => $admin->id],
            [
                'visi' => 'Menjadi pusat peradaban Islam yang bersahaja, transparan, dan mengedepankan persatuan seluruh umat islam di Indonesia maupun dunia.',
                'misi' => $misi
            ]
        );
    }
}
