<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MercadoPagoService
{
    protected $accessToken;
    protected $baseUrl;

    public function __construct()
    {
        // Pega o token diretamente do config('services.mercadopago.access_token')
        $this->accessToken = config('services.mercadopago.access_token');

        // Pega a URL base do ngrok ou usa APP_URL como fallback
        $ngrokUrl = config('ngrok.ngrok_url');
        $this->baseUrl = rtrim($ngrokUrl ?: config('app.url'), '/');

        if (!$this->accessToken) {
            throw new \Exception('Access Token do Mercado Pago não configurado.');
        }
        if (!$this->baseUrl) {
            throw new \Exception('URL base do sistema não configurada.');
        }
    }

    public function criarPagamentoUrl($pedido, $usarEmailTeste = false)
    {
        $url = 'https://api.mercadopago.com/checkout/preferences';

        $items = [];
        foreach ($pedido->itens as $item) {
            $items[] = [
                'title' => $item->produto->nome,
                'quantity' => $item->quantidade,
                'unit_price' => (float) $item->preco_unitario,
                'currency_id' => 'BRL',
            ];
        }

        $successUrl = route('pagamento.sucesso', $pedido->id, false);
        $failureUrl = route('pagamento.falha', [], false);
        $pendingUrl = route('pagamento.pendente', [], false);

        $payerEmail = $usarEmailTeste ? 'TESTUSER2021201970@testuser.com' : auth()->user()->email;
        $payerName = $usarEmailTeste ? 'Comprador 1' : auth()->user()->name;

        $body = [
            'items' => $items,
            'external_reference' => (string) $pedido->id,
            'payer' => [
                'email' => $payerEmail,
                'name' => $payerName,
            ],
            'payment_methods' => [
                'excluded_payment_types' => [
                    ['id' => 'ticket'],
                    ['id' => 'atm'],
                ],
                'installments' => 1,
            ],
            'back_urls' => [
                'success' => $this->baseUrl . $successUrl,
                'failure' => $this->baseUrl . $failureUrl,
                'pending' => $this->baseUrl . $pendingUrl,
            ],
            'auto_return' => 'approved',
        ];

        $response = Http::withToken($this->accessToken)
            ->acceptJson()
            ->post($url, $body);

        if ($response->successful()) {
            $json = $response->json();
            if (isset($json['init_point'])) {
                return $json['init_point'];
            }
            throw new \Exception('Resposta inesperada da API Mercado Pago.');
        }

        throw new \Exception("Erro ao criar pagamento: " . $response->body());
    }
}
