<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ImperioBarber')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --imperio-gold: #d6a64f;
            --imperio-gold-light: #e2b45f;
            --imperio-dark: #11100e;
            --imperio-card: #191816;
        }

        .panel-banner {
            min-height: 230px;
            display: flex;
            align-items: center;
            padding: 2rem;
            color: #fff;
            border: 1px solid #3d3320;
            border-radius: 1rem;
            background:
                linear-gradient(110deg, rgba(10, 10, 10, .96), rgba(32, 24, 15, .84)),
                url('{{ asset('img/galerias/Barberia.jpeg') }}') center 45% / cover;
        }

        .panel-eyebrow {
            color: var(--imperio-gold-light);
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .panel-highlight {
            color: var(--imperio-gold-light);
        }

        .panel-card {
            height: 100%;
            padding: 1.5rem;
            color: #fff;
            background: var(--imperio-card);
            border: 1px solid #34312b;
            border-radius: .9rem;
            transition: border-color .2s ease, transform .2s ease;
        }

        a.panel-card {
            display: block;
            text-decoration: none;
        }

        a.panel-card:hover {
            color: #fff;
            border-color: var(--imperio-gold);
            transform: translateY(-3px);
        }

        .panel-card-muted {
            color: #b7b2a8;
        }

        .btn-imperio {
            color: #17130b;
            font-weight: 700;
            background: var(--imperio-gold);
            border-color: var(--imperio-gold);
        }

        .btn-imperio:hover {
            color: #17130b;
            background: var(--imperio-gold-light);
            border-color: var(--imperio-gold-light);
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                IMPERIOBARBER
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Abrir navegación">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <div class="navbar-nav me-auto">
                    <a class="nav-link" href="{{ route('galeria') }}">Galería</a>

                    @auth
                        <a class="nav-link" href="{{ route('dashboard') }}">Panel</a>
                        <a class="nav-link" href="{{ route('servicios.index') }}">Servicios</a>
                        <a class="nav-link" href="{{ route('citas.index') }}">Citas</a>

                        @if(auth()->user()->isAdmin() || auth()->user()->isEmpleado())
                            <a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a>
                        @endif

                        @if(auth()->user()->isAdmin())
                            <a class="nav-link" href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                        @endif
                    @endauth
                </div>

                <div class="navbar-nav align-items-lg-center gap-lg-2">
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        <a class="btn btn-outline-light btn-sm" href="{{ route('register') }}">Registrarse</a>
                    @else
                        <span class="navbar-text text-white-50">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Revisa los siguientes errores:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>