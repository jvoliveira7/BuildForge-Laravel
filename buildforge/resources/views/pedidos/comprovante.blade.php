<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Comprovante Pedido #{{ $pedido->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Comprovante do Pedido #{{ $pedido->id }}</h1>
    <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($pedido->status) }}</p>

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

    <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
</body>
</html>
