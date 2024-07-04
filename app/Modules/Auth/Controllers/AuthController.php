<?php

namespace App\Modules\Auth\Controllers;

use App\Models\Cliente\Cliente;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController
{
    /** @var AuthService */
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Cliente $cliente
     * @return JsonResponse
     */
    public function cadastrar(Cliente $cliente): JsonResponse
    {
        return response()->json(
            $this->service->cadastrarUsuarioParaCliente(cliente: $cliente),
            Response::HTTP_CREATED
        );
    }

    public function login(Request $request)
    {

    }

    public function me()
    {

    }

    public function refresh()
    {

    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60 *60
        ]);
    }

    public function logout()
    {

    }
}
