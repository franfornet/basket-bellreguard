<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Admin - CB Bellreguard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --rojo: #C8102E;
            --negro: #1a1a1a;
        }
        body { background: #f4f4f4; }

        .admin-sidebar {
            background: var(--negro);
            min-height: 100vh;
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            padding-top: 20px;
            z-index: 100;
        }

        .admin-sidebar .marca {
            color: white;
            font-weight: 900;
            font-size: 1.1rem;
            padding: 15px 20px 25px;
            border-bottom: 2px solid var(--rojo);
            display: block;
        }

        .admin-sidebar .nav-link {
            color: #aaaaaa;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: white;
            background: var(--rojo);
        }

        .admin-sidebar .nav-link i { width: 18px; text-align: center; }

        .admin-sidebar .seccion-label {
            color: #555;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 20px 20px 8px;
        }

        .admin-contenido {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .admin-topbar {
            background: white;
            padding: 15px 30px;
            margin-left: 250px;
            border-bottom: 3px solid var(--rojo);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .admin-topbar h4 { margin: 0; font-weight: 800; color: var(--negro); }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.07);
            border-left: 4px solid var(--rojo);
        }

        .stat-card .numero {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--rojo);
        }

        .stat-card .etiqueta {
            color: #888;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tabla-admin {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0,0,0,0.07);
        }

        .tabla-admin thead {
            background: var(--negro);
            color: white;
        }

        .btn-rojo {
            background: var(--rojo);
            color: white;
            border: none;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-rojo:hover { background: #a00d24; color: white; }
    </style>
    @yield('estilos')
</head>
<body>

    {{-- SIDEBAR --}}
    <div class="admin-sidebar">
        <span class="marca">🏀 CB Bellreguard</span>

        <div class="seccion-label">General</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-gauge"></i> Dashboard
        </a>

        <a href="{{ route('inicio') }}" class="nav-link" target="_blank">
            <i class="fas fa-eye"></i> Ver Web
        </a>

        <div class="seccion-label">Gestión</div>
        <a href="{{ route('admin.noticias.index') }}"
           class="nav-link {{ request()->routeIs('admin.noticias*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Noticias
        </a>
        <a href="{{ route('admin.equipos.index') }}"
           class="nav-link {{ request()->routeIs('admin.equipos*') ? 'active' : '' }}">
            <i class="fas fa-shield-halved"></i> Equipos
        </a>
        <a href="{{ route('admin.jugadores.index') }}"
           class="nav-link {{ request()->routeIs('admin.jugadores*') ? 'active' : '' }}">
            <i class="fas fa-person"></i> Jugadores
        </a>
        <a href="{{ route('admin.partidos.index') }}"
           class="nav-link {{ request()->routeIs('admin.partidos*') ? 'active' : '' }}">
            <i class="fas fa-basketball"></i> Partidos
        </a>

        <div class="seccion-label">Sesión</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
                <i class="fas fa-right-from-bracket"></i> Cerrar Sesión
            </button>
        </form>
    </div>

    {{-- TOPBAR --}}
    <div class="admin-topbar">
        <h4>@yield('titulo', 'Dashboard')</h4>
        <span style="color:#888; font-size:0.9rem;">
            <i class="fas fa-user-shield" style="color:var(--rojo)"></i>
            {{ session('admin_nombre', 'Admin') }}
        </span>
    </div>

    {{-- CONTENIDO --}}
    <div class="admin-contenido">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>