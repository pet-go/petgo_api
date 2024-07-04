<?php

declare(strict_types=1);

namespace App\Modules\Pets\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface BuscarPetContract
{
    /**
     * @param Builder $resource
     * @param object $ordenacoes
     * @return array
     */
    public function index(Builder $resource, object $ordenacoes): array;

}
