<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranLomba extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_lomba';
    protected $fillable = ['id_tim', 'bukti_pembayaran', 'status_verifikasi'];

    public function tim()
    {
        return $this->belongsTo(TimLomba::class, 'id_tim');
    }
}