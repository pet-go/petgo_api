<?php

namespace App\Modules\Pets\Contracts;

use Illuminate\Database\Eloquent\Model;

interface AtualizarPetContract
{
    /**
     * Atualiza o Pet
     * 
     * @param Model $pet
     * @return array
     */
    public function atualizar(Model $pet, array $dados): array;
}
