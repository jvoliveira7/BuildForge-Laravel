<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Comprovante Pedido #{{ $pedido->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            margin: 5px 0;
        }

        .cliente {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>BuildForge - Comprovante de Pedido</h1>

    <div class="cliente">
        <p><strong>Nº do Pedido:</strong> {{ $pedido->id }}</p>
        <p><strong>Cliente:</strong> {{ $pedido->user->name ?? '—' }}</p>
        <p><strong>Email:</strong> {{ $pedido->user->email ?? '—' }}</p>
        <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($pedido->status) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->itens as $item)
            <tr>
                <td>{{ $item->produto->nome ?? 'Produto removido' }}</td>
                <td>{{ $item->quantidade }}</td>
                <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($item->preco_unitario * $item->quantidade, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total do Pedido: R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

    <div class="footer">
        Obrigado por comprar com a BuildForge. Este é um comprovante automático.
    </div>
</body>
</html>
