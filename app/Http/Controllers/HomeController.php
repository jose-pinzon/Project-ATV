<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\Ingreso;
use App\Models\Motos;
use App\Models\Reserva;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //integracion de carbon
        $date = Carbon::now();
        //fecha actual
        $date = $date->format('Y-m-d');

        $num_atv = count(  Motos::all());
        $reservas =  Reserva::where('estado','=','PENDIENTE')->count();
        $reservasHoy = Reserva::join('clientes','reservas.id_cliente','=','clientes.id_cliente')
        ->join('horarios','reservas.id_horario','=','horarios.id_horario')
        ->select('clientes.nombres','clientes.apellidos','horarios.start','horarios.end')
        ->where('reservas.estado','=','PENDIENTE','and')->where('reservas.fecha_reserva','=',$date)->get();
        $clientes = count(Cliente::all());
        return view('sistema.vistas.escritorio.escritorio', compact('num_atv','reservas','clientes','reservasHoy'));
    }

    public function egresosPorYear(){
        $date = Carbon::now();
        $year = $date->year;

        $egresos = Egreso::whereYear('fecha',$year)->get();
        $ingreso = Ingreso::whereYear('fecha_hora',$year)->get();

        return response()->json([ $egresos,$ingreso], 200);
    }
}
