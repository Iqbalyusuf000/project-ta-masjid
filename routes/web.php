<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VisionMissionController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/vision-mission', [VisionMissionController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
Route::get('/contact', [ContactController::class, 'index']);
