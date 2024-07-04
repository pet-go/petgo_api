<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
use App\Modules\Clientes\Services\ClienteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AtualizarClienteTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected mixed $modelo = Cliente::class;
    public function testAtualizar()
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
        $cliente = app(ClienteService::class)->atualizar(modelo: $cliente, dados: $dados);
        $this->assertEquals(data_get($cliente,'status'),Response::HTTP_OK);
        $dadosDoCliente = $cliente['dados']->toArray(request());
        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($dadosDoCliente, $dados,[
            'nome',
            'nm_reduzido',
            'data_de_nascimento',
        ]);
    }
}
