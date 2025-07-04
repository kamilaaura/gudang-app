<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens; // ⬅️ Tambahkan ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // ⬅️ Tambahkan HasApiTokens di sini

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }

    /** @use HasFactory<\Database\Factories\UserFactory> */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
