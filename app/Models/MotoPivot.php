<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotoPivot extends Model
{
    use HasFactory;

    public $fillable = [
        'moto_id',
        'egreso_id'
    ];

    public function egresos(){
        return $this->hasMany(Egreso::class, 'egreso_id' );
    }

    public function moto(){
        return $this->hasMany(Motos::class, 'moto_id');
    }

}
