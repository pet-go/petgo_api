<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Filtros\Clientes;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiltrarDataDeNascimento
{
    public function __construct(protected Request $request)
    {}
    /**
     * Filtra o cliente pela data de nascimento, caso esse parâmetros seja enviado.
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
                $this->request->has('data_de_nascimento'),
                fn (Builder $query) => $query->where('data_de_nascimento', 'REGEXP', $this->request->data_de_nascimento)
            );
    }
}
