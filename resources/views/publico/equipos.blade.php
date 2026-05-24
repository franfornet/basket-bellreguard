@extends('layouts.app')

@section('titulo', 'Equipos - CB Bellreguard')

@section('contenido')

    <div style="background: var(--negro); padding: 40px 0; border-bottom: 3px solid var(--rojo);">
        <div class="container">
            <h1 style="color:white; font-weight:900; text-transform:uppercase;">
                Nuestros Equipos
            </h1>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="seccion-titulo">Equipos del Club</h2>

        @if($equipos->isEmpty())
            <div class="alert" style="background:#f8f8f8; border-left:4px solid #C8102E; padding:20px;">
                <i class="fas fa-info-circle" style="color:#C8102E"></i>
                Aún no hay equipos registrados.
            </div>
        @else
            <div class="row g-4">
                @foreach($equipos as $equipo)
                    <div class="col-md-4">
                        <div class="card-noticia card text-center">
                            @if($equipo->image_url)
                                <img src="{{ $equipo->image_url }}"
                                     alt="{{ $equipo->nombre }}"
                                     style="height:200px; object-fit:cover;">
                            @else
                                <div style="height:200px; background:linear-gradient(135deg,#1a1a1a,#C8102E);
                                            display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-shield-halved"
                                       style="font-size:4rem; color:white; opacity:0.5;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $equipo->nombre }}</h5>
                                <span style="background:#C8102E; color:white; padding:3px 12px;
                                             border-radius:20px; font-size:0.8rem; font-weight:700;">
                                    {{ $equipo->categoria }}
                                </span>
                                <div class="mt-3">
                                    <a href="{{ route('equipo.detalle', $equipo->id_equipo) }}"
                                       class="btn-club-outline">
                                        Ver Plantilla
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection