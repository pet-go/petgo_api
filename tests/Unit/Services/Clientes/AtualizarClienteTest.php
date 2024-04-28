<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use Tests\TestCase;

class AtualizarClienteTest extends TestCase
{
    public function testAtualizar()
    {
        $cliente = Cliente::factory()->create();
        
    }
}
