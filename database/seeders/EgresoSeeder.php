<?php

namespace Database\Seeders;

use App\Models\Egreso;
use Illuminate\Database\Seeder;

class EgresoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'moto_id'=> '1',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 80,
            'moto_id'=> '2',
        ]);
        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'moto_id'=> '3',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'moto_id'=> '4',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'moto_id'=> '5',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'moto_id'=> '6',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'moto_id'=> '7',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'moto_id'=> '8',
        ]);
    }
}
