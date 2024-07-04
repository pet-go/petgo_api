<?php

namespace App\Modules\Pets\Validations;

use App\Modules\Validations\BaseValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PetValidation implements BaseValidation
{
    /**
     * @inheritDoc
     */
    public function validator(array $dados): array
    {
        $validation = [
            'nome' => ['required', 'string', 'max:255', 'min:3'],
            'cliente_id' => ['required', 'integer', Rule::exists('clientes', 'id')],
            'estirpe_id' => ['required', 'integer', Rule::exists('estirpes', 'id')],
            'data_de_nascimento' => ['sometimes', 'date']
        ];
        $atributos = [
            'nome' => 'Nomne',
            'cliente_id' => 'Cliente',
            'estirpe_id' => 'Estirpe',
            'data_de_nascimento' => 'Data de nascimento',
        ];
        $mensagens = [];
        return Validator::make(
            data: $dados,
            rules: $validation,
            messages: $mensagens,
            attributes: $atributos
        )->validate();
    }
}
