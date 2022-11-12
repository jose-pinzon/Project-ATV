<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    protected $with=['moto'];
    protected $fillable = [
        'tipo_gasto',
        'gasto',
        'cantidad',
        'moto_id',
        'fecha'
    ];



    public function moto(){
        return $this->belongsTo(Motos::class, 'moto_id');
    }
}
