<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ClientesControllerTest extends TestCase
{
    /**
     * Testa a listagem de clientes
     * 
     * @return void
     * 
     * @throws Exception
     */
    #[Test]
    public function index(): void
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
    #[Test]
    public function store(): void
    {
        $nome = $this->faker->name();
        $dados = [
            'nome' => $nome,
            'nm_reduzido' => Str::limit($nome, 10, ''),
            'data_de_nascimento' => $this->faker->date(),
            'genero' => $this->faker->randomElement(TipoDeGeneroEnum::obterValores()),
            'dados_adicionais' => [
                'cpf' => $this->faker->randomNumber(5),
                'rg' => $this->faker->randomNumber(5)
            ],
        ];
        $this->postJson('/api/v1/clientes', $dados);
        data_forget($dados, 'dados_adicionais');
        $this->assertDatabaseHas(table: 'clientes', data: $dados);
    }

    /**
     * Testa o endpoint de exibição
     * 
     * @return void
     */
    #[Test]
    public function show(): void
    {
        $cliente = Cliente::factory()->create();
        $resposta = $this->getJson('/api/v1/clientes/' . $cliente->id);
        $resposta->assertStatus(Response::HTTP_OK);
        $dados = json_decode($resposta->getContent(), true);
        $this->assertEquals($cliente->id, data_get($dados, 'dados.id'));
        $this->assertEquals($cliente->nome, data_get($dados, 'dados.nome'));
        $this->assertEquals($cliente->nm_reduzido, data_get($dados, 'dados.nm_reduzido'));
    }

    /**
     * Testa o endpoint de atualização
     * 
     * @return void
     * 
     * @throws ValidationException
     */
    #[Test]
    public function update(): void
    {
        $cliente = Cliente::factory()->create();
        $nome = $this->faker->name();
        $dados = [
            'nome' => $nome,
            'nm_reduzido' => Str::limit($nome, 10, ''),
            'data_de_nascimento' => $this->faker->date(),
            'genero' => $this->faker->randomElement(TipoDeGeneroEnum::obterValores()),
            'dados_adicionais' => [
                'cpf' => $this->faker->randomNumber(5),
                'rg' => $this->faker->randomNumber(5)
            ],
        ];
        $resposta = $this->putJson('api/v1/clientes/' . $cliente->id, $dados);
        $resposta->assertStatus(Response::HTTP_OK);
        $cliente = json_decode($resposta->getContent(), true);
        $this->assertEquals(data_get($dados, 'nome'), data_get($cliente, 'dados.nome'));
        $this->assertEquals(data_get($dados, 'nm_reduzido'), data_get($cliente, 'dados.nm_reduzido'));
        $this->assertEquals(data_get($dados, 'genero'), data_get($cliente, 'dados.genero'));
    }

    /**
     * Testa o endpoint de remoção
     * 
     * @return void
     */
    #[Test]
    public function remover(): void
    {
        $cliente = Cliente::factory()->create();
        $resposta = $this->deleteJson('/api/v1/clientes/' . $cliente->id);
        $resposta->assertStatus(Response::HTTP_OK);
        $dados = json_decode($resposta->getContent(), true);
        $this->assertEquals($cliente->id, data_get($dados,'dados.id'));
        $this->assertEquals($cliente->nome, data_get($dados,'dados.nome'));
        $this->assertEquals($cliente->nm_reduzido, data_get($dados,'dados.nm_reduzido'));
    }
}