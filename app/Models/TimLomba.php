<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimLomba extends Model
{
    use HasFactory;

    protected $table = 'tim_lomba';
    protected $fillable = [
        'nama_tim',
        'nama_kampus',
        'cabang_lomba',
        'foto_tim',
        'status_verifikasi',
        'status_final_submit',
        'id_ketua'
    ];

    public function anggota()
    {
        return $this->hasMany(DetilPeserta::class, 'id_tim');
    }

    public function berkas()
    {
        return $this->hasMany(BerkasLomba::class, 'id_tim');
    }

    public function pembayaran()
    {
        return $this->hasOne(PembayaranLomba::class, 'id_tim');
    }
}
