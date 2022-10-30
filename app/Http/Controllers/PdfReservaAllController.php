<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mpdf\Mpdf;

use Carbon\Carbon;

use App\Models\Reserva;

use App\Models\Detalle_Reserva;

class PdfReservaAllController extends Controller
{
    public function PdfRango(Request $request, $accion="descargar"){

        $fechas = [
            'fecha_inicial'=>$request->fecha_1,
            'fecha_final'=>$request->fecha_2
        ];

        $reservasAll = Reserva::where("fecha_reserva",">=",$request->fecha_1)
        ->where("fecha_reserva","<=",$request->fecha_2)
        ->join('clientes', 'reservas.id_cliente','=','clientes.id_cliente')
        ->join('detalle_reservas', 'reservas.id_reserva','=','detalle_reservas.id_reserva')
        ->select('reservas.fecha_reserva','clientes.nombres','clientes.apellidos','detalle_reservas.sencillo'
        ,'detalle_reservas.precio_sencillo', 'detalle_reservas.doble','detalle_reservas.precio_doble',
        'detalle_reservas.descuento','detalle_reservas.total')
        ->get();

        //sacar total
        $total = 0;

        for ($i=0; $i < count($reservasAll); $i++) { 
            $total += $reservasAll[$i]->total;
        }

        if($accion=='html'){
            return view('sistema.vistas.Reservas.PdfReservaall', compact('fechas','reservasAll','total'));
        }else{
            $html = view('sistema.vistas.Reservas.PdfReservaall',compact('fechas','reservasAll','total'))->render();
        }
        $namefile = 'reporteMesual'.time().'.pdf';
 
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
 
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new Mpdf([
            'fontDir' => array_merge($fontDirs, [
                public_path() . '/fonts',
            ]),
            'default_font' => 'arial',
          
        ]);
       
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);
        // dd($mpdf);

        if($accion=='descargar'){
            //descargar
             $mpdf->Output($namefile,"D");
            //ver
             //$mpdf->Output($namefile,"I");
        }
        
               
    }
}
