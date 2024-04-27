<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ClientesControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Testa a listagem de clientes
     * @return void
     * 
     * @throws Exception
     */
    public function testIndex(): void
    {
        Cliente::factory()->count(10)->create();
        $response = $this->getJson('/api/v1/clientes');
        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'dados' =>  [
                    '*' => [
                        'id',
                        'nome',
                        'nm_reduzido',
                        'data_de_nascimento',
                        'genero',
                        'criado_em',
                        'ult_atualizacao',
                        'dados_adicionais'
                    ]
                ]
            ]);
    }

    /**
     * Testa o endpoint de criação
     * @return void
     * 
     * @throws ValidationException
     */
    public function testStore(): void
    {
        $nome = $this->faker->name();
        $dados = [
            'nome' => $nome,
            'nm_reduzido' => Str::substr($nome, 0, 10),
            'data_de_nascimento' => $this->faker->date(),
            'genero' => $this->faker->randomElement(TipoDeGeneroEnum::obterValores()),
            'dados_adicionais'=> [
                'cpf' => $this->faker->randomNumber(5),
                'rg' => $this->faker->randomNumber(5)
            ],
        ];
        $this->postJson('/api/v1/clientes', $dados);
        data_forget($dados,'dados_adicionais');
        $this->assertDatabaseHas(table:'clientes', data: $dados);
    }
}
