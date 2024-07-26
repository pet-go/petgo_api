<?php

namespace Tests\Unit\Services\Clientes;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
use App\Modules\Clientes\Services\ClienteService;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Str;
use Tests\TestCase;

class CadastrarClienteTest extends TestCase
{
    protected mixed $modelo = Cliente::class;

    /**
     * Testa o serviço de cadastrar clientes
     * @return void
     * 
     * @throws ValidationException
     */
    #[Test]
    public function adicionar(): void
    {
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
        $cliente = app(ClienteService::class)->adicionar($dados, app($this->modelo));
        $this->assertEquals(data_get($cliente,'status'),Response::HTTP_CREATED);
        $dadosDoCliente = $cliente['dados']->toArray(request());
        $this->assertArrayIsEqualToArrayOnlyConsideringListOfKeys($dadosDoCliente, $dados,[
            'nome',
            'nm_reduzido',
            'data_de_nascimento',
        ]);
    }

    /**
     * Testa se o serviço falha ao tentar cadastrar cliente utilizando
     * o campo gênero incorretamente.
     * 
     * @return void
     * @throws ValidationException
     */
    #[Test]
    public function deve_falhar_ao_tentar_cadastrar_genero_incorreto(): void
    {
        $nome = $this->faker->name();
        $dados = [
            'nome' => $nome,
            'nm_reduzido' => Str::limit($nome, 10, ''),
            'data_de_nascimento' => $this->faker->date(),
            'genero' => $this->faker->word,
            'dados_adicionais' => [
                'cpf' => $this->faker->randomNumber(5),
                'rg' => $this->faker->randomNumber(5)
            ],
        ];
        $validations = app(ClienteService::class)->adicionar($dados, app($this->modelo));
        $this->assertEquals(data_get($validations,'status'),Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->assertEquals(data_get($validations,'message'),"O campo genero selecionado é inválido.");
       
    }
}
