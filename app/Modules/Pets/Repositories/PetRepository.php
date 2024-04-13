<?php
declare(strict_types=1);

namespace App\Modules\Pets\Repositories;

use App\Modules\Pets\Resources\PetCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class PetRepository
{
    /**
     * @param Builder $pet
     * @param object $ordenacoes
     * @return array
     */
    public function index(Builder $pets, object $ordenacoes)
    {
        try {
            $dados = $pets
                ->orderBy(
                    $ordenacoes->por,
                    $ordenacoes->sentido
                )->paginate(
                    perPage: $ordenacoes->per_page,
                    columns: ['*'],
                    pageName: 'pets',
                    page: $ordenacoes->page
                );
                return $this->formatarPaginacao(paginacao: $dados);
        } catch(\Exception $ex) {
            return response()->json([
                'status' => $ex->getCode(),
                'error' => $ex->getMessage(),
                'message' => 'Instabilidade no servidor. Tente novamente mais tarde'
            ]);
        }
    }
    
    private function formatarPaginacao(LengthAwarePaginator $paginacao): array
    {
        return [
            'pagina_atual' => $paginacao->currentPage(),
            'por_pagina' => $paginacao->perPage(),
            'ultima_pagina' => $paginacao->lastPage(),
            'primeira_pagina' => $paginacao->onFirstPage(),
            'total' => $paginacao->total(),
            'dados' => PetCollection::collection($paginacao->items())
        ];
    }
}
