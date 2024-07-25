<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Services\ClienteService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BuscarClienteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Testa o serviço de buscar dos clientes.
     * 
     * @return void
     */
    #[Test]
    public function buscar(): void
    {
        $clientes = Cliente::factory()->count(2)->create();
        $ordenar_por = $this->faker->randomElement([
            'id',
            'nome'
        ]);
        $filtros = [
            'per_page' => 20,
            'ordem' => $ordenar_por,
            'direcao' => $this->faker->randomElement(['asc', 'desc'])
        ];
        $dados = app(ClienteService::class)->pesquisar(filtros: $filtros);
        $clienteArray = $clientes->sortBy([
            [data_get($filtros, 'ordem'), data_get($filtros, 'direcao')]
        ])
            ->first()
            ->getAttributes();
        $itens = data_get($dados, 'dados.0')
            ->getAttributes();
        $this->assertEquals(data_get($filtros, 'per_page'), data_get($dados, 'por_pagina'));
        $this->assertEquals(data_get($itens, 'nome'), data_get($clienteArray, 'nome'));
        $this->assertEquals(data_get($itens, 'id'), data_get($clienteArray, 'id'));
    }

    /**
     * Teste buscar cliente por nome
     * 
     * @return void
     */
    #[Test]
    public function buscar_por_nome(): void
    {
        $clientes = Cliente::factory()->count(2)->create();
        $filtros = [
            'filtros' => [
                0 => [
                    'coluna' => 'nome',
                    'valor' => $clientes->first()->nome
                ]
            ],
        ];
        $dados = app(ClienteService::class)->pesquisar(filtros: $filtros);
        $dados['dados']->flatten()->each(function ($item) use ($clientes) {
            $this->assertEquals($clientes->first()->nome, $item->nome);
            $this->assertEquals($clientes->first()->id, $item->id);
        });
    }

    /**
     * Teste buscar cliente por ID
     * 
     * @return void
     */
    #[Test]
    public function buscar_por_id(): void
    {
        $clientes = Cliente::factory()->count(2)->create();
        $filtros = [
            'filtros' => [
                0 => [
                    'coluna' => 'id',
                    'valor' => $clientes->first()->id
                ]
            ],
        ];
        $dados = app(ClienteService::class)->pesquisar(filtros: $filtros);
        $dados['dados']->flatten()->each(function ($item) use ($clientes) {
            $this->assertEquals($clientes->first()->nome, $item->nome);
            $this->assertEquals($clientes->first()->id, $item->id);
        });
    }

    /**
     * Teste buscar cliente por Gênero
     * 
     * @return void
     */
    #[Test]
    public function buscar_por_genero(): void
    {
        $cliente1 = Cliente::factory()->create([
            'genero' => 'Feminino'
        ]);
        Cliente::factory()->create([
            'genero' => 'Masculino'
        ]);
        $filtros = [
            'filtros' => [
                0 => [
                    'coluna' => 'genero',
                    'valor' => $cliente1->genero
                ]
            ],
        ];
        $dados = app(ClienteService::class)->pesquisar(filtros: $filtros);
        $dados['dados']->flatten()->each(function ($item) use ($cliente1) {
            $this->assertEquals($cliente1->nome, $item->nome);
            $this->assertEquals($cliente1->id, $item->id);
        });
    }

    /**
     * Teste buscar cliente por Gênero
     * 
     * @return void
     */
    #[Test]
    public function buscar_por_aniversario(): void
    {
        $clientes = Cliente::factory()->count(2)->create();
        $aniversario = Carbon::create($clientes->first()->data_de_nascimento);
        $filtros = [
            'filtros' => [
                0 => [
                    'coluna' => 'aniversario',
                    'valor' => [
                        'mes' => $aniversario->month,
                        'ano' => $aniversario->year
                    ]
                ]
            ],
        ];
        $dados = app(ClienteService::class)->pesquisar(filtros: $filtros);
        $dados['dados']->flatten()->each(function ($item) use ($clientes) {
            $this->assertEquals($clientes->first()->nome, $item->nome);
            $this->assertEquals($clientes->first()->id, $item->id);
        });
    }

    /**
     * Teste buscar cliente por termo de pesquisa.
     * 
     * @return void
     */
    #[Test]
    public function buscar_por_termo_de_pesquisa(): void
    {
        $expressaoDeTeste = $this->faker->word();
        $cliente1 = Cliente::factory()->create();
        $cliente2 = Cliente::factory()->create([
            'nome' => $expressaoDeTeste
        ]);
        $filtros = [
            'filtros' => [
                0 => [
                    'coluna' => 'nome',
                    'valor' => $expressaoDeTeste
                ]
            ],
        ];
        $dados = app(ClienteService::class)->pesquisar(filtros: $filtros);
        $dados['dados']->flatten()->each(function ($item) use ($cliente2, $expressaoDeTeste) {
            $this->assertEquals($expressaoDeTeste, $item->nome);
            $this->assertEquals($cliente2->id, $item->id);
        });
    }
}
