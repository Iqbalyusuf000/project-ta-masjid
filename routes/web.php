<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisionMissionController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
