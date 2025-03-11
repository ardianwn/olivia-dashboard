<?php

namespace App\Exports;

use App\Models\TimLomba;
use Maatwebsite\Excel\Concerns\FromCollection;

class TimLombaExport implements FromCollection
{
    public function collection()
    {
        return TimLomba::all(); // Ambil semua data tim lomba
    }
}

