<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    protected $model = Cita::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'fecha' => $this->faker->dateTimeBetween('now', '+1 year'),
            'hora' => $this->faker->time(),
            'graduada' => 0
        ];
    }
}
