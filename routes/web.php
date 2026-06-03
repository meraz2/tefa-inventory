<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Hak Akses Bersama (Admin & Petugas)
    Route::resource('barang', BarangController::class);

    // Diubah ke resource agar tidak error saat membuka halaman tambah/edit peminjam
    Route::resource('peminjam', PeminjamController::class);

    // Hak Akses Khusus Admin (Sesuai Sidebar ketentuan: Petugas tidak ada menu peminjaman)
    Route::middleware(['role:admin'])->group(function () {
        // RUTE KHUSUS EXPORT DATA (Wajib di atas Route::resource agar tidak terbaca sebagai parameter ID)
        Route::get('/peminjaman/export/excel', [PeminjamanController::class, 'exportExcel'])->name('peminjaman.export.excel');
        Route::get('/peminjaman/export/pdf', [PeminjamanController::class, 'exportPdf'])->name('peminjaman.export.pdf');

        // Rute CRUD Peminjaman Utama
        Route::resource('peminjaman', PeminjamanController::class);
    });
});

require __DIR__.'/auth.php';
