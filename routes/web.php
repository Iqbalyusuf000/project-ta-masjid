<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisionMissionController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/vision-mission', [VisionMissionController::class, 'index'])->name('vision-mission');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
