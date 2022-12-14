<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey= 'id_cliente';
    public $incremeting=true;
    public $timestamps=true;
    protected $fillable = [
        'id_cliente',
        'nombres',
        'apellidos',
        'telefono',
        'email',
        'nacionalidad',
        'pais',
        'ciudad'
    ];
}
