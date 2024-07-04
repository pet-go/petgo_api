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
     * @param Builder $builder 
     * @param Closure $next
     * 
     * @return Closure
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        return $next($builder)
            ->when(
                $this->request->id,
                fn (Builder $query) => $query->where('id', $this->request->id)
            );
    }
}
