# Implementation Plan: Masjid Apps Backend

Dokumen ini berisi panduan tingkat tinggi (*high-level*) untuk mensetup *stack* proyek Masjid Apps Backend. Instruksi ini ditujukan untuk digunakan sebagai acuan instalasi dan persiapan, baik oleh *programmer* atau model eksekutor eksternal.

Jika komponen yang disebutkan sudah diinstal di dalam proyek, *step* tersebut dapat dilewati atau diverifikasi (*Skip/Verify*).

---

## 1. Environment & Prerequisites
Pastikan *software* pendukung berikut sudah tersedia di sistem operasi (*Environment*):
- **PHP** (Minimal versi 8.2+) -> *(Saat ini menggunakan PHP 8.4.4)*
- **Composer** -> *(Saat ini menggunakan Composer 2.8.5)*
- **Node.js & NPM** -> *(Saat ini menggunakan NPM 11.5.2)*
- **MySQL Database Server**

## 2. Instalasi Framework Laravel
- **Tujuan**: Menjalankan *core framework* backend.
- **Instruksi**:
  - Inisialisasi *project* Laravel baru menggunakan Composer.
  - Namun, cek terlebih dahulu file `composer.json`. Jika `laravel/framework` (v12) sudah ada, langkah instalasi ulang **bisa dilewati**, cukup jalankan `composer install` untuk memastikan semua *dependency* tersedia.

## 3. Konfigurasi MySQL Database
- **Tujuan**: Menghubungkan *project* Laravel dengan *database*.
- **Instruksi**:
  - Pastikan MySQL Server sudah berjalan.
  - Buat *database* baru (contoh nama: `masjid-alkautsar`).
  - Lakukan konfigurasi (*setup*) koneksi *database* di dalam file `.env` Laravel dengan parameter yang sesuai (Host, Port, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
  - Jalankan perintah *migration* Laravel agar skema *database* terbentuk: `php artisan migrate`.

## 4. Konfigurasi Tailwind CSS
- **Tujuan**: Memastikan ketersediaan utilitas gaya desain modern untuk bagian *frontend* atau kustomisasi UI.
- **Instruksi**:
  - Lakukan pengecekan pada file `package.json`.
  - Jika paket `@tailwindcss/vite` atau `tailwindcss` (v4.x) dan skrip `vite` sudah ada, langkah instalasi paket **bisa dilewati**.
  - Eksekusi pemasangan dependensi NPM (`npm install`).
  - Kompilasi aset menggunakan perintah Vite (`npm run build` / `npm run dev`).

## 5. Instalasi Filament Admin Panel
- **Tujuan**: Membuat panel dasbor administratif secara instan berbekal TALL stack.
- **Instruksi**:
  - Lakukan instalasi komposer untuk modul Filament: `composer require filament/filament:"^3.2" -W`. *(Penting: pastikan MySQL database connection sudah valid jika ada peringatan).*
  - Inisialisasi *Panel Provider* Filament menggunakan Artisan command: `php artisan filament:install --panels`.
  - Publikasikan aset dasar dari sistem Filament ke *public directory*.
  - (*Opsional, sangat disarankan*) Buat akun pengguna dasar (*super admin*) menggunakan *command* Artisan: `php artisan make:filament-user`.
  - Verifikasi instalasi dengan mencoba mengakses direktori web `/admin`.
