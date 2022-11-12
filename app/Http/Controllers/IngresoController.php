<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IngresoController extends Controller
{
    public function returnVista(){
        return view('sistema.vistas.Ingresos.ingresos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //seguridad
       //if(!$request->ajax()) return redirect('/');
       //integracion de carbon
       $date = Carbon::now();
       //fecha actual
       $date = $date->format('Y-m-d');

        $ingresos = Ingreso::join('detalle_reservas','ingresos.id_detalle_reserva', '=', 'detalle_reservas.id_detalle_reserva')
        ->join('reservas','detalle_reservas.id_reserva','=','reservas.id_reserva')
        ->select('ingresos.fecha_hora','ingresos.descripcion','ingresos.cantidad','ingresos.forma_pago','ingresos.mov_banco',
        'ingresos.pago_unitario','ingresos.total','reservas.slug')
        ->where('ingresos.fecha_hora','=', $date)
        ->orderBy('ingresos.fecha_hora','DESC')->paginate(100);

       //retornar propiedades
       return [
           'pagination' => [
               //propiedades de aginations
               'total'        => $ingresos->total(),
               'current_page' => $ingresos->currentPage(),
               'per_page'     => $ingresos->perPage(),
               'last_page'    => $ingresos->lastPage(),
               'from'         => $ingresos->firstItem(),
               'to'           => $ingresos->lastItem(),
           ],
           'ingresos'=> $ingresos
       ];
   
    }

    public function allIngresos(){
        $ingresos = Ingreso::join('detalle_reservas','ingresos.id_detalle_reserva', '=', 'detalle_reservas.id_detalle_reserva')
        ->join('reservas','detalle_reservas.id_reserva','=','reservas.id_reserva')
        ->select('ingresos.fecha_hora','ingresos.descripcion','ingresos.cantidad','ingresos.forma_pago','ingresos.mov_banco',
        'ingresos.pago_unitario','ingresos.total','reservas.slug')
        ->orderBy('ingresos.fecha_hora','DESC')->paginate(10);

       //retornar propiedades
       return [
           'pagination' => [
               //propiedades de aginations
               'total'        => $ingresos->total(),
               'current_page' => $ingresos->currentPage(),
               'per_page'     => $ingresos->perPage(),
               'last_page'    => $ingresos->lastPage(),
               'from'         => $ingresos->firstItem(),
               'to'           => $ingresos->lastItem(),
           ],
           'ingresos'=> $ingresos
       ];
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
