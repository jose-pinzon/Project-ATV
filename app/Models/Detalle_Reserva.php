<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Reserva extends Model
{
    use HasFactory;
    protected $table = 'detalle_reservas';
    protected $primaryKey= 'id_detalle_reserva';
    public $incremeting=true;
    public $timestamps=true;
    protected $fillable = [
        'id_detalle_reserva',
        'fecha_hora',
        'sencillo',
        'precio_sencillo',
        'doble',
        'precio_doble',
        'total',
        'descuento',
        'id_reserva'
    ];
}
