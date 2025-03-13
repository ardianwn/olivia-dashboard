<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nim',
        'password',
        'role',
        'status',
        'profile',
        'ktm',
        'no_wa'
    ];

    // Tambahkan default value
    protected $attributes = [
        'role' => 'ketua_tim',
        'status' => 'register',
    ];
    public function timLomba()
    {
        return $this->hasOne(TimLomba::class, 'id_ketua');
    }
    public function tim()
    {
        return $this->hasOne(TimLomba::class, 'id_ketua');
    }
    public function tim_lomba()
{
    return $this->hasOne(TimLomba::class, 'id_ketua', 'id');
}

}
