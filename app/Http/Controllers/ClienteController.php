<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;

class ClienteController extends Controller
{
    public function returnvista(){
        return view('sistema.vistas.Clientes.clientes');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //
    public function index(Request $request){
         //seguridad
        //if(!$request->ajax()) return redirect('/');
        //inputs request busqueda
        $criterio = $request->criterio;
        $buscar = $request->buscar;

        if($buscar==''){

            $clientes = Cliente::select('id_cliente','nombres','apellidos','telefono','email','nacionalidad','pais','ciudad')
            ->orderBy('id_cliente','DESC')->paginate(5);

        }else{
       
             $clientes = Cliente::select('id_cliente','nombres','apellidos','telefono','email','nacionalidad','pais','ciudad')
             ->where($criterio, 'like','%' . $buscar . '%')
             ->orderBy('id_cliente','DESC')->paginate(5);
    
        }
    
        //retornar propiedades
        return [
            'pagination' => [
                //propiedades de aginations
                'total'        => $clientes->total(),
                'current_page' => $clientes->currentPage(),
                'per_page'     => $clientes->perPage(),
                'last_page'    => $clientes->lastPage(),
                'from'         => $clientes->firstItem(),
                'to'           => $clientes->lastItem(),
            ],
            'clientes'=> $clientes
        ];
    }


    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombres = $request->get('nombres');
        $cliente->apellidos = $request->get('apellidos');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');
        $cliente->nacionalidad = $request->get('nacionalidad');
        $cliente->pais = $request->get('pais');
        $cliente->ciudad = $request->get('ciudad');
        $cliente->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function update(Request $request)
    {
        $cliente = Cliente::findOrFail($request->id_cliente);
        $cliente->nombres = $request->get('nombres');
        $cliente->apellidos = $request->get('apellidos');
        $cliente->telefono = $request->get('telefono');
        $cliente->email = $request->get('email');
        $cliente->nacionalidad = $request->get('nacionalidad');
        $cliente->pais = $request->get('pais');
        $cliente->ciudad = $request->get('ciudad');
        $cliente->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
