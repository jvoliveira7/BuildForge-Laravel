<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            background: white;
            margin: 0.5rem 0;
            padding: 1rem;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }
        a {
            display: inline-block;
            margin-top: 1.5rem;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Lista de Produtos</h1>

    <ul>
        @foreach ($produtos as $produto)
            <li>{{ $produto->nome }}</li>
        @endforeach
    </ul>

    <a href="{{ route('home') }}">Voltar para Home</a>
</body>
</html>
