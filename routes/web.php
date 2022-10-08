<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


//modulo clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'returnvista'])->name('clientes');
Route::get('/clients', [App\Http\Controllers\ClienteController::class, 'index'])->name('cients');
Route::post('/clients/store', [App\Http\Controllers\ClienteController::class, 'store'])->name('cients/store');
Route::put('/clients/update', [App\Http\Controllers\ClienteController::class, 'update'])->name('cients/update');
Auth::routes();

//modulo de guias
Route::get('/guias', [App\Http\Controllers\GuiaController::class, 'returnvista'])->name('guias');
Route::get('/guias/index', [App\Http\Controllers\GuiaController::class, 'index'])->name('guias/index');
Route::post('/guias/store', [App\Http\Controllers\GuiaController::class, 'store'])->name('guias/store');
Route::put('/guias/update', [App\Http\Controllers\GuiaController::class, 'update'])->name('guias/update');
Route::put('/guias/activar', [App\Http\Controllers\GuiaController::class, 'activar'])->name('/guias/activar');
Route::put('/guias/desactivar', [App\Http\Controllers\GuiaController::class, 'desactivar'])->name('guias/desactivar');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/egresos', [App\Http\Controllers\EgresosController ::class, 'index'])->name('egresos.index');