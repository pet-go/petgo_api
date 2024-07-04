<?php

namespace App\Modules\Auth\Enums;

Enum AuthEnum: string {
    case ADMIN = 'Admin';
    case CLIENTE = 'Cliente';

    public static function obterValores(): array
    {
        return [
            self::ADMIN->value,
            self::CLIENTE->value
        ];
    }
}