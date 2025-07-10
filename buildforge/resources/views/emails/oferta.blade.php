<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Oferta BuildForge</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #0d1117;
      color: #e5e7eb;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 40px 20px;
    }

    .container {
      max-width: 650px;
      background-color: #1f2937;
      border-radius: 12px;
      padding: 40px;
      margin: 0 auto;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
      border: 1px solid #2d3748;
    }

    h1 {
      color: #f97316;
      text-align: center;
      margin-bottom: 30px;
      font-size: 2rem;
      font-weight: 700;
      text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
      letter-spacing: 0.5px;
    }

    p {
      font-size: 1.2rem;
      line-height: 1.8;
      color: #d1d5db;
      margin-bottom: 20px;
    }

    .botao {
      display: inline-block;
      background-color: #f97316;
      color: #1f2937;
      font-weight: 600;
      text-decoration: none;
      padding: 12px 24px;
      border-radius: 8px;
      transition: background-color 0.3s ease;
      margin: 20px 0;
      text-align: center;
    }

    .botao:hover {
      background-color: #fb923c;
    }

    .footer {
      margin-top: 40px;
      font-size: 1rem;
      text-align: center;
      color: #9ca3af;
      border-top: 1px solid #374151;
      padding-top: 25px;
    }

    @media (max-width: 640px) {
      .container {
        padding: 25px;
      }

      h1 {
        font-size: 1.6rem;
      }

      p {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>🔥 Oferta Especial BuildForge 🔥</h1>

    <p>{!! nl2br(e($mensagem)) !!}</p>

    <div style="text-align: center;">
      <a href="{{ route('produtos.index') }}" class="botao">
        Ver Produtos 🔍
      </a>
    </div>

    <div class="footer">
      <p>Obrigado por ser nosso cliente! 🚀</p>
      <p>BuildForge — Sua melhor escolha em hardware.</p>
    </div>
  </div>
</body>
</html>
