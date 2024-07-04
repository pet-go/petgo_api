<?php

namespace App\Modules\Clientes\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CadastrarClienteContrat
{
    /**
     * @param array<mixed> $dados
     * @param Model $modelo
     * @return array>mixed>
     */
    public function cadastrar(array $dados, Model $modelo): array;
}
