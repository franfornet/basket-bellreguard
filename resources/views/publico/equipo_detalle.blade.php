@extends('layouts.app')

@section('titulo', '{{ $equipo->nombre }} - CB Bellreguard')

@section('contenido')

    <div style="background:var(--negro); padding:40px 0; border-bottom:3px solid var(--rojo);">
        <div class="container">
            <a href="{{ route('equipos') }}"
               style="color:#aaa; text-decoration:none; font-size:0.9rem;">
                ← Volver a Equipos
            </a>
            <h1 style="color:white; font-weight:900; text-transform:uppercase; margin-top:10px;">
                {{ $equipo->nombre }}
            </h1>
            <span style="background:#C8102E; color:white; padding:4px 15px;
                         border-radius:20px; font-size:0.9rem; font-weight:700;">
                {{ $equipo->categoria }}
            </span>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="seccion-titulo">Plantilla</h2>

        @if($equipo->jugadores->isEmpty())
            <div class="alert" style="background:#f8f8f8; border-left:4px solid #C8102E; padding:20px;">
                <i class="fas fa-info-circle" style="color:#C8102E"></i>
                Aún no hay jugadores registrados en este equipo.
            </div>
        @else
            <div class="row g-4">
                @foreach($equipo->jugadores->sortBy('dorsal') as $jugador)
                    <div class="col-6 col-md-3">
                        <div class="card text-center border-0 shadow-sm">
                            @if($jugador->imagen_url)
                                <img src="{{ $jugador->imagen_url }}"
                                     alt="{{ $jugador->nombre }}"
                                     style="height:180px; object-fit:cover;
                                            border-radius:8px 8px 0 0;">
                            @else
                                <div style="height:180px;
                                            background:linear-gradient(135deg,#1a1a1a,#C8102E);
                                            display:flex; align-items:center;
                                            justify-content:center;
                                            border-radius:8px 8px 0 0;">
                                    <i class="fas fa-person"
                                       style="font-size:4rem; color:white; opacity:0.4;"></i>
                                </div>
                            @endif
                            <div class="card-body py-3">
                                <div style="font-size:2rem; font-weight:900; color:#C8102E;">
                                    #{{ $jugador->dorsal }}
                                </div>
                                <div style="font-weight:700; font-size:0.95rem;">
                                    {{ $jugador->nombre }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection