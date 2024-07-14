<?php

namespace App\Modules\Auth\Services;

use App\Jobs\ClienteWelcomeJob;
use App\Models\Cliente\Cliente;
use App\Modules\Auth\Validations\AuthValidation;
use Exception;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    /** @var $validation */
    protected mixed $validation = AuthValidation::class;

    /**
     * register of new client users.
     * 
     * @param array $dados
     * @return array
     */
    public function registerNewUser(Cliente $cliente): array
    {
        try {
            if (!$cliente->email) {
                throw new Exception("Preencha o campo e-mail do cliente.", 400);
            }
            $senha = Str::password(10, true, true, false, false);

            $cliente->usuario()->create([
                'nome' => $this->tratarNome($cliente->nome),
                'email' => $cliente->email,
                'password' => $senha
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
     * Allows login to client users.
     * 
     * @param array $dados
     * @return array
     * 
     * @throws ValidationException
     */
    public function loginClientUser(array $dados): array
    {
        try {
            $this->validateLoginData($dados);

            $token = $this->attemptLogin($dados);

            return $this->createSuccessResponse($token);
        } catch (ValidationException $ex) {
            return $this->createErrorResponse('Falha nas validações', $ex->errors());
        } catch (JWTException $ex) {
            return $this->createErrorResponse('Não foi possível criar um token', $ex->getMessage());
        } catch (Exception $ex) {
            return $this->createErrorResponse('Ocorrência de erro', $ex->getMessage());
        }
    }

    private function validateLoginData(array $dados): void
    {
        $validator = Validator::make($dados, [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    private function attemptLogin(array $dados): string
    {
        if (!$token = JWTAuth::attempt(
            [
                'email' => $dados['email'],
                'password' => $dados['password']
            ]
        )) {
            throw new Exception('Credenciais inválidas');
        }

        return $token;
    }

    private function createSuccessResponse(string $token): array
    {
        return [
            'success' => true,
            'token' => $token,
        ];
    }

    private function createErrorResponse(string $message, $errors = null): array
    {
        return [
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ];
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
