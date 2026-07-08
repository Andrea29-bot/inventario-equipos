<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;

Route::redirect('/', '/equipos');

Route::resource('equipos', EquipoController::class);
Route::post('/equipos/{equipo}/urgente', [EquipoController::class, 'marcarUrgente'])->name('equipos.urgente');
