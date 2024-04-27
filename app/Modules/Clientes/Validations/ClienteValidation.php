<?php

declare(strict_types= 1);

namespace App\Modules\Clientes\Validations;

use App\Modules\Clientes\Enums\TipoDeGeneroEnum;
use App\Modules\Validations\BaseValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteValidation implements BaseValidation
{
    /**
     * @inheritDoc
     */
    public function validator(array $dados): array
    {
        return Validator::make($dados,[
            'nome' => ['required', 'string', 'max:255', 'min:3'],
            'nm_reduzido' => ['required','string', 'max:30','min:3'],
            'data_de_nascimento'=> ['sometimes','date'],
            'genero' => ['string','sometimes',Rule::in(TipoDeGeneroEnum::obterValores())],
            'dados_adicionais' => ['nullable','array']
        ])->validate();
    }
}
