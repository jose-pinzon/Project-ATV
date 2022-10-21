<?php

namespace App\Http\Controllers;

use App\Models\Motos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MotosController extends Controller
{


    public function vistaMotos(){
        return view('sistema.vistas.Egresos.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $motos = Motos::orderBy('id', 'DESC')->paginate(3);

        return[
            'pagination' => [
                'total' => $motos->total(),
                'current_page' => $motos->currentPage(),/* Pagina actual */
                'per_page' => $motos->perPage(),
                'last_page' => $motos->lastPage(),
                'from' => $motos->firstItem(),
                'to' => $motos->lastPage()
            ],
            'motos' => $motos
        ];
        // return response()->json( $motos, 200 );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $MotosAll = Motos::all();
        return Response()->json($MotosAll, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'numero_Atv' => 'required|unique:motos',
            'max_velocidad' => 'required',
            'placa' => 'required|min:6',
            'num_serie' => 'required',
            'num_motor' => 'required',
            'propietario' => 'required|min:4',
            'marca' => 'required',
            'modelo' => 'required',
            'color'  => 'required',
        ]);


        Motos::create([
            'numero_Atv' => $data['numero_Atv'],
            'max_velocidad' => $data['max_velocidad'],
            'placa' => $data['placa'],
            'num_serie' => $data['num_serie'],
            'num_motor' => $data['num_motor'],
            'propietario' => $data[ 'propietario'],
            'marca' => $data[ 'marca'],
            'modelo' => $data['modelo'],
            'color' => $data['color']
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
        $data = $request->validate([
            'numero_Atv' => 'required|max:150', Rule::unique('motos')->ignore($motos->id),
            'max_velocidad' => 'required',
            'placa' => 'required|min:6',
            'num_serie' => 'required',
            'num_motor' => 'required',
            'propietario' => 'required|min:4',
            'marca' => 'required',
            'modelo' => 'required',
            'color'  => 'required',
        ]);

        $motos->numero_Atv = $data['numero_Atv'];
        $motos->max_velocidad = $data['max_velocidad'];
        $motos->placa = $data['placa'];
        $motos->num_serie = $data['num_serie'];
        $motos->num_motor = $data['num_motor'];
        $motos->propietario = $data['propietario'];
        $motos->marca = $data['marca'];
        $motos->modelo = $data['modelo'];
        $motos->color = $data['color'];

        $motos->save();

        return response()->json(['message'=> 'se actualizo correctamente']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motos  $motos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motos $motos)
    {
        $motos->delete();

        return response()->json(['message'=> 'Moto eliminado correctamente']);
    }
}
