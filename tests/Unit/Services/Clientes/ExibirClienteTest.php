<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Services\ClienteService;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ExibirClienteTest extends TestCase
{
    /**
     * Testa o serviço de busca do cliente
     * 
     * @return void
     */
    #[Test]
    public function exibir(): void
    {
        $cliente = Cliente::factory()->create();
        $clienteEncontrado = app(ClienteService::class)->exibir($cliente);
        $dados = data_get($clienteEncontrado, 'dados')->first()->toArray();
        $this->assertEquals($cliente->id, data_get($dados, 'id'));
        $this->assertEquals($cliente->nome, data_get($dados, 'nome'));
        $this->assertEquals($cliente->nm_reduzido, data_get($dados, 'nm_reduzido'));
    }

    /**
     * Teste deve falhar ao tentar buscar cliente que não existe.
     * 
     * @return void
     */
    #[Test]
    public function deve_falhar_ao_buscar_cliente_que_nao_existe(): void
    {
        Cliente::query()->delete();
        $cliente = Cliente::first();
        $buscarCliente = app(ClienteService::class)->exibir($cliente);
        $this->assertEquals(
            data_get($buscarCliente, 'status'),
            Response::HTTP_NOT_FOUND
        );
        $this->assertEquals(
            data_get($buscarCliente, 'error'),
            "Algo deu errado com a solicitação"
        );
    }
}
