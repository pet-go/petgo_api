<?php

namespace App\Modules\Pets\Pipelines;

use App\Modules\Filtros\FiltrarDataDeNascimento;
use App\Modules\Filtros\FiltrarEstirpe;
use App\Modules\Filtros\FiltrarId;
use App\Modules\Filtros\FiltrarNome;
use App\Modules\Filtros\FiltrarTermoDePesquisa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class PesquisarPet
{
    /**
     * Filtra consulta através das Pipelines
     * @param Builder $pets
     * @return Builder
     */
    public function handle(Builder $pets): Builder
    {
        return (new Pipeline(app()))
            ->send($pets)
            ->through([
                FiltrarId::class,
                FiltrarNome::class,
                FiltrarTermoDePesquisa::class,
                FiltrarDataDeNascimento::class
            ])->thenReturn();
    }
}
