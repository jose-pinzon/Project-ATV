<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $table = 'ingresos';
    protected $primaryKey= 'id_ingreso';
    public $incremeting=true;
    public $timestamps=true;
    protected $fillable = [
        'id_ingreso',
        'fecha_hora',
        'descripcion',
        'cantidad',
        'forma_pago',
        'mov_banco',
        'pago_unitario',
        'total',
        'id_detalle_reserva'
    ];

    public function Detalle_reservas(){

        return $this->belongsTo(Detalle_Reserva::class, 'id_detalle_reserva', 'id_detalle_reserva');

    }
}
