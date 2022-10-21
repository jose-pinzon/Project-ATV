<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    public $with = ['moto'];

    protected $fillable = [
        'tipo_gasto',
        'gasto',
        'cantidad',
        'moto_id',
    ];



    public function moto(){
        return $this->belongsTo(Motos::class, 'moto_id');
    }
}
