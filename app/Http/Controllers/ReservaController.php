<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Detalle_Reserva;
use Carbon\Carbon;

class ReservaController extends Controller
{
    //retorna vista
    public function returnvista(){
        return view('sistema.vistas.Reservas.reservas');
    }
    //listado actual
    public function index(Request $request){
        //seguridad
       //if(!$request->ajax()) return redirect('/');
       //integracion de carbon
       $date = Carbon::now();
       //fecha actual
       $date = $date->format('Y-m-d');

           $reservas = Reserva::join('horarios','reservas.id_horario','=','horarios.id_horario')
           ->join('clientes','reservas.id_cliente', '=', 'clientes.id_cliente')
           ->join('guias','reservas.id_guia','=','guias.id_guia')
           ->join('detalle_reservas', 'reservas.id_reserva','=','detalle_reservas.id_reserva')
           ->select('reservas.id_reserva','reservas.fecha_reserva','reservas.comentario','reservas.estado','reservas.id_cliente','reservas.id_horario','reservas.id_guia','horarios.start','horarios.end',
           'clientes.nombres as nombre_cliente','clientes.apellidos as apellido_cliente','clientes.telefono as telefono_cliente',
           'guias.nombres as nombre_guia','guias.apellidos as apellido_guia','guias.telefono as telefono_guia',
           'detalle_reservas.sencillo','detalle_reservas.precio_sencillo','detalle_reservas.doble','detalle_reservas.precio_doble',
           'detalle_reservas.descuento','detalle_reservas.total','detalle_reservas.fecha_hora','detalle_reservas.id_detalle_reserva',
           'detalle_reservas.id_reserva as idreserva')
           ->where('reservas.fecha_reserva','=', $date)
           ->where('reservas.estado','=','PENDIENTE')
           ->orderBy('reservas.fecha_reserva','DESC')->paginate(100);

       //retornar propiedades
       return [
           'pagination' => [
               //propiedades de aginations
               'total'        => $reservas->total(),
               'current_page' => $reservas->currentPage(),
               'per_page'     => $reservas->perPage(),
               'last_page'    => $reservas->lastPage(),
               'from'         => $reservas->firstItem(),
               'to'           => $reservas->lastItem(),
           ],
           'reservas'=> $reservas
       ];
    }
    //todo el listado
    public function AllReservas(){

            $reservas = Reserva::join('horarios','reservas.id_horario','=','horarios.id_horario')
            ->join('clientes','reservas.id_cliente', '=', 'clientes.id_cliente')
            ->join('guias','reservas.id_guia','=','guias.id_guia')
            ->join('detalle_reservas', 'reservas.id_reserva','=','detalle_reservas.id_reserva')
            ->select('reservas.id_reserva','reservas.fecha_reserva','reservas.comentario','reservas.estado','reservas.id_cliente','reservas.id_horario','reservas.id_guia','horarios.start','horarios.end',
            'clientes.nombres as nombre_cliente','clientes.apellidos as apellido_cliente','clientes.telefono as telefono_cliente',
            'guias.nombres as nombre_guia','guias.apellidos as apellido_guia','guias.telefono as telefono_guia',
            'detalle_reservas.sencillo','detalle_reservas.precio_sencillo','detalle_reservas.doble','detalle_reservas.precio_doble',
            'detalle_reservas.descuento','detalle_reservas.total','detalle_reservas.fecha_hora','detalle_reservas.id_detalle_reserva',
            'detalle_reservas.id_reserva as idreserva')
            ->orderBy('reservas.fecha_reserva','DESC')->paginate(5);

            //retornar propiedades
            return [
                'pagination' => [
                    //propiedades de aginations
                    'total'        => $reservas->total(),
                    'current_page' => $reservas->currentPage(),
                    'per_page'     => $reservas->perPage(),
                    'last_page'    => $reservas->lastPage(),
                    'from'         => $reservas->firstItem(),
                    'to'           => $reservas->lastItem(),
                ],
                'reservas'=> $reservas
            ];

    }
    //crear reserva
    public function StoreReserva(Request $request){
        $reserva = new Reserva();
        $reserva->fecha_reserva = $request->get('fecha_reserva');
        $reserva->id_horario = $request->get('id_horario');
        $reserva->id_cliente = $request->get('id_cliente');
        $reserva->id_guia = $request->id_guia;
        $reserva->comentario = $request->get('comentario');
        $reserva->estado = 'PENDIENTE';
        $reserva->save();

        $detalleReserva = new Detalle_Reserva;
        $detalleReserva->id_reserva = $reserva->id_reserva;
        $detalleReserva->fecha_hora = $reserva->fecha_reserva;
        $detalleReserva->sencillo = $request->get('sencillo');
        $detalleReserva->precio_sencillo = $request->get('precio_sencillo');
        $detalleReserva->doble = $request->get('doble');
        $detalleReserva->precio_doble = $request->get('precio_doble');
        $detalleReserva->descuento = $request->get('descuento');
        $detalleReserva->total = $request->get('total');
        $detalleReserva->save();


    }

    public function updateReserva(Request $request){
        $reserva =Reserva::findOrFail($request->id_reserva);
        $reserva->fecha_reserva = $request->get('fecha_reserva');
        $reserva->id_horario = $request->get('id_horario');
        $reserva->id_cliente = $request->get('id_cliente');
        $reserva->id_guia = $request->id_guia;
        $reserva->comentario = $request->get('comentario');
        $reserva->estado = 'PENDIENTE';
        $reserva->update();

        $detalleReserva = Detalle_Reserva::findOrFail($request->id_detalle_reserva);
        $detalleReserva->id_reserva = $reserva->id_reserva;
        $detalleReserva->fecha_hora = $reserva->fecha_reserva;
        $detalleReserva->sencillo = $request->get('sencillo');
        $detalleReserva->precio_sencillo = $request->get('precio_sencillo');
        $detalleReserva->doble = $request->get('doble');
        $detalleReserva->precio_doble = $request->get('precio_doble');
        $detalleReserva->descuento = $request->get('descuento');
        $detalleReserva->total = $request->get('total');
        $detalleReserva->update();
    }

    public function DetalleReserva(Request $request){
        $detallesReserva = Detalle_Reserva::where('id_reserva','=', $request->id_reserva)
        ->select('id_reserva','sencillo','doble','total','descuento')->first();

        return $detallesReserva;
    }

    public function cambiarEstado(Request $request){
        $reserva =Reserva::findOrFail($request->id_reserva);
        $reserva->estado = 'REALIZADO';
        $reserva->update();
    }

}
