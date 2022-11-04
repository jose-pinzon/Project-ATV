<?php

namespace App\Http\Controllers;

use App\Http\Resources\EgresoResource;
use App\Models\Egreso;
use App\Models\Motos;
use Illuminate\Http\Request;

class EgresoController extends Controller
{
    public function datosCompletosEgresos(){
        $egresos = EgresoResource::collection(Egreso::with('moto')->get());
        return Response()->json($egresos, 200);
    }

    public function vista(){
        return view('sistema.vistas.Egresos.DatosEgresos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagina = intval($request['num_filas']);

        if ($pagina == null) {
            $pagina = 4 ;
        }

        $egresos = EgresoResource::collection(Egreso::with(['moto'])->orderBy('id', 'DESC')->paginate($pagina));

        return[
            'pagina' => $pagina,
            'pagination' => [
                'total' => $egresos->total(),
                'current_page' => $egresos->currentPage(),/* Pagina actual */
                'per_page' => $egresos->perPage(),
                'last_page' => $egresos->lastPage(),
                'from' => $egresos->firstItem(),
                'to' => $egresos->lastPage()
            ],
            'egresos' => $egresos
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.vistas.Egresos.agregarEgreso');
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
            'tipo_gasto' => 'required',
            'gasto' => 'required',
            'cantidad' => 'required|min:2',
            'moto_id' => 'required'
        ]);


        Egreso::create([
            'tipo_gasto' => $data['tipo_gasto'],
            'gasto' => $data['gasto'],
            'cantidad' => $data['cantidad'],
            'moto_id' => $data['moto_id'],
        ]);

        return response()->json(['message'=> 'Moto guardado con exito' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function show(Egreso $egreso)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function edit(Egreso $egreso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Egreso $egreso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Egreso  $egreso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Egreso $egreso)
    {
        //
    }
}
