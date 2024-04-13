<?php

namespace Database\Factories\Pet;

use App\Models\Pet\Especie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EstirpeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->nome,
            'especie_id' => Especie::factory()->lazy()
        ];
    }
}
