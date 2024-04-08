<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiltrarId
{
    public function __construct(protected Request $request)
    {}

    /**
     * Aplica o filtro ID, caso esse parâmetros seja enviado.
     * 
     * @param Request $request
     * @param Closure $next
     * 
     * @return Closure
     */
    public function handle(Builder $builder, Closure $next)
    {
        return $next($builder)
            ->when(
                $this->request->filled('codigo'),
                fn (Builder $query) => $query->where('id', $this->request->codigo)
            );
    }
}
