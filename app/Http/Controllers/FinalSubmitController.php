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
        $tim = TimLomba::where('id_ketua', Auth::id())->first();

        $berkas = BerkasLomba::where('id_tim', $tim->id)->first();
       
        if ($berkas->status_verifikasi == 'valid') {
            $tim->update(['status_final_submit' => 1]);
        }else{
            return redirect()->back()->with('error', 'Semua dokumen harus diunggah sebelum melakukan Final Submit.');            
        }
        

        return redirect()->route('final.submit.index')->with('success', 'Final Submit berhasil. Data tidak bisa diubah lagi.');
    }
}
