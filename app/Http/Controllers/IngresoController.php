<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hora_fecha = Carbon::now('America/Mexico_City');

        $ingreso = new Ingreso();
        $ingreso->fecha_hora = $hora_fecha->toDateString();
        $ingreso->descripcion = $request->descripcion;
        $ingreso->cantidad = $request->cantidad;
        $ingreso->forma_pago = $request->forma_pago;
        $ingreso->mov_banco = $request->mov_banco;
        $ingreso->pago_unitario = $request->pago_unitario;
        $ingreso->total = $request->total;
        $ingreso->id_detalle_reserva = $request->id_detalle_reserva;
        $ingreso->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function show(Ingreso $ingreso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingreso $ingreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingreso $ingreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingreso  $ingreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingreso $ingreso)
    {
        //
    }
}
