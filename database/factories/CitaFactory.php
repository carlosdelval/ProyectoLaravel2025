<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\User;
use App\Models\Optica;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    protected $model = Cita::class;

    public function definition(): array
    {
        return [
            'user_id'   => User::all()->random()->id,
            'optica_id' => Optica::all()->random()->id,
            'fecha'     => $this->faker->dateTimeBetween('+1 week', '+6 months'),
            'hora'      => $this->faker->time(),
            'graduada'  => 0
        ];
    }
}
