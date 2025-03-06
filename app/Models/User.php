<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_code', // Tambahkan ini karena ada di tabel
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_code', // Menyembunyikan kode 2FA agar tidak terbuka secara default
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Generate a new two-factor authentication code.
     */
    public function generateTwoFactorCode()
    {
        $this->two_factor_code = rand(100000, 999999);
        $this->save();
    }

    /**
     * Reset the two-factor authentication code.
     */
    public function resetTwoFactorCode()
    {
        $this->two_factor_code = null;
        $this->save();
    }
}
