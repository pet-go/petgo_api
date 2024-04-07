<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Repositories;

use App\Modules\Clientes\Contracts\ClienteContract;
use App\Modules\Clientes\Resources\ClienteCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ClienteRepository implements ClienteContract
{
    /**
     * @param Builder $clientes
     * @param object $ordenacao
     * @return array
     */
    public function index(Builder $clientes, object $ordenacao): array
    {
        try {
            $dados = $clientes
                ->orderBy($ordenacao->ordenar_por, $ordenacao->sentido)
                ->paginate(
                    perPage: $ordenacao->per_page,
                    columns: ['*'],
                    pageName: 'clientes',
                    page: $ordenacao->page
                );
            return $this->formatarPaginacao($dados);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => $ex->getCode(),
                'error' => $ex->getMessage(),
                'mensagem' => 'Instabilidade no servidor. Tente mais tarde'
            ]);
        }
    }

    /**
     * @param lengtAwarePaginator $paginacao
     * @return array
     */
    private function formatarPaginacao(LengthAwarePaginator $paginacao): array
    {
        return [
            'pagina_atual' => $paginacao->currentPage(),
            'por_pagina' => $paginacao->perPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'primeira_pagina' => $paginacao->onFirstPage(),
            'total' => $paginacao->total(),
            'dados' => ClienteCollection::collection($paginacao->items())
        ];
    }
}
