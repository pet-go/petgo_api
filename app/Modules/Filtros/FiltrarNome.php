<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class FiltrarNome
{
    /**
     * Aplica o filtro nome, caso esse parâmetro seja enviado.
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
        $resource = collect(data_get($filtros, 'filtros', []))->firstWhere('coluna', 'nome');
        $query = $builder
            ->when(
                !is_null($resource),
                fn (Builder $query) => $query->where('nome', 'REGEXP', data_get($resource, 'valor'))
            );
        return $next([
            'filtros' => $filtros,
            'builder' => $query
        ]);
    }
}