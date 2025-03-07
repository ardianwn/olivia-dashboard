<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;// Import middleware langsung
use App\Http\Controllers\Auth\GoogleController;

// Halaman utama diarahkan ke login
Route::redirect('/', '/login'); // ✅ Redirect ke route login default


// Rute untuk login dan register tidak boleh terkena middleware 2FA
require __DIR__.'/auth.php';

// Route untuk redirect ke Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');

// Route untuk menangani callback dari Google
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');


// // Middleware 2FA hanya diterapkan **setelah user login**
// Route::middleware(['auth'])->group(function () {
//     Route::get('/two-factor', [TwoFactorController::class, 'index'])->name('two-factor.index');
//     Route::post('/two-factor', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
// });

// Middleware `twofactor` hanya diterapkan setelah login dan bukan di halaman login/register
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
