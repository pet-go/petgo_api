<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class FiltrarGenero
{
    /**
     * Aplica o filtro gênero, caso esse parâmetros seja enviado.
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
        $resource = collect($filtros)->firstWhere('coluna', 'genero');
        $query = $builder
            ->when(
                !is_null($resource),
                fn (Builder $query) => $query->where('genero', 'REGEXP', data_get($resource, 'valor'))
            );
        return $next([
            'filtros' => $filtros,
            'builder' => $query
        ]);
    }
}
