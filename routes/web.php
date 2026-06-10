<?php

use App\Http\Controllers\ComunidadeController;
use App\Http\Controllers\ComunidadesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\UsuarioController;
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

Route::get('/', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.inicio');
    Route::get('/usuario/comunidades', [UsuarioController::class, 'comunidades'])->name('usuario.comunidades');
    Route::post('/usuario/comunidades/{grupo}/participar', [UsuarioController::class, 'participar'])->name('usuario.comunidades.participar');
    Route::get('/comunidade/{grupo}', [ComunidadeController::class, 'show'])->name('comunidade');
    Route::post('/comunidade/{grupo}/publicacoes', [ComunidadeController::class, 'storePublicacao'])->name('publicacoes.store');
    Route::put('/publicacoes/{publicacao}', [ComunidadeController::class, 'updatePublicacao'])->name('publicacoes.update');

    Route::middleware('admin')->group(function () {
        Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

        Route::get('/comunidades', [ComunidadesController::class, 'index'])->name('comunidades');
        Route::post('/comunidades', [ComunidadesController::class, 'store'])->name('comunidades.store');

        Route::put('/comunidade/{grupo}', [ComunidadeController::class, 'update'])->name('comunidade.update');
        Route::delete('/comunidade/{grupo}', [ComunidadeController::class, 'destroy'])->name('comunidade.destroy');
    });
});
