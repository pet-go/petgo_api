<?php

namespace App\Traits;

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
        $resource = $this->servicoBuscar->pesquisar($request,$this->model);
        return response()->json($resource,data_get($resource,'status'));
    }
}
