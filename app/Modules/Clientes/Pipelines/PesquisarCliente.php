<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Pipelines;

use App\Modules\Filtros\FiltrarDataDeNascimento;
use App\Modules\Filtros\FiltrarGenero;
use App\Modules\Filtros\FiltrarId;
use App\Modules\Filtros\FiltrarNome;
use App\Modules\Filtros\FiltrarTermoDePesquisa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class PesquisarCliente
{
    /**
     * Execute sequência de pipeline para filtrar resultado.
     * 
     * @param Builder $clientes
     * @return Builder
     */
    public function execute(Builder $clientes): Builder
    {
        return (new Pipeline(app()))
            ->send($clientes)
            ->through([
                FiltrarId::class,
                FiltrarNome::class,
                FiltrarDataDeNascimento::class,
                FiltrarGenero::class,
                FiltrarTermoDePesquisa::class
            ])
            ->thenReturn();
    }
}
