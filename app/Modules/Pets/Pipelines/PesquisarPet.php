<?php

namespace App\Modules\Pets\Pipelines;

use App\Models\Pet\Pet;
use App\Modules\Filtros\FiltrarEstirpe;
use App\Modules\Filtros\FiltrarPorAniversario;
use App\Modules\Filtros\FiltrarId;
use App\Modules\Filtros\FiltrarNome;
use App\Modules\Filtros\FiltrarTermoDePesquisa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class PesquisarPet
{
    /**
     * Filtra consulta através das Pipelines
     * 
     * @param array $filtros
     * @return Builder
     */
    public function execute(array $filtros): Builder
    {
        $itens = [
            'filtros' => data_get($filtros, 'filtros'),
            'builder' => Pet::query()
        ];
        $dados = (new Pipeline(app()))
            ->send($itens)
            ->through([
                FiltrarId::class,
                FiltrarNome::class,
                FiltrarTermoDePesquisa::class,
                FiltrarPorAniversario::class,
                FiltrarEstirpe::class,
            ])->thenReturn();
        return data_get($dados, 'builder');
    }
}
