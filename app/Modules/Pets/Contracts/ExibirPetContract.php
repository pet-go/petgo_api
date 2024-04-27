<?php

namespace App\Modules\Pets\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ExibirPetContract
{
    /**
     * @param Model $pet
     * @return array
     */
    public function exibir(Model $pet): array;
}
