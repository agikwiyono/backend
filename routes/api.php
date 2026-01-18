<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rute untuk Registrasi (sesuai kebutuhan signupage.dart)
Route::post('/register', [AuthController::class, 'register']);

// Rute untuk Login (sesuai kebutuhan loginpage.dart)
Route::post('/login', [AuthController::class, 'login']);

// Contoh rute yang memerlukan autentikasi (menggunakan Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});