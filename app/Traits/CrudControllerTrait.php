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
        $resource = $this->servico->pesquisar($request->all(), $this->modelo);
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
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $modelo = $this->modelo->findOrFail($id);
        $resource = $this->servico->exibir(modelo: $modelo);
        return response()->json($resource, data_get($resource, 'status'));
    }

    /**
     * Atualizar objeto Model
     * 
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request): JsonResponse
    {
        $modelo = $this->modelo->find($id);
        $resource = $this->servico->atualizar(modelo: $modelo, dados: $request->all());
        return response()->json($resource, data_get($resource, 'status'));
    }

    /**
     * Remover objeto Model
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $modelo = $this->modelo->find($id);
        $resource = $this->servico->remover(modelo: $modelo);
        return response()->json($resource, data_get($resource, 'status'));
    }
}
