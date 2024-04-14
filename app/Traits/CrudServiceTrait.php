<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait CrudServiceTrait
{
    /**
     * Serviço retorna uma lista filtrada.
     * 
     * @param Request $request
     * @return array
     */
    public function pesquisar(Request $request, Model $model): array
    {
        $ordenacao = (object) [
            'per_page' => $request->input('per_page') ?? 10,
            'page' => $request->input('page') ?? 1,
            'ordenar_por' => $request->input('ordem') ?? 'id',
            'sentido' => $request->input('direcao') ?? 'asc'
        ];
        $resource = app($this->pesquisaPipeline)->execute($model::query());
        return $this->repository->index(resource: $resource, ordenacoes: $ordenacao);
    }
}
