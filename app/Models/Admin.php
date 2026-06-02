<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Le guard utilisé pour l'auth
    protected $guard = 'admin';

    // Champs mass assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Champs cachés pour le JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
