<?php

namespace App\Modules\Clientes\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface BuscarClienteContract
{
    public function index(Builder $resource, object $ordenacoes);
}
