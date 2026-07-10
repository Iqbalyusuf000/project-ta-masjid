<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            ['question' => 'Apa perbedaan zakat, infaq, dan sedekah?', 'answer' => 'Zakat bersifat wajib dengan ketentuan nisab dan haul tertentu. Infaq dan sedekah bersifat sunnah, dapat diberikan kapan saja tanpa batasan jumlah minimal.', 'is_active' => true],
            ['question' => 'Apakah bisa berzakat menggunakan uang tunai?', 'answer' => 'Tidak bisa. Zakat fitrah hanya dapat diberikan dalam bentuk beras dengan berat 3 kg dan langsung di salurkan ke masjid melalui petugas zakat.', 'is_active' => true],
            ['question' => 'Bagaimana cara memastikan dana tersalurkan dengan benar?', 'answer' => 'Kami menerbitkan laporan keuangan berkala yang dapat diakses publik pada bagian Transparansi, lengkap dengan rincian program dan penerima manfaat.', 'is_active' => true],
            ['question' => 'Apakah bisa berdonasi secara rutin setiap bulan?', 'answer' => 'Bisa. Silakan hubungi admin melalui WhatsApp untuk pengaturan donasi rutin bulanan sesuai program pilihan Anda.', 'is_active' => true],
            ['question' => 'Kapan batas waktu penyaluran zakat fitrah?', 'answer' => 'Batas waktu penyaluran zakat fitrah adalah sebelum pelaksanaan salat Idul Fitri.', 'is_active' => true],
            ['question' => 'Kapan waktu saya bisa menyerahkan zakat fitrah langsung ke masjid?', 'answer' => 'Anda dapat menyerahkan zakat fitrah langsung ke masjid setiap hari mulai pukul 08.00 - 21.00 WIB (Tidak di waktu sholat).', 'is_active' => true],
        ];

        foreach ($faqs as $item) {
            Faq::create($item);
        }
    }
}
