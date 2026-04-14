<?php

use App\Http\Controllers\Api\VisionMissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/vision-mission', [VisionMissionController::class, 'index']);
