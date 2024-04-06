<?php
declare(strict_types=1);

namespace App\Modules\Clientes\Filtros\Clientes;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FiltrarNome
{
    public function __construct(protected Request $request)
    {}
    /**
     * Filtra o cliente pelo nome, caso esse parâmetros seja enviado.
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
                $this->request->has('nome'),
                fn (Builder $query) => $query->where('nome', 'REGEXP', $this->request->nome)
            );
    }
}
