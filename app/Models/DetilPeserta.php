<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilPeserta extends Model
{
    use HasFactory;

    protected $table = 'detil_peserta';
    protected $fillable = [
        'nim',
        'nama_lengkap',
        'id_tim',
        'scan_ktm',
        'no_wa',
        'foto_anggota',
        'status_verifikasi'
    ];

    // Relasi ke Tim
    public function tim()
    {
        return $this->belongsTo(TimLomba::class, 'id_tim');
    }
}
