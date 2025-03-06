<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Verify2FAMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login sebelum memeriksa 2FA
        if (!Auth::check()) {
            return $next($request);
        }

        // Jangan arahkan ke 2FA jika user berada di halaman login, register, password reset, atau logout
        if ($request->routeIs('login') || 
            $request->routeIs('register') || 
            $request->routeIs('password.request') || 
            $request->routeIs('password.email') || 
            $request->routeIs('password.reset') || 
            $request->routeIs('logout')) {
            return $next($request);
        }

        // Jika user sudah login tetapi belum melewati 2FA, arahkan ke halaman Two-Factor
        if (!session('two_factor_authenticated')) {
            return redirect()->route('two-factor.index');
        }

        return $next($request);
    }
}
