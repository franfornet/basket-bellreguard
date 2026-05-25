<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Bàsquet Bellreguard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800;900&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --rojo: #8B1A1A;
            --rojo-vivo: #C8102E;
            --negro: #0f0f0f;
            --gris: #1c1c1c;
            --gris-medio: #2a2a2a;
            --blanco: #ffffff;
            --crema: #f9f7f4;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Barlow', sans-serif;
            background-color: var(--crema);
            color: var(--negro);
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Barlow Condensed', sans-serif;
        }

        /* ── NAVBAR ── */
        .navbar-club {
            background-color: var(--negro);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.5);
        }

        .navbar-club .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
        }

        .navbar-brand img {
            height: 52px;
            width: 52px;
            object-fit: contain;
        }

        .navbar-brand .club-nombre {
            display: flex;
            flex-direction: column;
            line-height: 1;
        }

        .navbar-brand .club-nombre span:first-child {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--rojo-vivo);
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .navbar-brand .club-nombre span:last-child {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--blanco);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .navbar-club .nav-link {
            color: #888 !important;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.95rem;
            letter-spacing: 2px;
            padding: 28px 18px !important;
            position: relative;
            transition: color 0.2s;
        }

        .navbar-club .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--rojo-vivo);
            transform: scaleX(0);
            transition: transform 0.2s;
        }

        .navbar-club .nav-link:hover,
        .navbar-club .nav-link.active {
            color: var(--blanco) !important;
        }

        .navbar-club .nav-link:hover::after,
        .navbar-club .nav-link.active::after {
            transform: scaleX(1);
        }

        .navbar-toggler {
            border: none !important;
            padding: 10px;
        }

        .navbar-toggler:focus { box-shadow: none !important; }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.8%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        /* ── HERO ── */
        .hero {
            background-color: var(--negro);
            background-image:
                radial-gradient(ellipse at 20% 50%, rgba(139,26,26,0.4) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 50%, rgba(139,26,26,0.2) 0%, transparent 60%);
            color: var(--blanco);
            padding: 90px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--rojo-vivo), transparent);
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--rojo-vivo), transparent);
        }

        .hero-logo {
            width: 130px;
            height: 130px;
            object-fit: contain;
            margin-bottom: 25px;
            filter: drop-shadow(0 0 30px rgba(200,16,46,0.4));
        }

        .hero h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 3.8rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 4px;
            line-height: 1;
            margin-bottom: 10px;
        }

        .hero h1 span {
            color: var(--rojo-vivo);
        }

        .hero p {
            font-size: 1rem;
            color: #888;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 35px;
        }

        /* ── SECCIÓN TÍTULOS ── */
        .seccion-titulo {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            text-transform: uppercase;
            color: var(--negro);
            letter-spacing: 2px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .seccion-titulo::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 30px;
            background: var(--rojo-vivo);
            border-radius: 2px;
        }

        /* ── TARJETAS NOTICIAS ── */
        .card-noticia {
            border: none;
            border-radius: 4px;
            overflow: hidden;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: transform 0.25s, box-shadow 0.25s;
            height: 100%;
        }

        .card-noticia:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        .card-noticia img {
            height: 210px;
            object-fit: cover;
            width: 100%;
        }

        .card-noticia .card-body { padding: 22px; }

        .card-noticia .fecha {
            font-size: 0.75rem;
            color: var(--rojo-vivo);
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .card-noticia .card-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--negro);
            line-height: 1.2;
        }

        /* ── PARTIDOS ── */
        .card-partido {
            background: white;
            border-radius: 4px;
            padding: 16px 22px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border-left: 3px solid transparent;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .card-partido:hover {
            border-left-color: var(--rojo-vivo);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card-partido .equipo {
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            color: var(--negro);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .card-partido .resultado {
            background: var(--negro);
            color: white;
            padding: 6px 18px;
            border-radius: 2px;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: 2px;
        }

        .card-partido .resultado.pendiente {
            background: #e0e0e0;
            color: #888;
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        .card-partido .meta {
            font-size: 0.78rem;
            color: #aaa;
            margin-top: 3px;
            letter-spacing: 1px;
        }

        /* ── BOTONES ── */
        .btn-club {
            background-color: var(--rojo-vivo);
            color: var(--blanco);
            border: none;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 12px 30px;
            border-radius: 2px;
            font-size: 0.95rem;
            transition: background 0.2s;
            display: inline-block;
            text-decoration: none;
        }

        .btn-club:hover {
            background-color: var(--rojo);
            color: var(--blanco);
        }

        .btn-club-outline {
            border: 2px solid rgba(255,255,255,0.4);
            color: var(--blanco);
            background: transparent;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 10px 28px;
            border-radius: 2px;
            font-size: 0.95rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-club-outline:hover {
            border-color: white;
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .btn-ver-stats {
            border: 1px solid #ddd;
            color: #666;
            background: transparent;
            font-family: 'Barlow Condensed', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 14px;
            border-radius: 2px;
            font-size: 0.8rem;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-ver-stats:hover {
            border-color: var(--rojo-vivo);
            color: var(--rojo-vivo);
        }

        /* ── FOOTER ── */
        footer {
            background-color: var(--negro);
            color: #555;
            padding: 50px 0 25px;
            margin-top: 80px;
        }

        footer h5 {
            font-family: 'Barlow Condensed', sans-serif;
            color: var(--blanco);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            margin-bottom: 18px;
        }

        footer a {
            color: #555;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
            display: block;
            margin-bottom: 6px;
        }

        footer a:hover { color: var(--rojo-vivo); }

        .footer-social a {
            font-size: 1.3rem;
            margin-right: 18px;
            display: inline-block;
            color: #444;
        }

        .footer-social a:hover { color: var(--rojo-vivo); }

        .footer-divider {
            border-color: #1a1a1a;
            margin: 35px 0 20px;
        }

        .footer-bottom {
            text-align: center;
            font-size: 0.8rem;
            color: #333;
        }

        .footer-logo {
            width: 55px;
            opacity: 0.6;
            margin-bottom: 12px;
        }
    </style>
    @yield('estilos')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-club">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">
                <img src="/images/logo.png" alt="Logo CB Bellreguard">
                <div class="club-nombre">
                    <span>Club de</span>
                    <span>Bellreguard</span>
                </div>
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
                            <i class="fas fa-lock" style="font-size:0.8rem;"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('contenido')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <img src="/images/logo.png" alt="Logo" class="footer-logo">
                    <h5>Bàsquet Bellreguard</h5>
                    <p style="font-size:0.88rem; line-height:1.7;">
                        Club de bàsquet fundat el 2022.<br>
                        Formant jugadors i persones.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Navegació</h5>
                    <a href="{{ route('inicio') }}">Inici</a>
                    <a href="{{ route('equipos') }}">Equips</a>
                    <a href="{{ route('calendario') }}">Calendari</a>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Segueix-nos</h5>
                    <div class="footer-social mt-2">
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" title="Twitter/X"><i class="fab fa-x-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Bàsquet Bellreguard · Tots els drets reservats</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>