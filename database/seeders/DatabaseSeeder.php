<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cita;
use App\Models\Optica;
use Illuminate\Database\Seeder;
use Database\Seeders\OpticaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Crear 5 ópticas
        $opticas = Optica::factory(5)->create();

        // Crear 10 usuarios
        $users = User::factory(10)->create();

        // Crear citas asignando usuarios y ópticas aleatorias
        Cita::factory(30)->create([
            'user_id'   => $users->random()->id,
            'optica_id' => $opticas->random()->id,
        ]);
    }
}
