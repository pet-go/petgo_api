<?php

namespace Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
use App\Modules\Clientes\Services\ClienteService;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Str;
use Tests\TestCase;

class AtualizarClienteTest extends TestCase
{
    #[Test]
    public function atualizar(): void
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
