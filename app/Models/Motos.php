<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motos extends Model
{
    use HasFactory;
    // public $with = ['egresos'];

    protected $fillable = [
        'numero_Atv',
        'max_velocidad',
        'placa',
        'num_serie',
        'num_motor',
        'propietario',
        'marca',
        'modelo',
        'color',
        'activa'
    ];

    public function egresos(){
        return $this->hasMany(Egreso::class, 'moto_id' );
    }

}
