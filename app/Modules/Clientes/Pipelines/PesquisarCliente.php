<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Pipelines;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Filtros\Clientes\FiltrarDataDeNascimento;
use App\Modules\Clientes\Filtros\Clientes\FiltrarGenero;
use App\Modules\Clientes\Filtros\Clientes\FiltrarId;
use App\Modules\Clientes\Filtros\Clientes\FiltrarNome;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class PesquisarCliente
{
    public function execute(Builder $clientes)
    {
        return (new Pipeline(app()))
            ->send($clientes)
            ->through([
                FiltrarId::class,
                FiltrarNome::class,
                FiltrarDataDeNascimento::class,
                FiltrarGenero::class
            ])
            ->thenReturn();
    }
}
