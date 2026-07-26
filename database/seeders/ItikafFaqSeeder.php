<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ItikafFaq;

class ItikafFaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question'   => "Siapa saja yang boleh mengikuti I'tikaf?",
                'answer'     => "I'tikaf terbuka untuk seluruh muslimin dan muslimat yang sudah baligh. Peserta Ikhwan (laki-laki) akan ditempatkan di area utama masjid, sedangkan peserta Akhwat (perempuan) di area musala khusus yang terpisah.",
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'question'   => "Apakah I'tikaf harus diikuti selama 10 hari penuh?",
                'answer'     => "Tidak harus. Peserta bebas memilih hari-hari mana saja yang ingin diikuti dari 10 malam terakhir Ramadhan. Malam ganjil (21, 23, 25, 27, 29) sangat dianjurkan karena merupakan malam-malam yang paling berpotensi menjadi Lailatul Qadr.",
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'question'   => "Apa saja yang perlu saya bawa saat I'tikaf?",
                'answer'     => "Barang yang perlu dibawa antara lain: pakaian ganti dan perlengkapan mandi, Al-Qur\'an atau buku dzikir, mukena/sajadah pribadi, obat-obatan pribadi, charger handphone, dan tas secukupnya. Tempat tidur, makan sahur, dan makan buka puasa sudah disediakan oleh panitia secara gratis.",
                'is_active'  => true,
                'sort_order' => 3,
            ],
            [
                'question'   => "Bagaimana jika saya ingin menambah infaq saat mendaftar?",
                'answer'     => "Saat mengisi formulir pendaftaran, terdapat opsi untuk menambahkan Infaq Ramadhan. Anda cukup mengaktifkan toggle infaq, mengisi nominal, dan memilih metode pembayaran (tunai atau transfer/QRIS). Kode unik 3 digit akan ditambahkan pada nominal transfer untuk memudahkan verifikasi panitia.",
                'is_active'  => true,
                'sort_order' => 4,
            ],
            [
                'question'   => "Kapan batas waktu pendaftaran I'tikaf ditutup?",
                'answer'     => "Pendaftaran online dibuka hingga malam ke-19 Ramadhan. Namun, jika kuota sudah penuh sebelum batas waktu, pendaftaran akan otomatis ditutup. Pastikan Anda mendaftar lebih awal untuk memastikan tempat Anda. Untuk informasi lebih lanjut, hubungi pengurus masjid melalui WhatsApp.",
                'is_active'  => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($faqs as $item) {
            ItikafFaq::create($item);
        }
    }
}
