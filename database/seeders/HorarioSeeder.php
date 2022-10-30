<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Horario;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Horario::create([
            'start' => '8:00:00',
            'end' => '9:30:00'
        ]);
        Horario::create([
            'start' => '10:00:00',
            'end' => '11:30:00'
        ]);
        Horario::create([
            'start' => '12:00:00',
            'end' => '01:30:00'
        ]);
        Horario::create([
            'start' => '2:00:00',
            'end' => '3:30:00'
        ]);
        Horario::create([
            'start' => '4:00:00',
            'end' => '5:30:00'
        ]);
    }
}
