<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PagSeguroService
{
    protected $email;
    protected $token;
    protected $baseUrl;

    public function __construct()
    {
        $this->email = config('pagseguro.email');
        $this->token = config('pagseguro.token');
        $this->baseUrl = config('pagseguro.base_url');
    }

    public function gerarPagamento(array $dados)
    {
        $response = Http::asForm()->post("{$this->baseUrl}/v2/checkout", array_merge($dados, [
            'email' => $this->email,
            'token' => $this->token,
        ]));

        if ($response->successful()) {
            $xml = simplexml_load_string($response->body());
            return (string) $xml->code;
        }

        return null;
    }
}
