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
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // --- Rute Publik (Tanpa Login) ---
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/dashboard/stats', [LaporanTransaksiController::class, 'dashboardStats']);
    Route::get('dashboard', [App\Http\Controllers\API\V1\DashboardController::class, 'index']);

   
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        // Data Master & Operasional
        Route::apiResource('/barang', BarangController::class);
        Route::apiResource('/kategori', KategoriController::class);
        Route::apiResource('/transactions', TransactionController::class);
        Route::apiResource('/staff', StaffController::class);
        Route::apiResource('/customers', CustomerController::class);
        Route::apiResource('/supplier', SupplierController::class);
        Route::apiResource('/detail-transactions', DetailTransactionController::class);
        
        // Laporan & Keuangan
        Route::apiResource('/laporantransaksi', LaporanTransaksiController::class);
        Route::apiResource('/laporankeuangan', LaporanKeuanganController::class);
        Route::apiResource('/piutang', PiutangController::class);
        Route::apiResource('/hutangs', HutangController::class);

        // Manajemen Pengguna
        Route::apiResource('/penggunas', PenggunaController::class);
        Route::patch('/penggunas/{pengguna}/jenis', JenisPenggunaController::class);
    });
});