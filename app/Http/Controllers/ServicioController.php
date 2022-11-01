<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    //
    public function returnVista(){
        return view('sistema.vistas.Servicios.servicios');
    }

    public function index(){
        $servicios = Servicio::all();

        return $servicios;
    }
    public function update(Request $request){
        $servicio = Servicio::findOrFail($request->id_servicio);
        $servicio->servicio = $request->servicio;
        $servicio->descripcion = $request->descripcion;
        $servicio->precio = $request->precio;
        $servicio->update();
    }
    //metodo que trae el servicio y su capturacion
   public function servicios(){
    
    $servicioSencillo = Servicio::where('id_servicio','=',1)->select('servicio','precio')->first();

    $servicioDoble = Servicio::where('id_servicio','=',2)->select('servicio','precio')->first();

        return [
            'serviciosSencillos'=> $servicioSencillo,
            'serviciosDobles'=>$servicioDoble
        ];

   }

}
