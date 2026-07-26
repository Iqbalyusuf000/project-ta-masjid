<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WaterRefillController;
use App\Http\Controllers\KajianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisionMissionController;
use App\Http\Controllers\ZakatController;
use App\Http\Controllers\ItikafController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/test-native-css', [HomeController::class, 'indexNative'])->name('home.native');
Route::post('/donation/store', [HomeController::class, 'storeDonation'])->name('donation.store');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/unit-usaha-masjid/isi-ulang-alka', [WaterRefillController::class, 'index'])->name('water-refill');
Route::get('/unit-usaha-masjid/haji-dan-umroh-alka', function () { return view('pages.hajj'); })->name('hajj');
Route::get('/program/kajian', [KajianController::class, 'index'])->name('kajian');
Route::get('/program/kajian/{kajianDetail}', [KajianController::class, 'show'])->name('kajian.show');
Route::get('/program/zakat', [ZakatController::class, 'index'])->name('zakat');
Route::post('/program/zakat/store', [ZakatController::class, 'store'])->name('zakat.store');
Route::get('/program/itikaf', [ItikafController::class, 'index'])->name('itikaf');
Route::post('/program/itikaf/store', [ItikafController::class, 'store'])->name('itikaf.store');
Route::get('/laporan-keuangan', [FinancialReportController::class, 'index'])->name('financial-report');