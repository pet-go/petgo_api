<?php

namespace Database\Factories\Pet;

use App\Models\Cliente\Cliente;
use App\Models\Pet\Estirpe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'cliente_id' => Cliente::factory()->lazy(),
            'estirpe_id' => Estirpe::factory()->lazy(),
            'data_de_nascimento' => $this->faker->date()
        ];
    }
}
