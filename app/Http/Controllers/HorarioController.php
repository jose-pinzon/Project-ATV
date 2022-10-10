<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Horario;

class HorarioController extends Controller
{
    //
    public function returnvista(){
        return view('sistema.vistas.Horarios.horarios');

    }

    public function index(){
        $horarios = Horario::all();
        return $horarios;
    }

    public function store(Request $request){
        $horario = new Horario;
        $horario->start = $request->get('start');
        $horario->end = $request->get('end');
        $horario->estado = '1';
        $horario->save();
    }

    public function update(Request $request){
        $horario = Horario::findOrFail($request->id_horario);
        $horario->start = $request->get('start');
        $horario->end = $request->get('end');
        $horario->estado = '1';
        $horario->update();
    }

    public function activar(Request $request)
   {
       $horario = Horario::findOrFail($request->id_horario);
       $horario->estado = '1';
       $horario->update();
   }

   public function desactivar(Request $request)
   {
    $horario = Horario::findOrFail($request->id_horario);
    $horario->estado = '0';
    $horario->update();
   }
}
