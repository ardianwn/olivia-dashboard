<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PembayaranLomba;
use App\Models\TimLomba;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranLombaController extends Controller
{
    public function index()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        
        if (!$tim) {
            return redirect()->route('dashboard')->with('error', 'Tim tidak ditemukan.');
        }

        $pembayaran = PembayaranLomba::where('id_tim', $tim->id)->first();
        return view('pembayaran.index', compact('pembayaran', 'tim'));
    }

    public function create()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->first();
        
        if (!$tim) {
            return redirect()->route('dashboard')->with('error', 'Tim tidak ditemukan.');
        }

        return view('pembayaran.create', compact('tim'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $tim = TimLomba::where('id_ketua', Auth::id())->first();

        if (!$tim) {
            return redirect()->route('dashboard')->with('error', 'Tim tidak ditemukan.');
        }

        // Simpan file bukti pembayaran
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        PembayaranLomba::create([
            'id_tim' => $tim->id,
            'bukti_pembayaran' => $path,
            'status_verifikasi' => 'pending',
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Bukti pembayaran berhasil diunggah!');
    }

    public function edit($id)
    {
        $pembayaran = PembayaranLomba::findOrFail($id);
        return view('pembayaran.edit', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranLomba::findOrFail($id);

        $request->validate([
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama jika ada
            if ($pembayaran->bukti_pembayaran) {
                Storage::delete('public/' . $pembayaran->bukti_pembayaran);
            }

            // Simpan file baru
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            $pembayaran->update(['bukti_pembayaran' => $path]);
        }

        return redirect()->route('pembayaran.index')->with('success', 'Bukti pembayaran diperbarui!');
    }
}
