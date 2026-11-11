<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImperioBarber</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                IMPERIOBARBER
            </a>

            <div class="d-flex align-items-center">
                {{-- Solo administrador y empleado ven estos enlaces --}}
                @role('administrador', 'empleado')
                <div class="navbar-nav flex-row">
                    <a class="nav-link me-3" href="{{ route('servicios.index') }}">Servicios</a>
                    <a class="nav-link me-3" href="{{ route('clientes.index') }}">Clientes</a>
                </div>
                @endrole

                {{-- Solo administrador --}}
                @if (auth()->check() && auth()->user()->isAdmin())
                <div class="navbar-nav flex-row">
                    <a class="nav-link me-3" href="{{ route('franjas.index') }}">Franjas</a>
                    <a class="nav-link me-3" href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                </div>
                @endif

                {{-- Con sesión iniciada, y no en la bienvenida --}}
                @auth
                @unless(request()->routeIs('home'))
                <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center ms-2">
                    @csrf
                    <span class="navbar-text me-2">{{ auth()->user()->name }}</span>
                    <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                </form>
                @endunless
                @endauth
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