<?php

declare(strict_types=1);

namespace App\Modules\Pets\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetCollection extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cliente_id' => $this->cliente->id,
            'cliente' => $this->cliente->nome,
            'estirpe_id' => $this->estirpe->id,
            'estirpe' => $this->estirpe->nome,
            'data_de_nascimento' => Carbon::parse($this->data_de_nascimento)->format('Y-m-d'),
            'criado_em' => Carbon::parse($this->created_at)->format('Y-m-d h:i:s'),
            'ult.atualizacao' => Carbon::parse($this->updated_at)->format('Y-m-d h:i:s'),
        ];

    }
}
