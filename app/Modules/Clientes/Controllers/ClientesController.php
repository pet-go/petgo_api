<?php
declare(strict_types=1);

namespace App\Modules\Clientes\Controllers;

use App\Modules\Clientes\Services\BuscarCliente;
use Illuminate\Http\Request;

class ClientesController
{
    public function __construct(
        private BuscarCliente $servicoBuscar
        )
    {
        
    }

    public function index(Request $request)
    {
        return $this->servicoBuscar->pesquisar($request);
    }
}
