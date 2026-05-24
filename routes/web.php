<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicoController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EquipoController;
use App\Http\Controllers\Admin\JugadorController;
use App\Http\Controllers\Admin\PartidoController;
use App\Http\Controllers\Admin\NoticiaController;

// ==========================================
// RUTAS PÚBLICAS (cualquiera puede verlas)
// ==========================================
Route::get('/', [PublicoController::class, 'inicio'])->name('inicio');
Route::get('/equipos', [PublicoController::class, 'equipos'])->name('equipos');
Route::get('/equipos/{id}', [PublicoController::class, 'equipoDetalle'])->name('equipo.detalle');
Route::get('/calendario', [PublicoController::class, 'calendario'])->name('calendario');
Route::get('/estadisticas/{id_partido}', [PublicoController::class, 'estadisticas'])->name('estadisticas');

// ==========================================
// RUTAS DE LOGIN
// ==========================================
Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// ==========================================
// RUTAS DEL PANEL ADMIN (protegidas)
// ==========================================
Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Equipos
    Route::resource('equipos', EquipoController::class);

    // Jugadores
    Route::resource('jugadores', JugadorController::class);

    // Partidos
    Route::resource('partidos', PartidoController::class);

    // Noticias
    Route::resource('noticias', NoticiaController::class);
});