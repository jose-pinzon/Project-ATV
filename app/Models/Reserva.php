<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';
    protected $primaryKey= 'id_reserva';
    public $incremeting=true;
    public $timestamps=true;
    public $with=['horario','cliente','guia'];
    protected $fillable = [
        'id_reserva',
        'fecha_reserva',
        'comentario',
        'estado',
        'id_horario',
        'id_cliente',
        'id_guia'
    ];

    public function horario(){

        return $this->belongsTo(Horario::class, 'id_horario', 'id_horario');

    }

    public function cliente(){

        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');

    }

    public function guia(){

        return $this->belongsTo(Guia::class, 'id_guia', 'id_guia');

    }


}
