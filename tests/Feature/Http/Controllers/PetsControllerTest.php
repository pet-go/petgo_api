<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pet\Pet;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PetsControllerTest extends TestCase
{
     /**
     * Testa o endpoint de listagem de pets
     */
    #[Test]
    public function index(): void
    {
        Pet::factory()->count(10)->create();
        $response = $this->getJson('/api/v1/pets');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'dados' =>  [
                    '*' => [
                        'id',
                        'nome',
                        'cliente_id',
                        'cliente',
                        'estirpe_id',
                        'estirpe',
                        'data_de_nascimento',
                        'criado_em',
                        'ult.atualizacao'
                    ]
                ]
            ]);
    }
}
