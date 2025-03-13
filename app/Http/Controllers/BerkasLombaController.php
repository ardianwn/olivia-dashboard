<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasLomba;
use App\Models\TimLomba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PembayaranLomba;

class BerkasLombaController extends Controller
{
    public function index()
    {
       // Cari tim berdasarkan ID ketua yang sedang login
    $tim = TimLomba::where('id_ketua', Auth::id())->first();
    $t = TimLomba::where('id_ketua', Auth::id())->first(); // Ambil satu objek, bukan Collection

    if ($t && $t->status_final_submit == 1) {
        return redirect()->route('ketua.dashboard')->with('success', 'Silakan menunggu pengumuman');
    }
    // Jika tim tidak ditemukan, redirect ke halaman pembayaran
    if (!$tim) {
        return redirect()->route('pembayaran.index')->with('error', 'Tim tidak ditemukan.');
    }
    
    // Periksa apakah pembayaran telah dilakukan
    $pembayaran = PembayaranLomba::where('id_tim', $tim->id)->first();

    if ($pembayaran) {
        // Jika sudah membayar, tampilkan halaman berkas
        $berkas = BerkasLomba::where('id_tim', $tim->id)->get();
        return view('berkas.index', compact('berkas', 'tim'));
    } else {
        // Jika belum membayar, redirect ke halaman pembayaran
        return redirect()->route('pembayaran.index')->with('error', 'Lakukan pembayaran terlebih dahulu.');
    }
    }

    public function create()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        return view('berkas.create', compact('tim'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'url_file' => 'required|file|mimes:pdf,doc,docx|max:5120', // Maksimal 5MB
        ]);

        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        if (!$tim) {
            return redirect()->route('dashboard')->with('error', 'Tim tidak ditemukan.');
        }

        // Simpan file
        $path = $request->file('url_file')->store('berkas_lomba', 'public');

        BerkasLomba::create([
            'id_tim' => $tim->id,
            'nama_file' => $request->nama_file,
            'url_file' => $path,
            'status_verifikasi' => 'pending',
        ]);

        return redirect()->route('berkas.index')->with('success', 'Berkas berhasil diunggah!');
    }

    public function edit(BerkasLomba $berkas)
    {
        return view('berkas.edit', compact('berkas'));
    }

    public function update(Request $request, BerkasLomba $berkas)
    {
        $request->validate([
            'nama_file' => 'required|string|max:255',
            'url_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('url_file')) {
            Storage::delete('public/' . $berkas->url_file);
            $path = $request->file('url_file')->store('berkas_lomba', 'public');
            $berkas->update(['url_file' => $path]);
        }

        $berkas->update(['nama_file' => $request->nama_file]);

        return redirect()->route('berkas.index')->with('success', 'Berkas diperbarui!');
    }

    public function destroy(BerkasLomba $berkas)
    {
        Storage::delete('public/' . $berkas->url_file);
        $berkas->delete();

        return redirect()->route('berkas.index')->with('success', 'Berkas dihapus!');
    }
}
