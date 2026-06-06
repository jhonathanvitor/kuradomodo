<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Método isAdmin para verificar se o usuário é administrador
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Método alternativo caso você queira verificar de múltiplas formas
    public function getIsAdminAttribute()
    {
        return $this->isAdmin();
    }
}
