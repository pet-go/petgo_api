<?php
declare(strict_types=1);

namespace App\Modules\Pets\Services;

use App\Models\Pet\Pet;
use App\Modules\Pets\Pipelines\PesquisarPet;
use App\Modules\Pets\Repositories\PetRepository;
use Illuminate\Http\Request;

class BuscarPet
{
    public function __construct(
        private readonly PetRepository $petRepository
    )
    {
        
    }
    
    /**
     * @param Request $request
     * @return array
     */
    public function pesquisar(Request $request)
    {
        $ordenacao = (object) [
            'per_page' => $request->input('per_page') ?? 10,
            'page' => $request->input('page') ?? 1,
            'ordenar_por' => $request->input('ordem') ?? 'id',
            'sentido' => $request->input('direcao') ?? 'asc'
        ];
        $pets = app(PesquisarPet::class)->execute(Pet::query());
        return $this->petRepository->index(pets: $pets, ordenacoes: $ordenacao);
    }
}
