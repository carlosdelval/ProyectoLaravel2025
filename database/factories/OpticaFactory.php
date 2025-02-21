<?php

namespace Database\Factories;

use App\Models\Optica;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpticaFactory extends Factory
{
    protected $model = Optica::class;

    public function definition(): array
    {
        return [
            'nombre'    => $this->faker->company . ' Óptica',
            'direccion' => $this->faker->address,
            'telefono'  => $this->faker->phoneNumber,
        ];
    }
}
