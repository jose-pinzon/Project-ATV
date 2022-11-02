<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mpdf\Mpdf;

use App\Models\Ingreso;

class PdfIngresoController extends Controller
{
  
    public function PdfRango(Request $request, $accion="descargar"){

        $fechas = [
            'fecha_inicial'=>$request->fecha_1,
            'fecha_final'=>$request->fecha_2
        ];

        $IngresosAll = Ingreso::where("fecha_hora",">=",$request->fecha_1)
        ->where("fecha_hora","<=",$request->fecha_2)
        ->select('ingresos.fecha_hora','ingresos.descripcion','ingresos.cantidad','ingresos.forma_pago','ingresos.mov_banco',
        'ingresos.pago_unitario','ingresos.total')
        ->get();

        //sacar total
        $total = 0;

        for ($i=0; $i < count($IngresosAll); $i++) { 
            $total += $IngresosAll[$i]->total;
        }

        if($accion=='html'){
            return view('sistema.vistas.Ingresos.PdfIngresoall', compact('fechas','IngresosAll','total'));
        }else{
            $html = view('sistema.vistas.Ingresos.PdfIngresoall',compact('fechas','IngresosAll','total'))->render();
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
