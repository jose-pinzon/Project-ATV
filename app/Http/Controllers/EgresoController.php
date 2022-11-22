<?php

namespace App\Http\Controllers;

use App\Http\Resources\EgresoResource;
use App\Models\Egreso;
use App\Models\Ingreso;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Svg\Tag\Path;

use function PHPUnit\Framework\isNull;

class EgresoController extends Controller
{

    public function generarPdf(Request $request){
        $Date1 = $request['fecha1'];
        $Date2 = $request['fecha2'];

        if( $Date1  == NULL|| $Date2 == NULL){
            $ingresos = Ingreso::all();
            $egresos = Egreso::all();
            $Date1 = '';
            $Date2 = '';
        }else{
            $ingresos = Ingreso::whereDate('fecha_hora', '>=' , $Date1)
            ->whereDate('fecha_hora','<=', $Date2 )
            ->get();

            $egresos = Egreso::whereDate('fecha','>=', $Date1)
            ->whereDate('fecha','<=', $Date2 )
            ->get();
        }

        $gastoTotal=0;
        $ingreso=0;

        foreach ($egresos as $egre) {
            $gastoTotal += $egre->cantidad;
        }

        foreach ($ingresos as $ingre) {
            $ingreso += $ingre->total;
        }

        $Ganancias = $ingreso - $gastoTotal;
        $date = Carbon::parse($Date1);
        $date->isoFormat('dddd D');


        $pdf = PDF::loadView('sistema.vistas.Egresos.generar-pdf', compact('date','egresos','gastoTotal','Date1','Date2','ingreso','Ganancias'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('ejemplo.pdf');

    }


    public function datosCompletosEgresos(){
        $egresos = EgresoResource::collection(Egreso::with('moto')->get());
        return Response()->json($egresos, 202);
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
        while ($pagina == null) {
            $pagina = 5;
        }

        $startdate = $request['inicio_fecha'];
        $enddate = $request['fin_fecha'];
        $enrutador = $request['enrutador'];

        if( $enrutador == 0){
            $egresos = EgresoResource::collection(Egreso::with(['moto'])
            ->orderBy('id', 'DESC')
            ->paginate($pagina));
        }else{
            $egresos = EgresoResource::collection(Egreso::with(['moto'])
            ->orderBy('id', 'DESC')
            ->whereDate('fecha','>=', $startdate)
            ->whereDate('fecha','<=', $enddate )
            ->paginate($pagina));
        }


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
            'moto_id' => 'required',
            'fecha' => 'required'
        ]);


        Egreso::create([
            'tipo_gasto' => $data['tipo_gasto'],
            'gasto' => $data['gasto'],
            'cantidad' => $data['cantidad'],
            'moto_id' => $data['moto_id'],
            'fecha' => $data['fecha']
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
        $egreso->delete();
        return response()->json(['message'=>'se elimino correctemente']);
    }
}
