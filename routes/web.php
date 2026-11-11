<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. Pantalla Principal + Modal de Logueo y Registro de CALJIM (Diseño Figma)
Route::get('/', [AuthController::class, 'showLogin'])->name('inicio');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');
Route::get('/demo-login/{perfil}', [AuthController::class, 'demoLogin'])->name('login.demo');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
