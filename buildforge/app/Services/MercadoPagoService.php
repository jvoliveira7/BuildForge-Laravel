<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MercadoPagoService
{
    protected $accessToken;

    public function __construct()
    {
        $this->accessToken = config('services.mercadopago.access_token');

        if (!$this->accessToken) {
            throw new \Exception('Access Token do Mercado Pago não configurado.');
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
                'success' => route('pagamento.sucesso', $pedido->id),
                'failure' => route('pagamento.falha'),
                'pending' => route('pagamento.pendente'),
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
