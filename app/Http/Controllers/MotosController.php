<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use Illuminate\Http\Request;

class MotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motos = Motos::all();
        return response()->json( $motos, 200 );
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
        Motos::create([
            'numero_Atv' => $request['numero_Atv'],
            'max_velocidad' => $request['max_velocidad'],
            'placa' => $request['placa'],
            'num_serie' => $request['num_serie'],
            'num_motor' => $request['num_motor'],
            'propietario' => $request[ 'propietario'],
            'marca' => $request[ 'marca'],
            'modelo' => $request['modelo'],
            'color' => $request['color']
        ]);

        return response()->json(['message' => 'Moto guardado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motos  $motos
     * @return \Illuminate\Http\Response
     */
    public function show(Motos $motos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motos  $motos
     * @return \Illuminate\Http\Response
     */
    public function edit(Motos $motos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motos  $motos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motos $motos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motos  $motos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motos $motos)
    {
        //
    }
}
