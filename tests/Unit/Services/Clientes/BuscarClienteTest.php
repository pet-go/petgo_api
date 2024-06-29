<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Services\ClienteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class BuscarClienteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Cliente $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = app(Cliente::class);
    }
  
    /**
   * Testa o serviço de buscar dos clientes.
   *
   * @return void
    public function testBuscar(): void
    {
        $clientes = Cliente::factory()->count(10)->create();
        $ordenar_por = $this->faker->randomElement([
            'id',
            'nome'
        ]);
        $filtros = [
            'per_page' => 20,
            'ordem' => $ordenar_por,
            'direcao' => $this->faker->randomElement(['asc', 'desc'])
        ];
        $dados = app(ClienteService::class)->pesquisar(filtros: $filtros, model: $this->model);
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
}
