@extends('layouts.app')

@section('titulo', 'Inicio - CB Bellreguard')

@section('contenido')

    {{-- HERO --}}
    <div class="hero">
        <div class="container">
            <h1>Club Basket Bellreguard</h1>
            <p>Pasión por el baloncesto · Temporada {{ date('Y') }}/{{ date('Y') + 1 }}</p>
            <div class="mt-4">
                <a href="{{ route('equipos') }}" class="btn btn-club me-3">Nuestros Equipos</a>
                <a href="{{ route('calendario') }}" class="btn btn-club-outline">Ver Calendario</a>
            </div>
        </div>
    </div>

    <div class="container my-5">

        {{-- NOTICIAS DESTACADAS --}}
        <h2 class="seccion-titulo">Noticias Destacadas</h2>

        @if($noticias->isEmpty())
            <div class="alert" style="background:#f8f8f8; border-left: 4px solid #C8102E; padding: 20px;">
                <i class="fas fa-info-circle" style="color:#C8102E"></i>
                Aún no hay noticias publicadas. El administrador puede añadirlas desde el panel.
            </div>
        @else
            <div class="row g-4 mb-5">
                @foreach($noticias as $noticia)
                    <div class="col-md-4">
                        <div class="card-noticia card">
                            @if($noticia->imagen_url)
                                <img src="{{ $noticia->imagen_url }}" alt="{{ $noticia->titulo }}">
                            @else
                                <div style="height:200px; background: linear-gradient(135deg, #1a1a1a, #C8102E);
                                            display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-basketball" style="font-size:4rem; color:white; opacity:0.5;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <p class="fecha">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $noticia->created_at->format('d/m/Y') }}
                                </p>
                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                <p class="card-text text-muted" style="font-size:0.9rem;">
                                    {{ Str::limit($noticia->contenido, 100) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- ÚLTIMOS RESULTADOS --}}
        <h2 class="seccion-titulo mt-5">Últimos Resultados</h2>

        @if($partidos->isEmpty())
            <div class="alert" style="background:#f8f8f8; border-left: 4px solid #C8102E; padding: 20px;">
                <i class="fas fa-info-circle" style="color:#C8102E"></i>
                Aún no hay partidos registrados.
            </div>
        @else
            @foreach($partidos as $partido)
                <div class="card-partido">
                    <div>
                        <div class="equipo">{{ $partido->equipoLocal->nombre }}</div>
                        <div class="fecha-partido">
                            <i class="fas fa-calendar-alt"></i>
                            {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                            &nbsp;|&nbsp;
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $partido->lugar }}
                        </div>
                    </div>

                    @if($partido->pts_local !== null)
                        <div class="resultado">
                            {{ $partido->pts_local }} - {{ $partido->pts_visitante }}
                        </div>
                    @else
                        <div class="resultado pendiente">Pendiente</div>
                    @endif

                    <div class="equipo text-end">
                        {{ $partido->equipoVisitante->nombre }}
                        <div>
                            <a href="{{ route('estadisticas', $partido->id_partido) }}"
                               class="btn-club-outline mt-1"
                               style="font-size:0.75rem; padding: 4px 12px;">
                                Ver stats
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>

@endsection