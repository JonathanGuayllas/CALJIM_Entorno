<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre_completo',
        'email',
        'password',
        'rol',
        'cedula_ruc',
        'telefono',
        'direccion',
        'licencia_conducir',
        'tarifa_hora',
        'estado',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'estado' => 'boolean',
            'tarifa_hora' => 'decimal:2',
        ];
    }
}

