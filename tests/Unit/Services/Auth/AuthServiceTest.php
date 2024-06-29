<?php

namespace Unit\Services\Auth;

use App\Jobs\ClienteWelcomeJob;
use App\Models\Cliente\Cliente;
use App\Modules\Auth\Services\AuthService;
use Exception;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }

    public function testCadastrarCliente(): void
    {
        $cliente = Cliente::factory()->create();
        $cliente = app(AuthService::class)->cadastrarCliente($cliente);
        $dados = data_get($cliente, 'dados')->toArray();
        $this->assertDatabaseHas('usuarios', [
            'nome' => data_get($dados, 'nome'),
            'email' => data_get($dados, 'email'),
            'cliente_id' => data_get($dados, 'cliente_id'),
        ]);
        Queue::assertPushed(ClienteWelcomeJob::class);
    }

    public function testDeveFalharQuandoOClienteNaoPossuirEmail()
    {
        $cliente = Cliente::factory()->create([
            'email' => null
        ]);
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Preencha o campo e-mail do cliente.');
        $this->expectExceptionCode(400);
        app(AuthService::class)->cadastrarCliente($cliente);
    }
}
