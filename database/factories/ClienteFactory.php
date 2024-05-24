<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition()
    {
        return [
            'razao_social' => $this->faker->company,
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}