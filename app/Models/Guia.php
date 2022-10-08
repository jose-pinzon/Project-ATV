<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    use HasFactory;

    protected $table = 'guias';
    protected $primaryKey= 'id_guia';
    public $incremeting=true;
    public $timestamps=true;
    protected $fillable = [
        'id_guia',
        'nombres',
        'apellidos',
        'edad',
        'telefono',
        'email',
        'direccion',
        'ingles',
        'estado'
    ];

}
