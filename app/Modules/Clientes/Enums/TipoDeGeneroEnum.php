<?php

declare(strict_types= 1);

namespace App\Modules\Clientes\Enums;

enum TipoDeGeneroEnum: string
{
    case MASCULINO = "Masculino";
    case FEMININO = "Feminino";
    case OUTRO = "Outro";

    public static function obterValores(): array
    {
        return [
            self::MASCULINO->value,
            self::FEMININO->value,
            self::OUTRO->value,
        ];
    }
}