<?php

use App\Http\Controllers\Api\V1\ProdukController;
use App\Http\Controllers\API\V1\PenggunaController;
use App\Http\Controllers\API\V1\BarangController;
use App\Http\Controllers\API\V1\KategoriController;
use App\Http\Controllers\API\V1\TransactionController;
use App\Http\Controllers\API\V1\StaffController;
use App\Http\Controllers\API\V1\CustomerController;
use App\Http\Controllers\API\V1\LaporanTransaksiController;
use App\Http\Controllers\API\V1\LaporanKeuanganController;
use App\Http\Controllers\API\V1\PiutangController;
use App\Http\Controllers\API\V1\HutangController;
use App\Http\Controllers\API\V1\SupplierController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\JenisPenggunaController;
use App\Http\Controllers\API\V1\DetailTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group (function () {
    Route::apiResource('/barang', BarangController::class);
    Route::apiResource('/kategori', KategoriController::class);
    Route::apiResource('/transactions', TransactionController::class);
    Route::apiResource('/staff', StaffController::class);
    Route::apiResource('/customers', CustomerController::class);
    Route::apiResource('/supplier', SupplierController::class);
    Route::apiResource('/laporantransaksi', LaporanTransaksiController::class);
    Route::apiResource('/laporankeuangan', LaporanKeuanganController::class);
    Route::apiResource('/piutang', PiutangController::class);
    Route::apiResource('hutangs', HutangController::class);
    Route::apiResource('/detail-transactions', DetailTransactionController::class);
});
Route::prefix('v1')->group (function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout')->middleware('auth:sanctum');
    });
    Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/penggunas', PenggunaController::class);
    Route::patch('/penggunas/{pengguna}/jenis', JenisPenggunaController::class);
    });
});