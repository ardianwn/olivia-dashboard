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

    // Menambahkan kategori lomba baru
    public function store(Request $request)
    {
        KategoriLomba::create($request->all());
        return redirect()->route('competition-category.index')->with('success', 'Kategori lomba berhasil ditambahkan');
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
        $kategori = KategoriLomba::findOrFail($id);
        $kategori->update($request->all());
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
