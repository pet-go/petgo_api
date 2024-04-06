<?php

namespace Database\Factories\Cliente;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = fake()->name();
        return [
            'nome' => $nome,
            'nm_reduzido' => Str::substr($nome, 0, 10),
            'data_de_nascimento' => fake()->date(),
            'genero' => fake()->randomElement(['Masculino', 'Feminino', 'Outro']),
            'dados_adicionais' => [
                'cpf' => fake()->randomDigit(11),
                'rg' => fake()->randomDigit(14)
            ]
        ];
    }
}
