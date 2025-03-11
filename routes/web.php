<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TimLombaController;
use App\Http\Controllers\DetilPesertaController;
use App\Http\Controllers\BerkasLombaController;
use App\Http\Controllers\PembayaranLombaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\FinalSubmitController;
use App\Http\Controllers\Admin\AdminController;



// Halaman utama diarahkan ke login
Route::redirect('/', '/login'); 

// Rute untuk login dan register tanpa middleware auth
require __DIR__.'/auth.php';

// Google OAuth Routes (Tanpa Middleware)
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});
// Middleware `auth` untuk semua route setelah login
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Ketua Tim
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/update', [DashboardController::class, 'update'])->name('pass.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('tim')->name('tim.')->group(function () {
        Route::get('/', [TimLombaController::class, 'index'])->name('index');
        Route::get('/create', [TimLombaController::class, 'create'])->name('create');
        Route::post('/', [TimLombaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TimLombaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TimLombaController::class, 'update'])->name('update');
        Route::delete('/{id}', [TimLombaController::class, 'destroy'])->name('destroy');
    });

    // 👥 ANGGOTA
    Route::prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/', [DetilPesertaController::class, 'index'])->name('index');
        Route::get('/create', [DetilPesertaController::class, 'create'])->name('create');
        Route::post('/', [DetilPesertaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DetilPesertaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DetilPesertaController::class, 'update'])->name('update');
        Route::delete('/{id}', [DetilPesertaController::class, 'destroy'])->name('destroy');
    });

    // 📂 BERKAS
    Route::prefix('berkas')->name('berkas.')->group(function () {
        Route::get('/', [BerkasLombaController::class, 'index'])->name('index');
        Route::get('/create', [BerkasLombaController::class, 'create'])->name('create');
        Route::post('/', [BerkasLombaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BerkasLombaController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BerkasLombaController::class, 'update'])->name('update');
        Route::delete('/{id}', [BerkasLombaController::class, 'destroy'])->name('destroy');
    });

    // 💰 PEMBAYARAN
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', [PembayaranLombaController::class, 'index'])->name('index');
        Route::get('/create', [PembayaranLombaController::class, 'create'])->name('create');
        Route::post('/', [PembayaranLombaController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PembayaranLombaController::class, 'edit'])->name('edit');
        Route::put('/', [PembayaranLombaController::class, 'update'])->name('update');
        Route::delete('/{id}', [PembayaranLombaController::class, 'destroy'])->name('destroy');
    });

    Route::get('/final-submit', [FinalSubmitController::class, 'index'])->name('final.submit.index');
    Route::post('/final-submit', [FinalSubmitController::class, 'submitFinal'])->name('final.submit');
    // Pengumuman Lomba
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
});
