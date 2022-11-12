<?php

use App\Http\Controllers\EgresoController;
use App\Http\Controllers\EgresoPorMotos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MotosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EgresosController;
use App\Http\Controllers\MotosController;
use App\Http\Controllers\TipoServicioController;

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


// Route::get('{any}', function () {
//     return view('layouts.app');
// })->where('any', '.*');

Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/Motos', [MotosController ::class, 'vistaMotos'])->name('moto.index');
    Route::get('/Motos/IngEgr', [MotosController ::class, 'EgresosIngMotos'])->name('moto.InEn');
    Route::get('/addegreso', [EgresoController::class, 'create'])->name('egreso.vista');

    Route::get('/Egresos', [EgresoController::class, 'vista'])->name('egreso.index');
    Route::get('/egresos/atv',[ EgresoPorMotos::class, 'index'])->name('egresoX.Moto');


});

