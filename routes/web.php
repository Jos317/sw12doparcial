<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagramaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showWeb']);

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('prueba-pusher', [DashboardController::class, 'prueba_pusher']);

        Route::get('diagramas', [DiagramaController::class, 'index']);
        Route::get('diagrama/create', [DiagramaController::class, 'create']);
        Route::post('diagrama/store', [DiagramaController::class, 'store']);
        Route::get('diagrama/edit/{id}', [DiagramaController::class, 'edit']);
        Route::post('diagrama/update', [DiagramaController::class, 'update']);
        Route::get('diagrama/usuarios/{id}', [DiagramaController::class, 'usuario']);
        Route::get('diagrama/usuarios/banear/{id}/{diagrama_id}', [DiagramaController::class, 'banear']);
        Route::get('diagrama/usuarios/invitar/{id}/{diagrama_id}', [DiagramaController::class, 'invitar']);
        Route::get('diagramar/{id}', [DiagramaController::class, 'diagramar']);
        Route::post('diagramas/guardar', [DiagramaController::class, 'guardar']);
        Route::get('diagrama/generarScriptForPostgreSQL/{id}', [DiagramaController::class, 'generarScriptForPostgreSQL']);
        Route::get('diagrama/generarScriptForSQLServer/{id}', [DiagramaController::class, 'generarScriptForSQLServer']);
        Route::get('diagrama/generarScriptForSQLite/{id}', [DiagramaController::class, 'generarScriptForSQLite']);
        Route::get('diagrama/generarScriptForVista/{id}', [DiagramaController::class, 'generarScriptForVista']);
        Route::get('diagrama/descargar/{id}', [DiagramaController::class, 'descargar']);
    });
// });