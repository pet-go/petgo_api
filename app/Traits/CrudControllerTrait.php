<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait CrudControllerTrait
{
    /**
     * Lista todos os objetos paginados.
     * 
     * @param Request $request
     * @return JsonResponse
     * 
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        $resource = $this->servico->pesquisar($request, $this->modelo);
        return response()->json($resource, data_get($resource, 'status'));
    }

    /**
     * Cadastra novo objeto
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $resource = $this->servico->adicionar(dados: $request->all(),modelo: $this->modelo);
        return response()->json($resource, data_get($resource, 'status'));
    }

    /**
     * Buscar objeto Model
     * 
     * @param Model|int $id
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        $resource = $this->servico->exibir($this->modelo);
        return response()->json($resource, data_get($resource, 'status'));
    }
}
