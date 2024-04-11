<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiltrarEstirpe
{
    public function __construct(
        protected Request $request
    ) {
    }
    
    /**
     * Aplica o filtro Estirpe, caso esse parâmetro seja enviádo.
     * 
     * @param Builder $builder
     * @param Closure $next
     * 
     * @return Builder
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        return $next($builder)
            ->when(
                $this->request->filled('estirpe'),
                fn (Builder $query) => $query->where('estirpe', 'REGEXP', $this->request->estirpe)
            );
    }
}
