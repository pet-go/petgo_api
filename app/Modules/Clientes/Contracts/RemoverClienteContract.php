<?php

namespace App\Modules\Clientes\Contracts;

use Exception;
use Illuminate\Database\Eloquent\Model;

interface RemoverClienteContract
{
    /**
     * Exclui o registro cliente
     * 
     * @param Model $cliente
     * @return array
     * 
     * @throws Exception
     */
    public function remover(Model $cliente): array;
}
