<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Club Basket Bellreguard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --rojo: #C8102E;
            --negro: #1a1a1a;
            --blanco: #ffffff;
            --gris-oscuro: #2d2d2d;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            color: var(--negro);
        }

        /* ── NAVBAR ── */
        .navbar-club {
            background-color: var(--negro);
            padding: 0;
            border-bottom: 3px solid var(--rojo);
        }

        .navbar-club .navbar-brand {
            color: var(--blanco) !important;
            font-size: 1.3rem;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 15px 20px;
        }

        .navbar-club .nav-link {
            color: #cccccc !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
            padding: 20px 15px !important;
            transition: all 0.2s;
        }

        .navbar-club .nav-link:hover,
        .navbar-club .nav-link.active {
            color: var(--blanco) !important;
            background-color: var(--rojo);
        }

        .navbar-toggler {
            border-color: var(--rojo) !important;
            margin: 10px;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, var(--negro) 0%, var(--gris-oscuro) 50%, var(--rojo) 100%);
            color: var(--blanco);
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .hero p {
            font-size: 1.2rem;
            opacity: 0.85;
            margin-top: 10px;
        }

        /* ── SECCIÓN TÍTULOS ── */
        .seccion-titulo {
            font-size: 1.5rem;
            font-weight: 800;
            text-transform: uppercase;
            color: var(--negro);
            border-left: 4px solid var(--rojo);
            padding-left: 15px;
            margin-bottom: 25px;
        }

        /* ── TARJETAS DE NOTICIAS ── */
        .card-noticia {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }

        .card-noticia:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .card-noticia img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .card-noticia .card-body {
            padding: 20px;
        }

        .card-noticia .card-title {
            font-weight: 700;
            font-size: 1rem;
            color: var(--negro);
        }

        .card-noticia .fecha {
            font-size: 0.8rem;
            color: var(--rojo);
            font-weight: 600;
            margin-bottom: 8px;
        }

        /* ── TARJETAS DE PARTIDOS ── */
        .card-partido {
            background: var(--negro);
            color: var(--blanco);
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-partido .equipo {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .card-partido .resultado {
            background: var(--rojo);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 800;
            font-size: 1.1rem;
        }

        .card-partido .resultado.pendiente {
            background: #555;
            font-size: 0.85rem;
        }

        .card-partido .fecha-partido {
            font-size: 0.8rem;
            color: #aaa;
        }

        /* ── BOTONES ── */
        .btn-club {
            background-color: var(--rojo);
            color: var(--blanco);
            border: none;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 25px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .btn-club:hover {
            background-color: #a00d24;
            color: var(--blanco);
        }

        .btn-club-outline {
            border: 2px solid var(--rojo);
            color: var(--rojo);
            background: transparent;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 20px;
            border-radius: 4px;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-club-outline:hover {
            background: var(--rojo);
            color: var(--blanco);
        }

        /* ── FOOTER ── */
        footer {
            background-color: var(--negro);
            color: #aaaaaa;
            padding: 40px 0 20px;
            margin-top: 60px;
            border-top: 3px solid var(--rojo);
        }

        footer h5 {
            color: var(--blanco);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
        }

        footer a {
            color: #aaaaaa;
            text-decoration: none;
            transition: color 0.2s;
        }

        footer a:hover { color: var(--rojo); }

        .footer-social a {
            font-size: 1.5rem;
            margin-right: 15px;
            color: #aaaaaa;
        }

        .footer-social a:hover { color: var(--rojo); }

        .footer-bottom {
            border-top: 1px solid #333;
            margin-top: 30px;
            padding-top: 20px;
            text-align: center;
            font-size: 0.85rem;
        }

        /* ── PANEL ADMIN ── */
        .admin-sidebar {
            background: var(--negro);
            min-height: 100vh;
            padding: 20px 0;
        }

        .admin-sidebar .nav-link {
            color: #cccccc;
            padding: 12px 20px;
            font-weight: 600;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: var(--blanco);
            background: var(--rojo);
        }

        .admin-sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
    </style>
    @yield('estilos')
</head>
<body>

    {{-- ── NAVBAR ── --}}
    <nav class="navbar navbar-expand-lg navbar-club">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">
                🏀 CB BELLREGUARD
            </a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}"
                           href="{{ route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('equipos*') ? 'active' : '' }}"
                           href="{{ route('equipos') }}">Equipos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('calendario') ? 'active' : '' }}"
                           href="{{ route('calendario') }}">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                           href="{{ route('login') }}">
                            <i class="fas fa-lock"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ── CONTENIDO DE CADA PÁGINA ── --}}
    @yield('contenido')

    {{-- ── FOOTER ── --}}
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>🏀 CB Bellreguard</h5>
                    <p>Club de Basket de Bellreguard. Formando jugadores y personas desde nuestra fundación.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Navegación</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('inicio') }}">Inicio</a></li>
                        <li><a href="{{ route('equipos') }}">Equipos</a></li>
                        <li><a href="{{ route('calendario') }}">Calendario</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Síguenos</h5>
                    <div class="footer-social">
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" title="Twitter/X"><i class="fab fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Club Basket Bellreguard. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>