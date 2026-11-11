<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Ejecuta el script oficial de las 12 tablas de CALJIM.
     */
    public function up(): void
    {
        $sqlPath = database_path('caljim_db.sql');
        if (File::exists($sqlPath)) {
            DB::unprepared(File::get($sqlPath));
        }
    }

    /**
     * Elimina las 12 tablas en orden inverso de llaves foráneas.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $tablas = [
            'mensajes_internos',
            'liquidaciones_nomina',
            'jornadas_laborales',
            'facturas',
            'ubicaciones_gps',
            'detalle_pedido_maquinarias',
            'detalle_pedido_materiales',
            'pedidos',
            'mantenimientos',
            'maquinarias',
            'materiales',
            'usuarios',
        ];
        foreach ($tablas as $tabla) {
            DB::statement("DROP TABLE IF EXISTS {$tabla}");
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};

