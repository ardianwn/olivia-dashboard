<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Redirect user ke Google untuk login.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada di database berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Jika user belum terdaftar, buat akun baru
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('random-password'), // Google tidak menyediakan password
                ]);
            }

            // Login user
            Auth::login($user);

            // Redirect ke halaman 2FA jika belum diverifikasi
            if (!session('two_factor_authenticated')) {
                return redirect()->route('two-factor.index');
            }

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed!');
        }
    }
}
