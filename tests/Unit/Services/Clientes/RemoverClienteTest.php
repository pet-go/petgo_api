<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Services\ClienteService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RemoverClienteTest extends TestCase
{
    /**
     * Testa o serviço de exclusão
     * 
     * @return void
     */
    #[Test]
    public function remover(): void
    {
        $cliente = Cliente::factory()->create();
        app(ClienteService::class)->remover($cliente);
        $cliente->refresh();
        $this->assertTrue($cliente->trashed());
    }
}
