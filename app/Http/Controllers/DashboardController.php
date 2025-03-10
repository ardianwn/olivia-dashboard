<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TimLomba;
use App\Models\DetilPeserta;
use App\Models\BerkasLomba;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data tim yang dimiliki oleh user yang login
        $tim = TimLomba::where('id_ketua', Auth::id())->first();

        // Jika tim sudah terdaftar, ambil juga data anggota dan berkasnya
        $anggota = $tim ? DetilPeserta::where('id_tim', $tim->id)->get() : collect([]);
        $berkas = $tim ? BerkasLomba::where('id_tim', $tim->id)->get() : collect([]);

        return view('dashboard', compact('tim', 'anggota', 'berkas'));
    }
}
