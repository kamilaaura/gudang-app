<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MutasiController;

// Tes API (ping)
Route::get('/ping', function () {
    return ['message' => 'pong'];
});

// 🔓 Public Routes (Tanpa token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔐 Protected Routes (Butuh token)
Route::middleware('auth:sanctum')->group(function () {

    // 🔒 Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    // 📦 Produk (CRUD)
    Route::apiResource('produk', ProdukController::class);

    // 📍 Lokasi (Create & Read)
    Route::post('/lokasi', [LokasiController::class, 'store']);
    Route::get('/lokasi', [LokasiController::class, 'index']);
    Route::get('/lokasi/{id}', [LokasiController::class, 'show']);
    Route::put('/lokasi/{id}', [LokasiController::class, 'update']);
    Route::delete('/lokasi/{id}', [LokasiController::class, 'destroy']);

    // 🔄 Mutasi (CRUD)
    Route::apiResource('mutasi', MutasiController::class);

    // 📜 History mutasi
    Route::get('/produk/{id}/history', [MutasiController::class, 'historyByProduk']);
    Route::get('/user/{id}/history', [MutasiController::class, 'historyByUser']);
});
