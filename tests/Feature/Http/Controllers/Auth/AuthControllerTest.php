<?php

namespace Feature\Http\Controllers\Auth;

use App\Models\Cliente\Cliente;
use Illuminate\Queue\Jobs\FakeJob;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        new FakeJob();
    }

    /**
     * Testa o cadastro de usuário do cliente
     * 
     * @return void
     */
    public function testCadastrar(): void
    {
        $cliente = Cliente::factory()->create();
        $resposta = $this->postJson('/api/v1/auth-cliente/'. $cliente->id);
        $resposta->assertCreated();
    }
}
