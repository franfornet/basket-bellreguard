@extends('layouts.app')

@section('titulo', 'Inici - Bàsquet Bellreguard')

@section('contenido')

    <div class="hero">
        <div class="container">
            <img src="/images/logo.png" alt="Logo" class="hero-logo">
            <h1>Bàsquet <span>Bellreguard</span></h1>
            <p>Temporada {{ date('Y') }} · {{ date('Y') + 1 }}</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('equipos') }}" class="btn-club">Els nostres equips</a>
                <a href="{{ route('calendario') }}" class="btn-club-outline">Calendari</a>
            </div>
        </div>
    </div>

    <div class="container" style="padding-top: 60px; padding-bottom: 20px;">

        <h2 class="seccion-titulo">Notícies</h2>

        @if($noticias->isEmpty())
            <p style="color:#aaa; font-size:0.95rem; margin-bottom:50px;">
                Aviat hi haurà notícies publicades.
            </p>
        @else
            <div class="row g-4 mb-5">
                @foreach($noticias as $noticia)
                    <div class="col-md-4">
                        <div class="card-noticia">
                            @if($noticia->imagen_url)
                                <img src="{{ $noticia->imagen_url }}" alt="{{ $noticia->titulo }}">
                            @else
                                <div style="height:210px; background:var(--negro);
                                            display:flex; align-items:center; justify-content:center;">
                                    <img src="/images/logo.png" style="height:70px; opacity:0.2;">
                                </div>
                            @endif
                            <div class="card-body">
                                <p class="fecha">
                                    {{ $noticia->created_at->format('d M Y') }}
                                </p>
                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                <p style="color:#888; font-size:0.88rem; margin-top:8px; line-height:1.6;">
                                    {{ Str::limit($noticia->contenido, 100) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <h2 class="seccion-titulo mt-4">Últims Resultats</h2>

        @if($partidos->isEmpty())
            <p style="color:#aaa; font-size:0.95rem;">
                Encara no hi ha partits registrats.
            </p>
        @else
            <div style="max-width: 750px;">
                @foreach($partidos as $partido)
                    <div class="card-partido">
                        <div>
                            <div class="equipo">{{ $partido->equipoLocal->nombre }}</div>
                            <div class="meta">
                                {{ \Carbon\Carbon::parse($partido->fecha)->format('d M Y') }}
                                · {{ $partido->lugar }}
                            </div>
                        </div>

                        @if($partido->pts_local !== null)
                            <div class="resultado">
                                {{ $partido->pts_local }} — {{ $partido->pts_visitante }}
                            </div>
                        @else
                            <div class="resultado pendiente">Pendent</div>
                        @endif

                        <div style="text-align:right;">
                            <div class="equipo">{{ $partido->equipoVisitante->nombre }}</div>
                            <div class="meta" style="margin-top:6px;">
                                <a href="{{ route('estadisticas', $partido->id_partido) }}"
                                   class="btn-ver-stats">
                                    Estadístiques
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

@endsection