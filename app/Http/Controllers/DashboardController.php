<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TimLomba;
use App\Models\DetilPeserta;
use App\Models\BerkasLomba;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Storage;



class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data tim yang dimiliki oleh user yang login
        $tim = TimLomba::where('id_ketua', Auth::id())->first();

        // Jika tim sudah terdaftar, ambil juga data anggota dan berkasnya
        $anggota = $tim ? DetilPeserta::where('id_tim', $tim->id)->get() : collect([]);
        $berkas = $tim ? BerkasLomba::where('id_tim', $tim->id)->get() : collect([]);

        return view('dashboard', compact('tim', 'anggota', 'berkas'));
    }
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }
    
        // Validasi input
        $validated = $request->validate([
            'nim' => ['required', 'string', 'max:20', "unique:users,nim,{$user->id}"],
            'no_wa' => ['required', 'string', 'max:15'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'scan_ktm' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'profile' => ['nullable', 'file', 'mimes:jpg,png', 'max:2048'],
        ]);
    
        // Jika ada file Scan KTM di-upload, simpan file baru
        if ($request->hasFile('scan_ktm')) {
            if ($user->ktm) {
                Storage::disk('public')->delete($user->ktm);
            }
            $validated['ktm'] = $request->file('scan_ktm')->store('ktm', 'public');
        }
    
        // Jika ada file Foto Anggota di-upload, simpan file baru
        if ($request->hasFile('foto_anggota')) {
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }
            $validated['profile'] = $request->file('profile')->store('profiles', 'public');
        }
    
        // Jika password diisi, update password
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']); // Jangan update password jika kosong
        }
    
        // Update user
        $user->fill($validated);
        $user->save();
    
        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
}
