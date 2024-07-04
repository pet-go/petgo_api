<?php
namespace App\Helpers;

class Helper 
{
    /**
     * Tratar exception para dados duplicados
     * 
     * @return array|null
     */
    public static function TratarExceptionComDadosDuplicados(string $errorMessage): ?array
    {
        $pattern = "/Duplicate entry '(.+)' for key '(.+)'/";
        preg_match($pattern, $errorMessage, $matches);
        if (isset($matches[1]) && isset($matches[2])) {
            return [
                'error' => 'Dados duplicados!',
                'conflito' => $matches[1],
                'chave' => $matches[2]
            ];
        }
        return null;
    }
}
