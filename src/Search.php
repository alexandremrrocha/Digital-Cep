<?php

namespace Alexandre\DigitalCep;

class Search
{
    private $url = "https://viacep.com.br/ws/";

    public function getAddressFromZipcode(string $zipCode)
    {
        // Mantém apenas dígitos
        $zipCode = preg_replace('/\D/', '', $zipCode);

        // CEP deve conter 8 dígitos
        if (strlen($zipCode) !== 8) {
            return (object) [
                'erro' => true,
                'mensagem' => 'CEP inválido. Informe 8 dígitos.'
            ];
        }

        $url = $this->url . $zipCode . "/json";

        // Contexto com timeout para evitar travas
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'timeout' => 5,
                'ignore_errors' => true,
                'header' => [
                    'Accept: application/json'
                ]
            ]
        ]);

        $get = @file_get_contents($url, false, $context);

        if ($get === false) {
            return (object) [
                'erro' => true,
                'mensagem' => 'Falha ao conectar ao serviço ViaCEP.'
            ];
        }

        $decoded = json_decode($get);
        if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
            return (object) [
                'erro' => true,
                'mensagem' => 'Resposta inválida do serviço ViaCEP.'
            ];
        }

        return $decoded;
    }
}
