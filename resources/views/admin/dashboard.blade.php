@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('contenido')

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="numero">{{ $datos['total_noticias'] }}</div>
                <div class="etiqueta">Noticias</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="numero">{{ $datos['total_equipos'] }}</div>
                <div class="etiqueta">Equipos</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="numero">{{ $datos['total_jugadores'] }}</div>
                <div class="etiqueta">Jugadores</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="numero">{{ $datos['total_partidos'] }}</div>
                <div class="etiqueta">Partidos</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="tabla-admin p-4">
                <h5 style="font-weight:800; margin-bottom:20px;">Accesos Rápidos</h5>
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.noticias.create') }}" class="btn-rojo text-center py-2">
                        <i class="fas fa-plus"></i> Nueva Noticia
                    </a>
                    <a href="{{ route('admin.partidos.create') }}" class="btn-rojo text-center py-2">
                        <i class="fas fa-plus"></i> Nuevo Partido
                    </a>
                    <a href="{{ route('admin.equipos.create') }}" class="btn-rojo text-center py-2">
                        <i class="fas fa-plus"></i> Nuevo Equipo
                    </a>
                    <a href="{{ route('admin.jugadores.create') }}" class="btn-rojo text-center py-2">
                        <i class="fas fa-plus"></i> Nuevo Jugador
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tabla-admin p-4">
                <h5 style="font-weight:800; margin-bottom:20px;">Información</h5>
                <p style="color:#888;">
                    Bienvenido al panel de administración del
                    <strong>Club Basket Bellreguard</strong>.
                    Desde aquí puedes gestionar toda la información de la web.
                </p>
                <a href="{{ route('inicio') }}" target="_blank" class="btn-rojo">
                    <i class="fas fa-eye"></i> Ver web pública
                </a>
            </div>
        </div>
    </div>

@endsection