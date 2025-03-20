<?php

namespace App\Http\Controllers;

use App\Models\TimLomba;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TimLombaExport;
use illuminate\Http\Request;


class ReportController extends Controller
{
    // Menampilkan laporan pendaftaran lomba
    public function index()
    {
        $timLomba = TimLomba::All();
        return view('report.index', compact('timLomba'));
    }

    // Mengunduh laporan dalam format Excel
    public function export()
    {
        return Excel::download(new TimLombaExport, 'tim_lomba.xlsx');
    }

    // Filter laporan berdasarkan kategori lomba
    public function filter(Request $request)
    {
        $kategori = $request->kategori;
        $timLomba = TimLomba::where('cabang_lomba', $kategori)->get();
        return view('report.index', compact('timLomba'));
    }
}
