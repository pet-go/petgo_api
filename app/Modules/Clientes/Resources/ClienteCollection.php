<?php

namespace App\Modules\Clientes\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteCollection extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'nm_reduzido' => $this->nm_reduzido,
            'email' => $this->email,
            'data_de_nascimento' => $this->data_de_nascimento,
            'genero' => $this->genero,
            'criado_em' => Carbon::parse($this->created_at)->format('Y-m-d h:i:s'),
            'ult_atualizacao' => Carbon::parse($this->updated_at)->format('Y-m-d h:i:s'),
            'dados_adicionais' => $this->dados_adicionais,
        ];
    }
}
