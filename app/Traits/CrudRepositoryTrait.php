<?php

namespace App\Traits;

use App\Integration\Services\DeepLangService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait CrudRepositoryTrait
{
    /**
     * @inheritDoc
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
                    pageName: 'principal',
                    page: $ordenacoes->page
                );
            return $this->formatarPaginacao(paginacao: $dados);
        } catch (Exception $ex) {
            return $this->returnException(exception: $ex);
        }
    }

    /**
     * @param LengthAwarePaginator $paginacao
     * @return array<mixed>
     */
    private function formatarPaginacao(LengthAwarePaginator $paginacao): array
    {
        return [
            'status' => Response::HTTP_OK,
            'pagina_atual' => $paginacao->currentPage(),
            'por_pagina' => $paginacao->perPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'primeira_pagina' => $paginacao->onFirstPage(),
            'total' => $paginacao->total(),
            'dados' => Str::replace('::class', '', $this->resourceCollection)::collection($paginacao->items())
        ];
    }

    /**
     * @inheritDoc
     */
    public function cadastrar(array $dados): array
    {
        try {
            $dados = app($this->validations)->validator(dados: $dados);
            $resource = app($this->modelo)->create($dados);
            $dados = [
                'status' => Response::HTTP_CREATED,
                'dados' => new $this->resourceCollection($resource)
            ];
            return $dados;
        } catch (ValidationException $ex) {
            return [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => $ex->getMessage(),
                'errors' => $ex->validator->errors()
            ];
        }
    }

    /**
     * @throws Exception $ex
     * @return array<mixed>
     */
    private function returnException(Exception $exception): array
    {
        return [
            'status' => $exception->getCode() == 0 ? Response::HTTP_INTERNAL_SERVER_ERROR : $exception->getCode(),
            'message' => $exception->getMessage(),
            'errors' => DeepLangService::fixLang(
                'Something went wrong!',
                $exception->getMessage()
            )
        ];
    }
}
