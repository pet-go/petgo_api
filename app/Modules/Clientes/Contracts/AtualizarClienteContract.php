<?php

namespace App\Modules\Clientes\Contracts;

use Illuminate\Database\Eloquent\Model;

interface AtualizarClienteContract
{
    /**
     * Atualiza o Cliente
     * 
     * @param Model $cliente
     * @return array
     */
    public function atualizar(Model $cliente, array $dados): array;
}
