<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasLomba extends Model
{
    use HasFactory;

    protected $table = 'berkas_lomba';
    protected $fillable = ['id_tim', 'nama_file' , 'url_file', 'status_verifikasi'];

    public function tim()
    {
        return $this->belongsTo(TimLomba::class, 'id_tim');
    }
}

