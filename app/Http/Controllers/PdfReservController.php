<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mpdf\Mpdf;

use Carbon\Carbon;

use App\Models\Reserva;

use App\Models\Detalle_Reserva;

class PdfReservController extends Controller
{
    public function index(){
        return view('sistema.vistas.Reservas.PdfReserva');
    }
    public function generarPdfReserva($slug, $accion="ver"){

        $reserva = Reserva::where('slug','=',$slug)
        ->join('detalle_reservas','reservas.id_reserva','=','detalle_reservas.id_reserva')
        ->join('horarios','reservas.id_horario','=','horarios.id_horario')
        ->join('clientes','reservas.id_cliente','=','clientes.id_cliente')
        ->select('reservas.id_reserva','reservas.slug','reservas.fecha_reserva','reservas.comentario',
        'detalle_reservas.sencillo','detalle_reservas.precio_sencillo','detalle_reservas.doble',
        'detalle_reservas.precio_doble','detalle_reservas.descuento','detalle_reservas.total',
        'horarios.start','horarios.end','clientes.nombres','clientes.apellidos','clientes.telefono')
        ->first();

        //start
        $start = Carbon::parse($reserva->start)->format('h:i A');
        //end
        $end = Carbon::parse($reserva->end)->format('h:i A');
        
        $horario = [
            'start'=>$start,
            'end'=>$end
        ];


        //fecha actual
        $date = Carbon::now();

        $dia = $date->format('d');
        $mes = $date->format('m');
        $anio = $date->format('Y');

        $arrayFecha = [
            'dia'=>$dia,
            'mes'=>$mes,
            'anio'=>$anio
        ];

        // dd($reserva->total);
          
        if($accion=='html'){
            return view('sistema.vistas.Reservas.PdfReserva',compact('reserva','arrayFecha','horario'));
        }else{
            $html = view('sistema.vistas.Reservas.PdfReserva',compact('reserva','arrayFecha','horario'))->render();
        }

        $namefile = 'boleta_de_venta_'.time().'.pdf';
 
        $mpdf = new Mpdf([
            'default_font' => 'arial',
            // "format" => "A4",
            "format" => [264.8,188.9],
        ]);

        $mpdf->WriteHTML($html);
        // dd($mpdf);
        if($accion=='ver'){
            $mpdf->Output($namefile,"I");
        }
    }
    
}
