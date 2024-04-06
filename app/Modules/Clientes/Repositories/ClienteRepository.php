<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Repositories;

use App\Modules\Clientes\Contracts\ClienteContract;
use Illuminate\Database\Eloquent\Builder;

class ClienteRepository implements ClienteContract
{
    public function index(Builder $clientes,object $ordenacao)
    {
        try{
            return $clientes
                ->orderBy($ordenacao->ordenar_por,$ordenacao->sentido)
                ->paginate();
        }catch(\Exception $ex) {
            return response()->json([
                'status' => $ex->getCode(),
                'error' => $ex->getMessage(),
                'mensagem' => 'Instabilidade no servidor. Tente mais tarde'
            ]);
        }
    }
}
