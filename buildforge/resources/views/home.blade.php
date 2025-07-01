<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BuildForge - Loja de Hardware</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }
        nav.navbar {
            box-shadow: 0 2px 10px rgb(0 0 0 / 0.05);
        }
        header.hero {
            background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
            color: white;
            padding: 6rem 0;
            text-align: center;
            position: relative;
        }
        header.hero h1 {
            font-weight: 700;
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.3);
        }
        header.hero p.lead {
            font-size: 1.3rem;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }
        .btn-primary {
            background-color: #3457d5;
            border: none;
            font-weight: 600;
            padding: 0.85rem 2rem;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(52, 87, 213, 0.4);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #223ba3;
            box-shadow: 0 6px 20px rgba(34, 59, 163, 0.6);
        }

        section.features .card {
            border-radius: 12px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            overflow: hidden;
        }
        section.features .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 16px 35px rgba(0, 0, 0, 0.15);
        }
        section.features .card img {
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        section.features .card-body h5 {
            font-weight: 700;
            font-size: 1.25rem;
        }
        section.features .card-body p {
            color: #555;
            font-size: 1rem;
        }

        footer {
            background-color: #222;
            color: #bbb;
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            header.hero h1 {
                font-size: 2.2rem;
            }
            header.hero p.lead {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">BuildForge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('produtos.index') }}">Produtos</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit" style="text-decoration:none;">Sair <i class="fa-solid fa-right-from-bracket"></i></button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <h1>Seu destino para hardware e periféricos de alta performance</h1>
            <p class="lead">Os melhores componentes para montar seu PC dos sonhos.</p>
            <a href="{{ route('produtos.index') }}" class="btn btn-primary btn-lg shadow-lg">Confira agora</a>
        </div>
    </header>

    <section class="features container my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=600&q=80" alt="Hardware" />
                    <div class="card-body">
                        <h5>Hardware Premium</h5>
                        <p>Componentes de alta qualidade para máxima performance e durabilidade.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=600&q=80" alt="Entrega rápida" />
                    <div class="card-body">
                        <h5>Entrega Rápida</h5>
                        <p>Receba seu pedido no conforto da sua casa, com segurança e rapidez.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1525186402429-7a452f81c9da?auto=format&fit=crop&w=600&q=80" alt="Suporte" />
                    <div class="card-body">
                        <h5>Suporte Especializado</h5>
                        <p>Estamos sempre prontos para tirar suas dúvidas e ajudar você a escolher o melhor.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} BuildForge. Todos os direitos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
