<?php

namespace App\Http\Controllers;

use App\Models\BerkasLomba;

use Illuminate\Http\Request;


class DocumentVerificationController extends Controller
{
    // Menampilkan daftar berkas yang diunggah
    public function index()
    {

        $berkas = BerkasLomba::with('tim')->get();
        return view('document-verification.index', compact('berkas'));
    }

    // Menampilkan detail berkas
    public function show($id)
    {
        $berkas = BerkasLomba::findOrFail($id);
        return view('document-verification.show', compact('berkas'));
    }

    // Menyetujui berkas
    public function update(Request $request, $id)
    {
        $berkas = BerkasLomba::findOrFail($id);
        // Memastikan ada status yang dikirimkan dalam request
        $status = $request->input('status');


        // Mengecek apakah status yang diterima valid
        if ($status && in_array($status, ['valid', 'rejected'])) {
            // Mengupdate status berkas
            $berkas->status_verifikasi = $status;
            $berkas->save();

            // Menampilkan pesan sukses
            return redirect()->route('document-verification.index')->with('success', 'Status berkas berhasil diperbarui!');
        }
        // Jika tidak ada status atau status tidak valid
        return redirect()->route('document-verification.index')->with('error', 'Terjadi kesalahan dalam memperbarui status berkas.');
    }

    // // Menolak berkas dan memberi catatan revisi
    // public function reject(Request $request, $id)
    // {
    //     $berkas = BerkasLomba::findOrFail($id);
    //     $berkas->update(['status_verifikasi' => 'Perlu Revisi', 'catatan_revisi' => $request->catatan]);
    //     // Kirim notifikasi kepada peserta
    //     // Mail::to($berkas->tim->ketua->email)->send(new RevisiBerkasMail());
    //     return redirect()->route('document-verification.index')->with('error', 'Berkas ditolak, catatan telah dikirim');
    // }
}
