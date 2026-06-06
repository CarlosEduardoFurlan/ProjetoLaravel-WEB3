<?php

use App\Http\Controllers\ComunidadeController;
use App\Http\Controllers\ComunidadesController;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

Route::get('/comunidades', [ComunidadesController::class, 'index'])->name('comunidades');

Route::get('/comunidade', [ComunidadeController::class, 'index'])->name('comunidade');

