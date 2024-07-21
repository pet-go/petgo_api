<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class FiltrarEstirpe
{    
    /**
     * Aplica o filtro Estirpe, caso esse parâmetro seja enviádo.
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
        $resource = collect($filtros)->firstWhere('coluna', 'estirpe');
        $query = $next($builder)
            ->when(
                !is_null($resource), function (Builder $query) use($resource) {
                    return $query->whereHas('estirpe', fn(Builder $query) => $query->whereAny(
                        $query->getModel()->getFillable(),
                        'REGEXP',
                        data_get($resource, 'valor')
                    ));
                }
            );
        return $next([
            'filtros' => $filtros,
            'builder' => $query ? $query : $builder
        ]);
    }
}
