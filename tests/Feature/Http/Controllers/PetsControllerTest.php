<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pet\Pet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetsControllerTest extends TestCase
{
    use RefreshDatabase;

     /**
     * Testa o endpoint de listagem de pets
     */
    public function testIndex(): void
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
