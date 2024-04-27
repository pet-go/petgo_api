<?php

namespace App\Modules\Pets\Contracts;

use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

interface RemoverPetContract
{
    /**
     * Exclui o registro pet
     * 
     * @param int $id
     * @param Builder $pet
     * @return JsonResource
     * 
     * @throws Exception
     */
    public function remover(int $id, Builder $pet): JsonResource;
}
