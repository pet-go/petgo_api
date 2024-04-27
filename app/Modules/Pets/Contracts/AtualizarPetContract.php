<?php

namespace App\Modules\Pets\Contracts;

use Illuminate\Http\Resources\Json\JsonResource;

interface AtualizarPetContract
{
    /**
     * Atualiza o Pet
     * 
     * @param int $id
     * @return JsonResource
     */
    public function atualizar(int $id, array $dados): JsonResource;
}
