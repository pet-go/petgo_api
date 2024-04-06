<?php
declare(strict_types=1);

namespace App\Modules\Clientes\Enums;

enum TipoDeContatoEnum: string
{
    case EMAIL = 'e-mail';
    case TELEFONE = 'telefone';

    public static function allValues(): array
    {
        return [
            self::EMAIL->value,
            self::TELEFONE->value
        ];
    }
}
