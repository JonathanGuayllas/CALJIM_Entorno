<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';

    protected $fillable = [
        'nombre',
        'unidad',
        'precio_m3',
        'stock_m3',
    ];

    /**
     * Datos iniciales de demostración para el Hola Mundo MVC (RF-01, RF-02)
     */
    public static function catalogoDemo(): array
    {
        return [
            ['codigo' => 'AR-01', 'nombre' => 'Arena Lavada Fina', 'precio_m3' => 14.50, 'stock_m3' => 320, 'estado' => 'Disponible'],
            ['codigo' => 'AR-02', 'nombre' => 'Ripio Triturado 3/4"', 'precio_m3' => 16.00, 'stock_m3' => 210, 'estado' => 'Disponible'],
            ['codigo' => 'AR-03', 'nombre' => 'Sub-base Vial Clase 1', 'precio_m3' => 12.75, 'stock_m3' => 450, 'estado' => 'Disponible'],
        ];
    }
}

