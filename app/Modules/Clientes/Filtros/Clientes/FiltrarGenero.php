<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Filtros\Clientes;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiltrarGenero
{
    public function __construct(protected Request $request)
    {}
    /**
     * Filtra o cliente pelo gênero, caso esse parâmetros seja enviado.
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
                $this->request->has('genero'),
                fn (Builder $query) => $query->where('genero', 'REGEXP', $this->request->genero)
            );
    }
}
