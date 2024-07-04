<?php
declare(strict_types=1);

namespace App\Modules\Auth\Validations;

use App\Modules\Auth\Enums\AuthEnum;
use App\Modules\Validations\BaseValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthValidation implements BaseValidation
{
    /**
     * @param Request $request
     * @return array
     */
    public function validator(array $dados): array
    {
        return Validator::make(
            $dados,
            [
                'name' => ['required', 'max:255', 'string'],
                'email' => ['required', 'email', 'max:255'],
                'password' => ['nullable', 'min:7', 'max:255'],
                'identificador_interno' => [Rule::in(AuthEnum::obterValores())]
            ],
            [],
            [
                'name' => 'Nome',
                'email' => 'Email',
                'password' => 'Senha',
                'identificador_interno' => 'Identificador interno'
            ]
        )->validate();
    }
}
