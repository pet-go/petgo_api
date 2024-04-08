<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiltrarGenero
{
    public function __construct(protected Request $request)
    {}
      
    /**
     * Aplica o filtro gênero, caso esse parâmetros seja enviado.
     * 
     * @param Request $request
     * @param Closure $next
     * 
     * @return Closure
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        return $next($builder)
            ->when(
                $this->request->filled('genero'),
                fn (Builder $query) => $query->where('genero', 'REGEXP', $this->request->genero)
            );
    }
}
