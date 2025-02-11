<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #E3F2FD, #BBDEFB);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(10px);
        }

        .navbar-brand, .nav-link {
            color: #64B5F6 !important;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #42A5F5 !important;
        }

        .nav-link.active {
            color: #2196F3 !important;
            font-weight: bold;
        }

        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #E3F2FD;
        }

        .dropdown-item {
            color: #64B5F6;
        }

        .dropdown-item:hover {
            background: #E3F2FD;
            color: #2196F3;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            box-shadow: 0 4px 15px rgba(144, 202, 249, 0.2);
            border-radius: 15px;
        }

        .card-header {
            background: #90CAF9;
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }

        .btn-primary {
            background: #64B5F6;
            border: none;
            box-shadow: 0 2px 5px rgba(144, 202, 249, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #42A5F5;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(144, 202, 249, 0.4);
        }

        .form-control {
            border: 2px solid #E3F2FD;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #90CAF9;
            box-shadow: 0 0 0 0.25rem rgba(144, 202, 249, 0.25);
        }

        .btn {
            border-radius: 10px;
        }

        .shadow-sm {
            box-shadow: 0 2px 8px rgba(144, 202, 249, 0.15) !important;
        }

        /* Animaciones suaves */
        .card, .btn, .form-control {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(144, 202, 249, 0.25);
        }
    </style>
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                {{ config('app.name', 'Eventos') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}" 
                           href="{{ route('events.index') }}">Eventos</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.create') ? 'active' : '' }}" 
                               href="{{ route('events.create') }}">Crear Evento</a>
                        </li>
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                               data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/events.js') }}"></script>
    @stack('scripts')
</body>
</html>