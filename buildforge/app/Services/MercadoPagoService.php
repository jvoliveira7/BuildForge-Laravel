<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MercadoPagoService
{
    protected $accessToken;
    protected $baseUrl;

    public function __construct()
    {
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

    /**
     * Cria uma preferência de pagamento no Mercado Pago e retorna a URL do checkout.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return string
     * @throws \Exception
     */
    public function criarPagamentoUrl($pedido)
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

        // URLs relativas para as rotas de retorno
        $successUrl = route('pagamento.sucesso', $pedido->id, false);
        $failureUrl = route('pagamento.falha', [], false);
        $pendingUrl = route('pagamento.pendente', [], false);

        $body = [
            'items' => $items,
            'external_reference' => (string) $pedido->id,
            'payer' => [
                'email' => auth()->user()->email,
                'name' => auth()->user()->name,
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
