<?php

namespace App\Http\Controllers;

use App\Models\PembayaranLomba;
use Illuminate\Http\Request;

class PaymentManagementController extends Controller
{
    // Menampilkan daftar pembayaran yang telah diunggah
    public function index()
    {
        $pembayaran = PembayaranLomba::with('tim')->get();
        return view('payment-management.index', compact('pembayaran'));
    }

    // Memverifikasi bukti pembayaran
    
    public function update(Request $request, $id)
    {
        $berkas = PembayaranLomba::findOrFail($id);
        // Memastikan ada status yang dikirimkan dalam request
        $status = $request->input('status');


        // Mengecek apakah status yang diterima valid
        if ($status && in_array($status, ['valid', 'rejected'])) {
            // Mengupdate status berkas
            $berkas->status_verifikasi = $status;
            $berkas->save();

            // Menampilkan pesan sukses
            return redirect()->route('payment-management.index')->with('success', 'Status berkas berhasil diperbarui!');
        }
        // Jika tidak ada status atau status tidak valid
        return redirect()->route('payment-management.index')->with('error', 'Terjadi kesalahan dalam memperbarui status berkas.');
    }
}
