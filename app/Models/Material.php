<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'imagen_url',
        'precio_m3',
        'stock_m3',
        'stock_minimo_m3',
        'disponible',
    ];

    protected function casts(): array
    {
        return [
            'precio_m3' => 'decimal:2',
            'stock_m3' => 'decimal:2',
            'stock_minimo_m3' => 'decimal:2',
            'disponible' => 'boolean',
        ];
    }
}
