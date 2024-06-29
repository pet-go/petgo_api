<?php

namespace App\Modules\Auth\Services;

use App\Jobs\ClienteWelcomeJob;
use App\Models\Cliente\Cliente;
use App\Models\User\User;
use App\Modules\Auth\Validations\AuthValidation;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /** @var $validation */
    protected mixed $validation = AuthValidation::class;

    /**
     * @param array $dados
     * @return array
     */
    public function cadastrarCliente(Cliente $cliente): array
    {
        try {
            if (!$cliente->email) {
                throw new Exception("Preencha o campo e-mail do cliente.",400);
            }
            $senha = Str::password(8, true, true, false, false);
            $cliente->usuario()->create([
                'nome' => $this->tratarNome($cliente->nome),
                'email' => $cliente->email,
                'senha' => Hash::make($senha)
            ]);
            ClienteWelcomeJob::dispatch($cliente, $senha);
            return [
                'status' => Response::HTTP_CREATED,
                'dados' => $cliente->usuario
            ];
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @param $nome
     * 
     * @return $string
     */
    private function tratarNome(string $nome): string
    {
        $nome = Str::snake($nome);
        $nomeMinusculo = Str::lower($nome);
        $nomeReduzido = explode('_', $nomeMinusculo);
        $separandoTexto = array_slice($nomeReduzido, 0, 2);
        $resultado = implode('_', $separandoTexto);
        return $resultado;
    }
}
