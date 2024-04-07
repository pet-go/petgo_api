<?php

declare(strict_types=1);

namespace App\Modules\Clientes\Services;

use App\Models\Cliente\Cliente;
use App\Modules\Clientes\Pipelines\PesquisarCliente;
use App\Modules\Clientes\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class BuscarCliente
{
    public function __construct(
        private readonly ClienteRepository $clienteRepository
    ) {
    }

    /**
     * Serviço retorna lista de clientes filtrada.
     * 
     * @param Request $request
     * @return array
     */
    public function pesquisar(Request $request): array
    {
        $ordenacao = (object) [
            'per_page' => $request->input('per_page') ?? 10,
            'page' => $request->input('page') ?? 1,
            'ordenar_por' => $request->input('ordem') ?? 'id',
            'sentido' => $request->input('direcao') ?? 'asc'
        ];
        $clientes = app(PesquisarCliente::class)->execute(Cliente::query());
        return $this->clienteRepository->index(clientes: $clientes, ordenacao: $ordenacao);
    }
}
