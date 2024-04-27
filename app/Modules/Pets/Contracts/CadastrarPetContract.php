<?php

namespace App\Modules\Pets\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CadastrarPetContract
{
    /**
     * @param array<mixed> $dados
     * @param Model $model
     * 
     * @return array>mixed>
     */
    public function cadastrar(array $dados, Model $modelo): array;
}
