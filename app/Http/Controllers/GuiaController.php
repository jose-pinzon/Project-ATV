<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guia;

class GuiaController extends Controller
{
    //
    public function returnvista(){
        return view('sistema.vistas.Guias.guias');

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

           $guias = Guia::select('id_guia','nombres','apellidos','telefono','email','edad','direccion','ingles','estado')
           ->orderBy('id_guia','DESC')->paginate(5);

       }else{
      
            $guias = Guia::select('id_guia','nombres','apellidos','telefono','email','edad','direccion','ingles','estado')
            ->where($criterio, 'like','%' . $buscar . '%')
            ->orderBy('id_guia','DESC')->paginate(5);
   
       }
   
       //retornar propiedades
       return [
           'pagination' => [
               //propiedades de aginations
               'total'        => $guias->total(),
               'current_page' => $guias->currentPage(),
               'per_page'     => $guias->perPage(),
               'last_page'    => $guias->lastPage(),
               'from'         => $guias->firstItem(),
               'to'           => $guias->lastItem(),
           ],
           'guias'=> $guias
       ];
   }


   public function store(Request $request)
   {
       $guia = new Guia();
       $guia->nombres = $request->get('nombres');
       $guia->apellidos = $request->get('apellidos');
       $guia->telefono = $request->get('telefono');
       $guia->edad = $request->get('edad');
       $guia->email = $request->get('email');
       $guia->direccion = $request->get('direccion');
       $guia->ingles = $request->get('ingles');
       $guia->estado = '1';
       $guia->save();
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
       $guia = Guia::findOrFail($request->id_guia);
       $guia->nombres = $request->get('nombres');
       $guia->apellidos = $request->get('apellidos');
       $guia->telefono = $request->get('telefono');
       $guia->edad = $request->get('edad');
       $guia->email = $request->get('email');
       $guia->direccion = $request->get('direccion');
       $guia->ingles = $request->get('ingles');
       $guia->estado = '1';
       $guia->update();
   }

   public function activar(Request $request)
   {
       $guia = Guia::findOrFail($request->id_guia);
       $guia->estado = '1';
       $guia->update();
   }

   public function desactivar(Request $request)
   {
    $guia = Guia::findOrFail($request->id_guia);
    $guia->estado = '0';
    $guia->update();
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
