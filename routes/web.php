<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\TeamManagementController;
use App\Http\Controllers\DocumentVerificationController;
use App\Http\Controllers\PaymentManagementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CompetitionCategoryController;
use App\Http\Controllers\NotificationController;


Route::put('/update', [DashboardController::class, 'update'])->name('pass.update');
// Halaman utama diarahkan ke login
Route::redirect('/', '/login');

// Rute untuk login dan register tanpa middleware auth
require __DIR__ . '/auth.php';

// Google OAuth Routes (Tanpa Middleware)
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Middleware untuk pengguna yang sudah login
Route::middleware(['auth'])->group(function () {

    // Redirect Dashboard berdasarkan role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'ketua.dashboard');
    })->name('dashboard');

    // ✅ Dashboard Admin
    Route::middleware(['role:admin'])->group(function () {
        // Admin Dashboard
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

        // Manajemen Tim
        Route::get('/admin/tim', [TeamManagementController::class, 'index'])->name('team-management.index');
        Route::get('/admin/tim/{id}', [TeamManagementController::class, 'show'])->name('team-management.show');
        Route::get('/admin/tim/{id}/edit', [TeamManagementController::class, 'edit'])->name('team-management.edit');
        Route::put('/admin/tim/{id}', [TeamManagementController::class, 'update'])->name('team-management.update');
        Route::delete('/admin/tim/{id}', [TeamManagementController::class, 'destroy'])->name('team-management.destroy');

        // Verifikasi Berkas
        Route::get('/admin/berkas', [DocumentVerificationController::class, 'index'])->name('document-verification.index');
        Route::get('/admin/berkas/{id}', [DocumentVerificationController::class, 'show'])->name('document-verification.show');
        Route::post('/admin/berkas/{id}/approve', [DocumentVerificationController::class, 'approve'])->name('document-verification.approve');
        Route::post('/admin/berkas/{id}/reject', [DocumentVerificationController::class, 'reject'])->name('document-verification.reject');

        // Manajemen Pembayaran
        Route::get('/admin/pembayaran', [PaymentManagementController::class, 'index'])->name('payment-management.index');
        Route::post('/admin/pembayaran/{id}/verify', [PaymentManagementController::class, 'verify'])->name('payment-management.verify');
        Route::post('/admin/pembayaran/{id}/reject', [PaymentManagementController::class, 'reject'])->name('payment-management.reject');

        // Laporan Pendaftaran
        Route::get('/admin/laporan', [ReportController::class, 'index'])->name('report.index');
        Route::post('/admin/laporan/export', [ReportController::class, 'export'])->name('report.export');

        // Pengelolaan Kategori Lomba
        Route::get('/admin/kategori', [CompetitionCategoryController::class, 'index'])->name('competition-category.index');
        Route::get('/admin/kategori/create', [CompetitionCategoryController::class, 'create'])->name('competition-category.create');
        Route::post('/admin/kategori', [CompetitionCategoryController::class, 'store'])->name('competition-category.store');
        Route::get('/admin/kategori/{id}/edit', [CompetitionCategoryController::class, 'edit'])->name('competition-category.edit');
        Route::put('/admin/kategori/{id}', [CompetitionCategoryController::class, 'update'])->name('competition-category.update');
        Route::delete('/admin/kategori/{id}', [CompetitionCategoryController::class, 'destroy'])->name('competition-category.destroy');

        // Kirim Notifikasi
        Route::get('/admin/notifikasi', [NotificationController::class, 'sendNotification'])->name('notification.send');
    });

    // ✅ Dashboard Ketua Tim & Fitur Pendaftaran Lomba
    Route::middleware(['role:ketua_tim'])->group(function () {

        Route::get('/ketua', [DashboardController::class, 'index'])->name('ketua.dashboard');
       
        Route::get('/member/{id}/ktm', [DetilPesertaController::class, 'showKtm'])->name('show.ktm');


        // 👤 Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // 🏆 TIM LOMBA
        Route::prefix('tim')->name('tim.')->group(function () {
            Route::get('/', [TimLombaController::class, 'index'])->name('index');
            Route::get('/create', [TimLombaController::class, 'create'])->name('create');
            Route::post('/', [TimLombaController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [TimLombaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [TimLombaController::class, 'update'])->name('update');
            Route::delete('/{id}', [TimLombaController::class, 'destroy'])->name('destroy');
        });

        // 👥 ANGGOTA TIM
        Route::prefix('anggota')->name('anggota.')->group(function () {
            Route::get('/', [DetilPesertaController::class, 'index'])->name('index');
            Route::get('/create', [DetilPesertaController::class, 'create'])->name('create');
            Route::post('/', [DetilPesertaController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [DetilPesertaController::class, 'edit'])->name('edit');
            Route::put('/{id}', [DetilPesertaController::class, 'update'])->name('update');
            Route::delete('/{id}', [DetilPesertaController::class, 'destroy'])->name('destroy');
        });

        // 📂 BERKAS LOMBA
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
            Route::put('/{id}', [PembayaranLombaController::class, 'update'])->name('update');
            Route::delete('/{id}', [PembayaranLombaController::class, 'destroy'])->name('destroy');
        });

        // ✅ FINAL SUBMIT
        Route::get('/final-submit', [FinalSubmitController::class, 'index'])->name('final.submit.index');
        Route::post('/final-submit', [FinalSubmitController::class, 'submitFinal'])->name('final.submit');

        // 📢 PENGUMUMAN LOMBA
        Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    });
});
