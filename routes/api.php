<?php

use App\Http\Controllers\EgresoController;
use App\Http\Controllers\Egresos;
use App\Http\Controllers\EgresosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/motoAtv',[ MotosController::class, 'store']);
Route::get('/motoAtv/{motos}',[ MotosController::class, 'show']);
Route::put('/motoAtv/{motos}',[ MotosController::class, 'update']);
Route::delete('/motoAtv/{motos}',[ MotosController::class, 'destroy']);
Route::apiResource('/motoAtv', MotosController::class);
Route::get('/motos',[ MotosController::class, 'create']);


Route::post('/egresoAtv',[ EgresoController::class, 'store']);
Route::get('/egresoAtv',[ EgresoController::class, 'index']);



