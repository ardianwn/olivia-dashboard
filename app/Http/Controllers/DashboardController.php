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
        $anggota = $tim ? DetilPeserta::where('id_tim', $tim->id)->get() : collect([]);
        // Jika tim sudah terdaftar, ambil juga data anggota dan berkasnya
        $anggota = $tim ? DetilPeserta::where('id_tim', $tim->id)->get() : collect([]);
        $berkas = $tim ? BerkasLomba::where('id_tim', $tim->id)->get() : collect([]);

        return view('ketua.dashboard', compact('tim', 'anggota', 'berkas'));
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
            'name' => ['required', 'string', 'max:255'],
            'no_wa' => ['required', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,9}$/', 'digits_between:10,13'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'ktm' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,bmp,svg,webp,ico,tiff,tif,avif,pdf', 'max:2048'],
            'profile' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,bmp,svg,webp,ico,tiff,tif,avif', 'max:2048'],
        ]);

        // Inisialisasi data yang akan diperbarui
        $data = [
            'name' => $request->name,
            'nim' => $validated['nim'],
            'no_wa' => $validated['no_wa'],
            'status' => 'active'
        ];


        // Jika ada file Scan KTM di-upload, simpan file baru dan hapus yang lama
        if ($request->hasFile('ktm')) {
            if ($user->ktm) {
                Storage::disk('public')->delete($user->ktm);
            }
            $data['ktm'] = $request->file('ktm')->store('ktm', 'public');
            $tim['scan_ktm'] = $request->file('ktm');
        }

        // Jika ada file Foto Anggota di-upload, simpan file baru dan hapus yang lama
        if ($request->hasFile('profile')) {
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }
            $data['profile'] = $request->file('profile')->store('profile', 'public');
            $tim['foto_anggota'] = $request->file('profile')->store('anggota', 'public');
        }

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Debugging untuk melihat apakah gambar tersimpan dengan benar
        // dd($data);
        $tim = [
            'nim' => $request->nim,
            'nama_lengkap' => $request->name,
            'no_wa' => $request->no_wa ,
            'status_verifikasi' => 'pending',
        ];
       
        // Update user
        User::where('id', Auth::id())->update($data);
        // create Anggota
        DetilPeserta::create($tim);
        return redirect()->route('tim.index')->with('success', 'Profil berhasil diperbarui.');
    }
}
