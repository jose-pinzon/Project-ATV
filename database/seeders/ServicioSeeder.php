<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::create([
            'servicio'=>'Sencillo',
            'descripcion'=>'1 persona en la moto',
            'precio'=>400.00
        ]);
        Servicio::create([
            'servicio'=>'Doble',
            'descripcion'=>'2 persona en la moto',
            'precio'=>500.00
        ]);
    }
}
