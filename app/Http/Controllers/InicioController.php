<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    /**
     * Muestra la vista principal "Hola Mundo" con diagnóstico del entorno MVC.
     */
    public function index()
    {
        $dbConectada = false;
        $dbMensaje = '';
        $motorVersion = 'No conectado';

        try {
            $pdo = DB::connection()->getPdo();
            $dbConectada = true;
            $motorVersion = $pdo->getAttribute(\PDO::ATTR_SERVER_VERSION);
            $dbMensaje = 'Conexión exitosa a MySQL/MariaDB (' . config('database.connections.mysql.database') . ')';
        } catch (\Throwable $e) {
            $dbConectada = false;
            $dbMensaje = $e->getMessage();
        }

        $materiales = Material::catalogoDemo();

        $equipo = [
            'Jonathan Guayllas',
            'Fabian Cañar',
            'Alfonso Ocampo',
        ];

        return view('inicio', [
            'titulo' => '¡Hola Mundo desde CALJIM con Laravel 11 (MVC)!',
            'phpVersion' => PHP_VERSION,
            'laravelVersion' => app()->version(),
            'dbConectada' => $dbConectada,
            'dbMensaje' => $dbMensaje,
            'motorVersion' => $motorVersion,
            'materiales' => $materiales,
            'equipo' => $equipo,
        ]);
    }

    /**
     * Genera un comprobante PDF de prueba usando DomPDF (RF-11).
     */
    public function comprobantePdf()
    {
        $materiales = Material::catalogoDemo();
        $pdf = Pdf::loadView('pdf.comprobante', [
            'fecha' => now()->format('d/m/Y H:i'),
            'materiales' => $materiales,
        ]);

        return $pdf->stream('comprobante-hola-mundo-caljim.pdf');
    }
}

