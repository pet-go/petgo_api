<?php

namespace App\Traits;

use App\Integration\Services\DeepLangService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

trait CrudRepositoryTrait
{
    /**
     * @param Builder $pet
     * @param object $ordenacoes
     * @return array
     */
    public function index(Builder $resource, object $ordenacoes): array
    {
        try {
            $dados = $resource
                ->orderBy(
                    $ordenacoes->ordenar_por,
                    $ordenacoes->sentido
                )->paginate(
                    perPage: $ordenacoes->per_page,
                    columns: ['*'],
                    pageName: $resource,
                    page: $ordenacoes->page
                );
            return $this->formatarPaginacao(paginacao: $dados);
        } catch (\Exception $ex) {
            return [
                'status' => $ex->getCode() == 0 ? Response::HTTP_INTERNAL_SERVER_ERROR : $ex->getCode(),
                'error' => $ex->getMessage(),
                'log' => DeepLangService::fixLang(
                    'Something went wrong!',
                    $ex->getMessage()
                )
            ];
        }
    }
    
    private function formatarPaginacao(LengthAwarePaginator $paginacao): array
    {
        return [
            'status' => Response::HTTP_OK,
            'pagina_atual' => $paginacao->currentPage(),
            'por_pagina' => $paginacao->perPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'primeira_pagina' => $paginacao->onFirstPage(),
            'total' => $paginacao->total(),
            'dados' => Str::replace('::class','',$this->resourceCollection)::collection($paginacao->items())
        ];
    }
}
