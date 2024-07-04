<?php

namespace App\Modules\Clientes\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface BuscarClienteContract
{
    /**
     * @param Builder $resource
     * @param $ordenacoes
     */
    public function index(Builder $resource, object $ordenacoes):array;
}
