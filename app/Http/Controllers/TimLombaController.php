<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimLomba;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\DetilPeserta;
use App\Models\KategoriLomba;


class TimLombaController extends Controller
{
    public function index()
    {   
        $data = Auth::User()->status;
        if ($data == 'register') {
            return redirect()->route('ketua.dashboard')->with('error', 'Tim tidak ditemukan.');
        }
        $tim = TimLomba::with('kategori')->where('id_ketua', Auth::id())->get();
        $t = TimLomba::where('id_ketua', Auth::id())->first(); // Ambil satu objek, bukan Collection

        if ($t && $t->status_final_submit == 1) {
            return redirect()->route('ketua.dashboard')->with('success', 'Silakan menunggu pengumuman');
        }
        return view('tim.index', compact('tim'));
    }

    public function create()
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Cek apakah user sudah memiliki tim
        if (TimLomba::where('id_ketua', Auth::id())->exists()) {
            return redirect()->route('tim.index')->with('error', 'Anda hanya dapat membuat satu tim.');
        }
        $kategoriLomba = KategoriLomba::all();
        return view('tim.create', compact('kategoriLomba'));
    }
    
    public function store(Request $request)
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Cek apakah user sudah memiliki tim
        if (TimLomba::where('id_ketua', Auth::id())->exists()) {
            return redirect()->route('tim.index')->with('error', 'Anda hanya dapat membuat satu tim.');
        }
    
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'nama_kampus' => 'required|string|max:255',
            'cabang_lomba' => 'required|string|max:255',
            'foto_tim' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $fotoPath = null;
        if ($request->hasFile('foto_tim')) {
            $fotoPath = $request->file('foto_tim')->store('tim_foto', 'public');
        }
    
        $tim = TimLomba::create([
            'id_ketua' => Auth::id(), // Simpan ID ketua tim
            'nama_tim' => $request->nama_tim,
            'nama_kampus' => $request->nama_kampus,
            'kategori_id' => $request->cabang_lomba,
            'foto_tim' => $fotoPath
        ]);
        $data = ['id_tim' => $tim->id];
       DetilPeserta::where('nim', Auth::user()->nim)->update($data);
    
        return redirect()->route('tim.index')->with('success', 'Tim berhasil dibuat.');
    }

    public function edit($id)
    {
        $tim = TimLomba::findOrFail($id);
        $kategoriLomba = KategoriLomba::all();
        return view('tim.edit', compact('tim','kategoriLomba'));
    }

    public function update(Request $request, $id)
    {
        $tim = TimLomba::findOrFail($id);
        
        $request->validate([
            'nama_tim' => 'required|string|max:255',
            'nama_kampus' => 'required|string|max:255',
            'cabang_lomba' => 'required|string|max:255',
            'foto_tim' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('foto_tim')) {
            if ($tim->foto_tim) {
                Storage::disk('public')->delete($tim->foto_tim);
            }
            $fotoPath = $request->file('foto_tim')->store('tim_foto', 'public');
        } else {
            $fotoPath = $tim->foto_tim;
        }

        $tim->update([
            'nama_tim' => $request->nama_tim,
            'nama_kampus' => $request->nama_kampus,
            'kategori_id' => $request->cabang_lomba,
            'foto_tim' => $fotoPath,
        ]);

        return redirect()->route('tim.index')->with('success', 'Tim berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tim = TimLomba::findOrFail($id);

        if ($tim->foto_tim) {
            Storage::disk('public')->delete($tim->foto_tim);
        }

        $tim->delete();
        return redirect()->route('tim.index')->with('success', 'Tim berhasil dihapus.');
    }
}
