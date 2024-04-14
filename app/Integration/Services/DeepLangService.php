<?php

declare(strict_types=1);

namespace App\Integration\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Lang;

class DeepLangService
{
    /**
     * Retorna logs traduzidos
     * @param string $header
     * @param string $message
     * @return array<string>
     */
    public static function fixLang(string $header, string $message): array
    {
        $client = new Client();
        $payload = [
            'dataformat' => 'JSON',
            'source_language' => 'EN',
            'target_language' => Lang::getLocale(),
            'glossary' => 100,
            'selections' => '[{"path": "header", "format": "Text"}, {"path": "intro", "format": "HTML"}]',
            'text' => json_encode([
                'header' => $header,
                'intro' => $message
            ])
        ];
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'query' => [
                'auth_key' => config('services.translator.key')
            ],
            'json' => $payload
        ];
        $response = $client->post(config('services.translator.url'), $options);
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        return $data;
    }
}
