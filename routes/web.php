<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

// 1. Pantalla Principal + Modal de Logueo y Registro de CALJIM (Diseño Figma)
Route::get('/', [AuthController::class, 'showLogin'])->name('inicio');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');
Route::post('/recuperar-codigo', [AuthController::class, 'sendResetCode'])->name('password.code.post');
Route::post('/recuperar-verificar', [AuthController::class, 'verifyResetCode'])->name('password.verify.post');
Route::post('/recuperar-password', [AuthController::class, 'resetPassword'])->name('password.reset.post');
Route::get('/recuperar-reiniciar', [AuthController::class, 'restartReset'])->name('password.restart');
Route::get('/captcha', [AuthController::class, 'captcha'])->name('captcha.svg');
Route::get('/demo-login/{perfil}', [AuthController::class, 'demoLogin'])->name('login.demo');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Módulo 1: Materiales e Inventario (RF-01, RF-02) protegido por sesión autenticada
Route::middleware('auth')->group(function () {
    Route::get('/inventario', [MaterialController::class, 'index'])->name('inventario.index');
    Route::post('/inventario', [MaterialController::class, 'store'])->name('inventario.store');
    Route::put('/inventario/{material}', [MaterialController::class, 'update'])->name('inventario.update');
    Route::delete('/inventario/{material}', [MaterialController::class, 'destroy'])->name('inventario.destroy');
});
