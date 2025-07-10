<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagamentoController extends Controller
{
    protected $mercadoPago;

    public function __construct(MercadoPagoService $mercadoPago)
    {
        $this->mercadoPago = $mercadoPago;
    }

    public function iniciar($pedidoId)
    {
        $pedido = Pedido::with('itens.produto')->findOrFail($pedidoId);

        if ($pedido->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            $pagamentoUrl = $this->mercadoPago->criarPagamentoUrl($pedido, true);
            return redirect()->away($pagamentoUrl);
        } catch (\Exception $e) {
            return redirect()->route('pedidos.show', $pedido)
                ->withErrors('Erro no pagamento: ' . $e->getMessage());
        }
    }

    public function notificacao(Request $request)
    {
        \Log::info('Notificação recebida do Mercado Pago: ' . json_encode($request->all()));

        $topic = $request->input('type');
        $id = $request->input('data.id');

        \Log::info("Tipo: $topic | ID: $id");

        if ($topic === 'payment') {
            $response = Http::withToken(config('services.mercadopago.access_token'))
                            ->get("https://api.mercadopago.com/v1/payments/{$id}");

            if ($response->successful()) {
                $pagamento = $response->json();
                \Log::info('Dados do pagamento: ' . json_encode($pagamento));

                $pedidoId = $pagamento['external_reference'] ?? null;
                $status = $pagamento['status'];

                if ($pedidoId) {
                    $pedido = Pedido::find($pedidoId);
                    if ($pedido) {
                        $pedido->status = $status;
                        $pedido->save();
                        \Log::info("Pedido #{$pedidoId} atualizado para status: {$status}");
                    }
                }
            } else {
                \Log::error("Erro ao buscar pagamento: " . $response->body());
            }
        }

        return response()->json(['received' => true]);
    }

    public function sucesso($pedidoId)
    {
        $pedido = Pedido::with('itens.produto')->findOrFail($pedidoId);
        return view('pagamento.sucesso', compact('pedido'));
    }

    public function falha()
    {
        return view('pagamento.falha');
    }

    public function pendente()
    {
        return view('pagamento.pendente');
    }

     public function pagamentoDiretoExemplo(Request $request)
    {
        // Aqui, no real, o token deve vir do front via $request->input('token')
        $token = $request->input('token');

        $body = [
            "transaction_amount" => 100, // pode puxar valor do pedido dinamicamente
            "token" => "bfa6f7edaa3c4c4abdc95b0e2e5c1911",        // token do cartão que vem do front
            "description" => "Produto Teste",
            "installments" => 1,
            "payment_method_id" => "visa",
            "payer" => [
                "email" => "TESTUSER1355271103@testuser.com",
                "identification" => [
                    "type" => "CPF",
                    "number" => "19119119100"
                ]
            ]
        ];

        $response = Http::withToken(config('services.mercadopago.access_token'))
            ->acceptJson()
            ->post('https://api.mercadopago.com/v1/payments', $body);

        return response()->json($response->json());
    }
}
