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
    public function verify(Request $request, $id)
    {
        $pembayaran = PembayaranLomba::findOrFail($id);
        $pembayaran->update(['status_verifikasi' => 'Sudah Bayar']);
        return redirect()->route('payment-management.index')->with('success', 'Pembayaran telah diverifikasi');
    }

    // Menolak pembayaran dan memberi alasan
    public function reject(Request $request, $id)
    {
        $pembayaran = PembayaranLomba::findOrFail($id);
        $pembayaran->update(['status_verifikasi' => 'Belum Bayar', 'alasan_penolakan' => $request->alasan]);
        return redirect()->route('payment-management.index')->with('error', 'Pembayaran ditolak, alasan telah dikirim');
    }
}
