<?php

namespace Database\Seeders;

use App\Models\Motos;
use Illuminate\Database\Seeder;

class MotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Motos::create([
            'numero_Atv' => 1,
            'max_velocidad' => 40,
            'placa' => 'PRA-46-42',
            'num_serie' => 'UHHD1U3M18DK10D9E',
            'num_motor'=> '52DN810E18DK18DN1F',
            'propietario' => 'Rodriguez',
            'marca' => 'Toyota',
            'modelo'=> 'serie 216',
            'color'=> 'Verde',
            'imagen'=>null
        ]);

        Motos::create([
            'numero_Atv' => 2,
            'max_velocidad' => 40,
            'placa' => 'PXP-33-53',
            'num_serie' => 'UHHD1U3M7DUAJDK10D9E',
            'num_motor'=> '52D7638SDS8DN1F',
            'propietario' => 'Jorge',
            'marca' => 'Dinamo',
            'modelo'=> '33FD',
            'color'=> 'Roja',
            'imagen'=>null
        ]);

        Motos::create([
            'numero_Atv' => 3,
            'max_velocidad' => 35,
            'placa' => 'WLU-94-69',
            'num_serie' => 'WF2F23M7DUAJDK0JVS',
            'num_motor'=> 'SFH3E638SDSIV9WDJ',
            'propietario' => 'José',
            'marca' => 'Italika',
            'modelo'=> '23FSSDF',
            'color'=> 'Roja',
            'imagen'=>null
        ]);

        Motos::create([
            'numero_Atv' => 4,
            'max_velocidad' => 35,
            'placa' => 'SAS-94-69',
            'num_serie' => 'ADNC8OM19HD2112',
            'num_motor'=> '8BDNAJKS12',
            'propietario' => 'Gonzales',
            'marca' => 'Italika',
            'modelo'=> '23FSSDF',
            'color'=> 'Roja',
            'imagen'=>null
        ]);

        Motos::create([
            'numero_Atv' => 5,
            'max_velocidad' => 35,
            'placa' => 'FGU-94-69',
            'num_serie' => 'JCB82BDIANSDAS',
            'num_motor'=> 'CRFFG4RAS332',
            'propietario' => 'Perez',
            'marca' => 'Italika',
            'modelo'=> '89BDAS',
            'color'=> 'Amarilla',
                'imagen'=>null
        ]);


    }
}
