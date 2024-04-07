<?php
declare(strict_types=1);

namespace App\Modules\Clientes\Controllers;

use App\Modules\Clientes\Services\BuscarCliente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientesController
{
    public function __construct(
        private BuscarCliente $servicoBuscar
        )
    {
        
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json(
            $this->servicoBuscar->pesquisar($request),
            Response::HTTP_OK
        );
    }
}
