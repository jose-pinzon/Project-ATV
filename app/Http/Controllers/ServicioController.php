<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    //

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
