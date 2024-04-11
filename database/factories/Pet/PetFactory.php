<?php

namespace Database\Factories\Pet;

use App\Models\Cliente\Cliente;
use App\Models\Pet\Estirpe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
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
            'nome' => fake()->name(),
            'cliente_id' => Cliente::factory()->lazy(),
            'estirpe' => Estirpe::factory()->lazy(),
            'data_de_nascimento' => fake()->date()
        ];
    }
}
