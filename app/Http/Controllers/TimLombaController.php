<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimLomba;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\DetilPeserta;

class TimLombaController extends Controller
{
    public function index()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->get();
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
    
        return view('tim.create');
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
            'cabang_lomba' => $request->cabang_lomba,
            'foto_tim' => $fotoPath
        ]);
        $data = [
            'id_tim' => $tim['id'],
        ];
       DetilPeserta::where('nim', Auth::nim())->update($data);
    
        return redirect()->route('tim.index')->with('success', 'Tim berhasil dibuat.');
    }

    public function edit($id)
    {
        $tim = TimLomba::findOrFail($id);
        return view('tim.edit', compact('tim'));
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
            'cabang_lomba' => $request->cabang_lomba,
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
