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
            'tipo_gasto'=> 'Equipo de seguridad',
            'gasto'=> 'Una motocicleta implica la necesidad de comprar el equipo adecuado para protegerte',
            'cantidad'=> 100,
            'fecha' => "2022-11-01",
            'moto_id'=> '1',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Licencia de conducir',
            'gasto'=> 'Para manejar una moto, necesitas una Licencia Tipo A1.',
            'cantidad'=> 80,
            'fecha' => "2022-11-02",
            'moto_id'=> '2',
        ]);
        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'fecha' => "2022-11-02",
            'moto_id'=> '3',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'fecha' => "2022-11-03",
            'moto_id'=> '4',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Mantenimiento',
            'gasto'=> 'Consulta con tu distribuidor los cuidados especiales que requiere tu motocicleta. Esto depende del tipo de motor que hayas elegido',
            'cantidad'=> 100,
            'fecha' => "2022-11-04",
            'moto_id'=> '5',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'fecha' => "2022-11-05",
            'moto_id'=> '6',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'fecha' => "2022-11-06",
            'moto_id'=> '7',
        ]);

        Egreso::create([
            'tipo_gasto'=> 'Compra de gasolina',
            'gasto'=> 'Se compro gasolina para el tuur de las cuatrimotos',
            'cantidad'=> 100,
            'fecha' => "2022-11-08",
            'moto_id'=> '8',
        ]);
    }
}
