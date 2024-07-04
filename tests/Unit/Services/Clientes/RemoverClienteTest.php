<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Services\ClienteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemoverClienteTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Testa o serviço de exclusão
     * 
     * @return void
     */
    public function testRemover(): void
    {
        $cliente = Cliente::factory()->create();
        app(ClienteService::class)->remover($cliente);
        $cliente->refresh();
        $this->assertTrue($cliente->trashed());
    }
}
