<?php

namespace App\Traits;

use Exception;
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
        $resource = $this->servico->pesquisar($request,$this->model);
        return response()->json($resource,data_get($resource,'status'));
    }

    public function store(Request $request): JsonResponse
    {
        $resource = $this->servico->adicionar($request->all());
        return response()->json($resource,data_get($resource,'status'));
    }
}
