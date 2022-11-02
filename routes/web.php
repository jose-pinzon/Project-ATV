<?php

use App\Http\Controllers\EgresoController;
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


Auth::routes();

Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/Motos', [MotosController ::class, 'vistaMotos'])->name('moto.index');
    Route::get('/addegreso', [EgresoController::class, 'create'])->name('egreso.vista');

    Route::get('/Egresos', [EgresoController::class, 'vista'])->name('egreso.index');

    
//modulo clientes
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'returnvista'])->name('clientes');
Route::get('/clients', [App\Http\Controllers\ClienteController::class, 'index'])->name('cients');
Route::post('/clients/store', [App\Http\Controllers\ClienteController::class, 'store'])->name('cients/store');
Route::put('/clients/update', [App\Http\Controllers\ClienteController::class, 'update'])->name('cients/update');
Route::get('/clients/select',[App\Http\Controllers\ClienteController::class,'selectCliente'])->name('clients/select');

//modulo de guias
Route::get('/guias', [App\Http\Controllers\GuiaController::class, 'returnvista'])->name('guias');
Route::get('/guias/index', [App\Http\Controllers\GuiaController::class, 'index'])->name('guias/index');
Route::post('/guias/store', [App\Http\Controllers\GuiaController::class, 'store'])->name('guias/store');
Route::put('/guias/update', [App\Http\Controllers\GuiaController::class, 'update'])->name('guias/update');
Route::put('/guias/activar', [App\Http\Controllers\GuiaController::class, 'activar'])->name('/guias/activar');
Route::put('/guias/desactivar', [App\Http\Controllers\GuiaController::class, 'desactivar'])->name('guias/desactivar');
Route::get('/guias/select',[App\Http\Controllers\GuiaController::class, 'guiasSelect'])->name('guias/select');
//modulo de horario
Route::get('/horarios', [App\Http\Controllers\HorarioController::class, 'returnvista'])->name('horarios');
Route::get('/horarios/index', [App\Http\Controllers\HorarioController::class, 'index'])->name('horarios/index');
Route::post('/horarios/store', [App\Http\Controllers\HorarioController::class, 'store'])->name('horarios/store');
Route::put('/horarios/update', [App\Http\Controllers\HorarioController::class, 'update'])->name('horarios/update');
Route::put('/horarios/activar', [App\Http\Controllers\HorarioController::class, 'activar'])->name('/horarios/activar');
Route::put('/horarios/desactivar', [App\Http\Controllers\HorarioController::class, 'desactivar'])->name('horarios/desactivar');
Route::get('/horarios/select', [App\Http\Controllers\HorarioController::class, 'selectHorarios'])->name('horarios/horarios');

//Modulo servicio
Route::get('/servicios',[App\Http\Controllers\ServicioController::class, 'returnVista'])->name('servicios');
Route::get('/servicios/index',[App\Http\Controllers\ServicioController::class, 'index'])->name('servicios/index');
Route::put('/servicios/update',[App\Http\Controllers\ServicioController::class, 'update'])->name('servicios/update');
Route::get('/capture/servicios', [App\Http\Controllers\ServicioController::class, 'servicios'])->name('capture/servicios');

//MODULO RESERVAS
Route::get('/reservas', [App\Http\Controllers\ReservaController::class, 'returnvista'])->name('reservas');
Route::get('/reservas/index', [App\Http\Controllers\ReservaController::class, 'index'])->name('reservas/index');
Route::get('/reservas/all', [App\Http\Controllers\ReservaController::class, 'AllReservas'])->name('reservas/all');
Route::post('/reservas/store', [App\Http\Controllers\ReservaController::class, 'StoreReserva'])->name('reservas/store');
Route::put('/reservas/update', [App\Http\Controllers\ReservaController::class, 'updateReserva'])->name('reservas/update');
Route::put('/reservas/updateEstado', [App\Http\Controllers\ReservaController::class, 'cambiarEstado'])->name('reservas/updateEstado');
Route::get('/reserva/reporte/{slug}', [App\Http\Controllers\PdfReservController::class, 'generarPdfReserva']);
Route::post('reservas/reporte/consulta', [App\Http\Controllers\PdfReservaAllController::class, 'PdfRango'])->name('reservas.pdf');
//modulo de ingresos
Route::get('ingresos',[App\Http\Controllers\IngresoController::class,'returnVista'])->name('ingresos');
Route::get('ingresos/index',[App\Http\Controllers\IngresoController::class,'index'])->name('ingresos.index');
Route::get('ingresos/all',[App\Http\Controllers\IngresoController::class,'allIngresos'])->name('ingresos.all');
Route::post('ingreso/store',[App\Http\Controllers\IngresoController::class, 'store'])->name('ingreso.store');
Route::post('ingresos/reporte/consulta', [App\Http\Controllers\PdfIngresoController::class, 'PdfRango'])->name('ingresos.pdf');


});

