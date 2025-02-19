<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Optica;
use App\Models\User;

class OpticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $opticas = Optica::factory(5)->create();

    // Asignamos ópticas aleatorias a usuarios
    User::all()->each(function ($user) use ($opticas) {
        $user->opticas()->attach($opticas->random(rand(1, 3))->pluck('id')->toArray());
    });
}
}
