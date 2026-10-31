<?php

use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InicioController::class, 'index'])->name('inicio');
Route::get('/comprobante-pdf', [InicioController::class, 'comprobantePdf'])->name('comprobante.pdf');
