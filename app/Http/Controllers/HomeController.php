<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\Ingreso;
use App\Models\Motos;
use App\Models\Reserva;
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
        $num_atv = count(  Motos::all());
        $reservas = count( Reserva::all() );
        return view('sistema.vistas.escritorio.escritorio', compact('num_atv','reservas'));
    }

    public function egresosPorYear(){
        $date = Carbon::now();
        $year = $date->year;

        $egresos = Egreso::whereYear('fecha',$year)->get();
        $ingreso = Ingreso::whereYear('fecha_hora',$year)->get();

        return response()->json([ $egresos,$ingreso], 200);
    }
}
