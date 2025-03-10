<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaPengumuman extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari nama model
    protected $table = 'berita_pengumuman';

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'jenis',
        'judul',
        'isi',
        'writer', // ID penulis (admin atau ketua tim)
    ];

    // Tentukan relasi ke model User (penulis pengumuman)
    public function writer()
    {
        return $this->belongsTo(User::class, 'writer');
    }
}
