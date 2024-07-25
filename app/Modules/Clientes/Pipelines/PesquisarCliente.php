<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Pipelines;

use App\Models\Cliente\Cliente;
use App\Modules\Filtros\FiltrarPorAniversario;
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
     * @param array $filtros
     * @return Builder
     */
    public function execute(array $filtros): Builder
    {
        $itens = [
            'filtros' => data_get($filtros, 'filtros'),
            'builder' => Cliente::query()
        ];
        $dados = (new Pipeline(app()))
            ->send($itens)
            ->through([
                FiltrarId::class,
                FiltrarNome::class,
                FiltrarPorAniversario::class,
                FiltrarGenero::class,
                FiltrarTermoDePesquisa::class
            ])
            ->thenReturn();
        return data_get($dados, 'builder');
    }
}
