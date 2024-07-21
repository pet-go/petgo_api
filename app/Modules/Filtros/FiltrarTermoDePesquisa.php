<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class FiltrarTermoDePesquisa
{

    /**
     * Aplica o filtro do termo de pesquisa.
     * 
     * @param array $itens
     * @param Closure $next
     * 
     * @return array
     */
    public function handle(array $itens, Closure $next): array
    {
        $filtros = data_get($itens, 'filtros');
        $builder = data_get($itens, 'builder');
        $resource = collect($filtros)->firstWhere('coluna', 'termo_de_pesquisa');
        $query = $builder
            ->when(!is_null($resource), function (Builder $query) use($resource) {
                return $query->whereAny(
                   $query->getModel()->getFillable(),
                   'REGEXP',
                   $resource['valor']
                );
            });
        return $next([
            'filtros' => $filtros,
            'builder' => $query
        ]);
    }
}
