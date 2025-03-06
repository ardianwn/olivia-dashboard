<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TwoFactorController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Debugging untuk memastikan user benar-benar instance dari Model User
        if (!$user instanceof User) {
            abort(500, "User instance is invalid.");
        }

        // Cek apakah kode sudah ada, jika tidak, buat baru
        if (!$user->two_factor_code) {
            $code = rand(100000, 999999);
            $user->two_factor_code = $code;
            $user->save();

            // Log untuk memastikan kode 2FA dibuat
            \Log::info("User {$user->id} - Generated 2FA Code: {$code}");

            // Kirim kode ke email
            Mail::raw("Your two-factor code is $code", function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Two-Factor Code');
            });
        }

        return view('auth.two-factor');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ]);

        $user = Auth::user();

        // Debugging untuk memastikan kode yang disimpan sama dengan input
        \Log::info("User {$user->id} - Entered Code: {$request->code}, Stored Code: {$user->two_factor_code}");

        // Verifikasi kode
        if ($request->code == $user->two_factor_code) {
            session(['two_factor_authenticated' => true]);

            // Hapus kode setelah diverifikasi
            $user->two_factor_code = null;
            $user->save();

            return redirect()->intended('/dashboard');
        }

        return redirect()->route('two-factor.index')->withErrors(['code' => 'The provided code is incorrect.']);
    }
}
