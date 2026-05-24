@extends('layouts.app')

@section('titulo', 'Calendario - CB Bellreguard')

@section('contenido')

    <div style="background:var(--negro); padding:40px 0; border-bottom:3px solid var(--rojo);">
        <div class="container">
            <h1 style="color:white; font-weight:900; text-transform:uppercase;">
                Calendario y Resultados
            </h1>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="seccion-titulo">Todos los Partidos</h2>

        @if($partidos->isEmpty())
            <div class="alert" style="background:#f8f8f8; border-left:4px solid #C8102E; padding:20px;">
                <i class="fas fa-info-circle" style="color:#C8102E"></i>
                Aún no hay partidos registrados.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead style="background:var(--negro); color:white;">
                        <tr>
                            <th>Fecha</th>
                            <th>Local</th>
                            <th class="text-center">Resultado</th>
                            <th>Visitante</th>
                            <th>Lugar</th>
                            <th class="text-center">Stats</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partidos as $partido)
                            <tr>
                                <td>
                                    <strong>
                                        {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                                    </strong>
                                </td>
                                <td>{{ $partido->equipoLocal->nombre }}</td>
                                <td class="text-center">
                                    @if($partido->pts_local !== null)
                                        <span style="background:#C8102E; color:white;
                                                     padding:4px 14px; border-radius:20px;
                                                     font-weight:800;">
                                            {{ $partido->pts_local }} - {{ $partido->pts_visitante }}
                                        </span>
                                    @else
                                        <span style="background:#555; color:white;
                                                     padding:4px 14px; border-radius:20px;
                                                     font-size:0.8rem;">
                                            Pendiente
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $partido->equipoVisitante->nombre }}</td>
                                <td>
                                    <i class="fas fa-map-marker-alt" style="color:#C8102E;"></i>
                                    {{ $partido->lugar }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('estadisticas', $partido->id_partido) }}"
                                       class="btn-club-outline"
                                       style="font-size:0.8rem; padding:4px 12px;">
                                        <i class="fas fa-chart-bar"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection