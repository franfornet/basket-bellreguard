@extends('layouts.app')

@section('titulo', 'Estadísticas - CB Bellreguard')

@section('contenido')

    <div style="background:var(--negro); padding:40px 0; border-bottom:3px solid var(--rojo);">
        <div class="container">
            <a href="{{ route('calendario') }}"
               style="color:#aaa; text-decoration:none; font-size:0.9rem;">
                ← Volver al Calendario
            </a>
            <h1 style="color:white; font-weight:900; margin-top:10px;">
                {{ $partido->equipoLocal->nombre }}
                <span style="color:#C8102E;">vs</span>
                {{ $partido->equipoVisitante->nombre }}
            </h1>
            <p style="color:#aaa;">
                {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                &nbsp;·&nbsp; {{ $partido->lugar }}
            </p>
        </div>
    </div>

    <div class="container my-5">

        {{-- MARCADOR --}}
        <div class="text-center mb-5">
            <div style="background:var(--negro); border-radius:12px;
                        padding:30px; display:inline-block; min-width:400px;">
                <div style="color:#aaa; font-size:0.85rem; text-transform:uppercase;
                            letter-spacing:2px; margin-bottom:10px;">Resultado Final</div>
                <div style="display:flex; align-items:center; justify-content:center; gap:20px;">
                    <div style="color:white; font-weight:700; font-size:1rem; text-align:center;">
                        {{ $partido->equipoLocal->nombre }}
                    </div>
                    <div style="color:#C8102E; font-size:3rem; font-weight:900;">
                        @if($partido->pts_local !== null)
                            {{ $partido->pts_local }} - {{ $partido->pts_visitante }}
                        @else
                            <span style="font-size:1.5rem; color:#555;">Pendiente</span>
                        @endif
                    </div>
                    <div style="color:white; font-weight:700; font-size:1rem; text-align:center;">
                        {{ $partido->equipoVisitante->nombre }}
                    </div>
                </div>
            </div>
        </div>

        @if(!$local && !$visitante)
            <div class="alert" style="background:#f8f8f8; border-left:4px solid #C8102E; padding:20px;">
                <i class="fas fa-info-circle" style="color:#C8102E"></i>
                Aún no se han introducido las estadísticas de este partido.
            </div>
        @else
            {{-- EFICIENCIAS --}}
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div style="background:var(--negro); border-radius:8px; padding:20px; color:white;">
                        <h5 style="color:#aaa; font-size:0.85rem; text-transform:uppercase;">
                            {{ $partido->equipoLocal->nombre }}
                        </h5>
                        <div class="row mt-3">
                            <div class="col-6 text-center">
                                <div style="font-size:2rem; font-weight:900; color:#C8102E;">
                                    {{ $local ? number_format($local->eficienciaAtaque(), 3) : '-' }}
                                </div>
                                <div style="font-size:0.8rem; color:#aaa;">Efic. Ataque</div>
                            </div>
                            <div class="col-6 text-center">
                                <div style="font-size:2rem; font-weight:900; color:#4CAF50;">
                                    {{ $visitante ? number_format($visitante->eficienciaAtaque(), 3) : '-' }}
                                </div>
                                <div style="font-size:0.8rem; color:#aaa;">Efic. Defensa</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="background:var(--negro); border-radius:8px; padding:20px; color:white;">
                        <h5 style="color:#aaa; font-size:0.85rem; text-transform:uppercase;">
                            {{ $partido->equipoVisitante->nombre }}
                        </h5>
                        <div class="row mt-3">
                            <div class="col-6 text-center">
                                <div style="font-size:2rem; font-weight:900; color:#C8102E;">
                                    {{ $visitante ? number_format($visitante->eficienciaAtaque(), 3) : '-' }}
                                </div>
                                <div style="font-size:0.8rem; color:#aaa;">Efic. Ataque</div>
                            </div>
                            <div class="col-6 text-center">
                                <div style="font-size:2rem; font-weight:900; color:#4CAF50;">
                                    {{ $local ? number_format($local->eficienciaAtaque(), 3) : '-' }}
                                </div>
                                <div style="font-size:0.8rem; color:#aaa;">Efic. Defensa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABLA DE ESTADÍSTICAS COMPLETA --}}
            <h2 class="seccion-titulo">Estadísticas Detalladas</h2>
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead style="background:var(--negro); color:white;">
                        <tr>
                            <th style="text-align:left;">Estadística</th>
                            <th>{{ $partido->equipoLocal->nombre }}</th>
                            <th>{{ $partido->equipoVisitante->nombre }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $stats = [
                                'puntos_anotados'   => 'Puntos Anotados',
                                't2_anotados'       => 'T2 Anotados',
                                't2_intentados'     => 'T2 Intentados',
                                't3_anotados'       => 'T3 Anotados',
                                't3_intentados'     => 'T3 Intentados',
                                't1_anotados'       => 'T1 Anotados',
                                't1_intentados'     => 'T1 Intentados',
                                'rebotes_ofensivos' => 'Rebotes Ofensivos',
                                'rebotes_defensivos'=> 'Rebotes Defensivos',
                                'asistencias'       => 'Asistencias',
                                'robos'             => 'Robos',
                                'tapones'           => 'Tapones',
                                'balones_perdidos'  => 'Balones Perdidos',
                                'faltas'            => 'Faltas',
                            ];
                        @endphp

                        @foreach($stats as $campo => $etiqueta)
                            <tr>
                                <td style="text-align:left; font-weight:600;">
                                    {{ $etiqueta }}
                                </td>
                                <td>{{ $local ? $local->$campo : '-' }}</td>
                                <td>{{ $visitante ? $visitante->$campo : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection