<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Guia;

class GuiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guia::create([
            'nombres'=>'Julio',
            'apellidos'=>'Cruz',
            'edad'=>40,
            'telefono'=>'896789392',
            'direccion'=>'izamal',
            'ingles'=>'SI',
            'estado'=>1
        ]);

        Guia::create([
            'nombres'=>'Carlos',
            'apellidos'=>'Antonio',
            'edad'=>38,
            'telefono'=>'896789392',
            'direccion'=>'izamal',
            'ingles'=>'SI',
            'estado'=>1
        ]);
    }
}
