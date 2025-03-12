<?php

namespace App\Http\Controllers;

use App\Models\KategoriLomba;
use Illuminate\Http\Request;

class CompetitionCategoryController extends Controller
{
    // Menampilkan daftar kategori lomba
    public function index()
    {
        $kategori = KategoriLomba::all();
        return view('competition-category.index', compact('kategori'));
    }

    public function create()
    {
        return view('competition-category.create');
    }

    // Menyimpan kategori lomba baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jumlah_anggota_maksimal' => 'required|integer|min:1',
        ]);
    
        KategoriLomba::create([
            'nama_kategori' => $request->nama_kategori,
            'jumlah_anggota_maksimal' => $request->jumlah_anggota_maksimal,
        ]);
    
        return redirect()->route('competition-category.index')->with('success', 'Kategori berhasil ditambahkan');
    }
    

    // Mengedit kategori lomba
    public function edit($id)
    {
        $kategori = KategoriLomba::findOrFail($id);
        return view('competition-category.edit', compact('kategori'));
    }

    // Menyimpan perubahan kategori lomba
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jumlah_anggota_maksimal' => 'required|integer|min:1',
        ]);
    
        // Cari data kategori berdasarkan ID
        $kategori = KategoriLomba::findOrFail($id);
    
        // Update data kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'jumlah_anggota_maksimal' => $request->jumlah_anggota_maksimal,
        ]);
    
        return redirect()->route('competition-category.index')->with('success', 'Kategori lomba berhasil diperbarui');
    }
    
    

    // Menghapus kategori lomba
    public function destroy($id)
    {
        $kategori = KategoriLomba::findOrFail($id);
        $kategori->delete();
        return redirect()->route('competition-category.index')->with('success', 'Kategori lomba berhasil dihapus');
    }
}
