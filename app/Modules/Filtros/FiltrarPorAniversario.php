<?php

declare(strict_types=1);

namespace App\Modules\Filtros;

use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class FiltrarPorAniversario
{

    /**
     * Aplica o filtro data de nascimento, caso esse parâmetro seja enviado.
     * 
     * @param array $itens
     * @param Closure $next
     * 
     * @return array
     */
    public function handle(array $itens, Closure $next): array
    {
        $filtros = data_get($itens, 'filtros', []);
        $builder = data_get($itens, 'builder');
        $birthDayFilter = collect($filtros)->firstWhere('coluna', 'aniversario');
        $birthDayDate = Carbon::createFromDate(
            year: data_get($birthDayFilter, 'valor.ano'),
            month: data_get($birthDayFilter, 'valor.mes')
        );
        $query = $builder
            ->when(
                !is_null($birthDayFilter),
                fn (Builder $query) => $query->whereBetween('data_de_nascimento', [
                    clone $birthDayDate->startOfMonth(),
                    clone $birthDayDate->endOfMonth()
                ])
            );
        return $next([
            'filtros' => $filtros,
            'builder' => $query
        ]);
    }
}
