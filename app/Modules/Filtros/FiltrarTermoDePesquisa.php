<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FiltrarTermoDePesquisa
{
    public function __construct(
        protected Request $request,
    ) {
    }

    /**
     * Aplica o filtro do termo de pesquisa.
     * 
     * @param Builder $builder
     * @param Model $model
     * @param Closure $next
     * 
     * @return Builder
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        return $next($builder)
            ->when(
                $this->request->filled('termo_de_pesquisa'),
                function (Builder $query) {
                    $query->whereAny(
                        $query->getModel()->getFillable(),
                        'REGEXP',
                        $this->request->termo_de_pesquisa
                    );
                }
            );
    }
}
