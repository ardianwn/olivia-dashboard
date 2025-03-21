<?php

namespace App\Exports;

use App\Models\TimLomba;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TimLombaExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TimLomba::with('kategori')->get()->map(function($tim) {
            return [
                $tim->nama_tim,
                $tim->nama_kampus,
                $tim->kategori->nama_kategori,
            ];
        });
    }

    /**
     * Mendefinisikan judul kolom pada file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nama Tim',
            'Asal Kampus',
            'Kategori Lomba',
        ];
    }
}
