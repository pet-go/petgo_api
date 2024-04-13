<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiltrarNome
{
    public function __construct(protected Request $request)
    {}

    /**
     * Aplica o filtro nome, caso esse parâmetros seja enviado.
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
                $this->request->filled('nome'),
                fn (Builder $query) => $query->where('nome', 'REGEXP', $this->request->nome)
            );
    }
}
