<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuiaController extends Controller
{
    //
    public function returnvista(){
        return view('sistema.vistas.Guias.guias');

    }
}
