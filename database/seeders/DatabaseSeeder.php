<?php

namespace Database\Seeders;

use App\Models\Egreso;
use App\Models\Motos;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(MotosSeeder::class);
<<<<<<< HEAD
        $this->call(EgresoSeeder::class);

=======
        $this->call(HorarioSeeder::class);
        $this->call(GuiaSeeder::class);
        $this->call(ServicioSeeder::class);
>>>>>>> 3d44aca7799774d3011548f90af7ce78000a9a5a
    }
}
