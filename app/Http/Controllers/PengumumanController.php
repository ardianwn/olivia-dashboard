<?php

namespace App\Http\Controllers;

use App\Models\BeritaPengumuman; // Model untuk pengumuman
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Menampilkan semua pengumuman
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua pengumuman dari database
        $pengumuman = BeritaPengumuman::latest()->get();

        // Kembalikan ke view dengan data pengumuman
        return view('pengumuman.index', compact('pengumuman'));
    }

    /**
     * Menampilkan form untuk membuat pengumuman baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pengumuman.create'); // Tampilan untuk membuat pengumuman
    }

    /**
     * Menyimpan pengumuman yang dibuat
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|string',
        ]);

        // Simpan pengumuman baru ke database
        BeritaPengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'jenis' => $request->jenis,
            'writer' => auth()->id(), // ID penulis pengumuman (admin atau ketua tim)
        ]);

        // Redirect ke halaman pengumuman dengan pesan sukses
        return redirect()->route('pengumuman.index')->with('status', 'Pengumuman berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit pengumuman yang sudah ada
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pengumuman = BeritaPengumuman::findOrFail($id);

        return view('pengumuman.edit', compact('pengumuman')); // Tampilan untuk mengedit pengumuman
    }

    /**
     * Mengupdate pengumuman yang sudah ada
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|string',
        ]);

        // Ambil pengumuman berdasarkan ID dan update data
        $pengumuman = BeritaPengumuman::findOrFail($id);
        $pengumuman->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'jenis' => $request->jenis,
        ]);

        // Redirect ke halaman pengumuman dengan pesan sukses
        return redirect()->route('pengumuman.index')->with('status', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Menghapus pengumuman
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Ambil pengumuman berdasarkan ID dan hapus
        $pengumuman = BeritaPengumuman::findOrFail($id);
        $pengumuman->delete();

        // Redirect ke halaman pengumuman dengan pesan sukses
        return redirect()->route('pengumuman.index')->with('status', 'Pengumuman berhasil dihapus.');
    }
}
