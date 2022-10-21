<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    protected $primaryKey= 'id_horario';
    public $incremeting=true;
    public $timestamps=true;
    protected $fillable = [
        'start',
        'end',
        'estado',
    ];
}
