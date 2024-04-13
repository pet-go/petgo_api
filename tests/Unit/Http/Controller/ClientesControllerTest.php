<?php

namespace Tests\Unit\Http\Controller;

use App\Models\Cliente\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a listagem de clientes
     */
    public function testIndex(): void
    {
        Cliente::factory()->count(10)->create();
        $response = $this->getJson('/api/v1/clientes');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'dados' =>  [
                    '*' => [
                        'id',
                        'nome',
                        'nm_reduzido',
                        'data_de_nascimento',
                        'genero',
                        'criado_em',
                        'ult_atualizacao'
                    ]
                ]
            ]);
    }
}
