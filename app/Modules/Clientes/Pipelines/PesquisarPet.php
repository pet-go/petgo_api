<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Pipelines;

use App\Models\Cliente\Cliente;
use App\Modules\Filtros\FiltrarDataDeNascimento;
use App\Modules\Filtros\FiltrarGenero;
use App\Modules\Filtros\FiltrarId;
use App\Modules\Filtros\FiltrarNome;
use App\Modules\Filtros\FiltrarTermoDePesquisa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class PesquisarPet
{
    public function __construct(
        protected Request $request
    ) {
    }

    /**
     * Execute sequência de pipeline para filtrar resultado.
     * @param Builder $clientes
     * @return Builder
     */
    public function execute(Builder $pets): Builder
    {
        return (new Pipeline(app()))
            ->send($pets)
            ->through([
                FiltrarId::class,
                FiltrarNome::class,
                FiltrarDataDeNascimento::class,
                FiltrarTermoDePesquisa::class
            ])
            ->thenReturn();
    }
}
