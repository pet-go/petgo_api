<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ExibirClienteContract
{
    /**
     * @param Model $cliente
     * @return array
     */
    public function exibir(Model $cliente): array;
}
