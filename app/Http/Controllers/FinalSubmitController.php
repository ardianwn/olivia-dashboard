<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimLomba;
use App\Models\BerkasLomba;
use App\Models\PembayaranLomba;
use App\Models\DetilPeserta;
use Illuminate\Support\Facades\Auth;

class FinalSubmitController extends Controller
{
    public function index()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->firstOrFail();
        $anggota = DetilPeserta::where('id_tim', $tim->id)->get();
        $berkas = BerkasLomba::where('id_tim', $tim->id)->get();
        $pembayaran = PembayaranLomba::where('id_tim', $tim->id)->first();

        return view('final_submit.index', compact('tim', 'anggota', 'berkas', 'pembayaran'));
    }

    public function submitFinal()
    {
        $tim = TimLomba::where('id_ketua', Auth::id())->firstOrFail();

        // Cek apakah semua berkas sudah diupload sebelum final submit
        $berkasCount = BerkasLomba::where('id_tim', $tim->id)->count();
        $pembayaran = PembayaranLomba::where('id_tim', $tim->id)->first();

        if ($berkasCount == 0 || !$pembayaran) {
            return redirect()->back()->with('error', 'Semua dokumen harus diunggah sebelum melakukan Final Submit.');
        }

        $tim->update(['final_submit' => true]);

        return redirect()->route('final.submit.index')->with('success', 'Final Submit berhasil. Data tidak bisa diubah lagi.');
    }
}
