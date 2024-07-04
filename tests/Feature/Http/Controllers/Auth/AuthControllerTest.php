<?php

namespace Feature\Http\Controllers\Auth;

use App\Models\Cliente\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Queue\Jobs\FakeJob;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

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
