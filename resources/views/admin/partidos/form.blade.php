@extends('layouts.admin')
@section('titulo', $partido ? 'Editar Partido' : 'Nuevo Partido')
@section('contenido')

    <div class="mb-4">
        <a href="{{ route('admin.partidos.index') }}" style="color:#888; text-decoration:none;">
            ← Volver a Partidos
        </a>
    </div>

    <form method="POST" action="{{ $partido
        ? route('admin.partidos.update', $partido->id_partido)
        : route('admin.partidos.store') }}">
        @csrf
        @if($partido) @method('PUT') @endif

        {{-- DATOS DEL PARTIDO --}}
        <div class="tabla-admin p-4 mb-4">
            <h4 style="font-weight:800; margin-bottom:20px;">
                <i class="fas fa-basketball" style="color:#C8102E;"></i>
                Datos del Partido
            </h4>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Fecha</label>
                    <input type="date" name="fecha" class="form-control"
                           value="{{ old('fecha', $partido?->fecha) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Lugar</label>
                    <input type="text" name="lugar" class="form-control"
                           value="{{ old('lugar', $partido?->lugar) }}"
                           placeholder="Pabellón Municipal..." required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Temporada</label>
                    <select name="id_temporada" class="form-select" required>
                        @foreach($temporadas as $temporada)
                            <option value="{{ $temporada->id_temporada }}"
                                {{ old('id_temporada', $partido?->id_temporada) == $temporada->id_temporada ? 'selected' : '' }}>
                                {{ $temporada->anyo_inicio }}/{{ $temporada->anyo_fin }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Equipo Local</label>
                    <select name="id_equipo_local" class="form-select" required>
                        <option value="">-- Selecciona --</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id_equipo }}"
                                {{ old('id_equipo_local', $partido?->id_equipo_local) == $equipo->id_equipo ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Pts Local</label>
                    <input type="number" name="pts_local" class="form-control"
                           value="{{ old('pts_local', $partido?->pts_local) }}"
                           min="0" placeholder="-">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Pts Visitante</label>
                    <input type="number" name="pts_visitante" class="form-control"
                           value="{{ old('pts_visitante', $partido?->pts_visitante) }}"
                           min="0" placeholder="-">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Equipo Visitante</label>
                    <select name="id_equipo_visitante" class="form-select" required>
                        <option value="">-- Selecciona --</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id_equipo }}"
                                {{ old('id_equipo_visitante', $partido?->id_equipo_visitante) == $equipo->id_equipo ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- ESTADÍSTICAS --}}
        @php
            $statsConfig = [
                'puntos_anotados'    => 'Puntos Anotados',
                't2_anotados'        => 'T2 Anotados',
                't2_intentados'      => 'T2 Intentados',
                't3_anotados'        => 'T3 Anotados',
                't3_intentados'      => 'T3 Intentados',
                't1_anotados'        => 'T1 Anotados',
                't1_intentados'      => 'T1 Intentados',
                'rebotes_ofensivos'  => 'Rebotes Ofensivos',
                'rebotes_defensivos' => 'Rebotes Defensivos',
                'asistencias'        => 'Asistencias',
                'robos'              => 'Robos',
                'tapones'            => 'Tapones',
                'balones_perdidos'   => 'Balones Perdidos',
                'faltas'             => 'Faltas',
            ];
        @endphp

        <div class="tabla-admin p-4 mb-4">
            <h4 style="font-weight:800; margin-bottom:20px;">
                <i class="fas fa-chart-bar" style="color:#C8102E;"></i>
                Estadísticas
            </h4>

            <div class="row">
                {{-- COLUMNA LOCAL --}}
                <div class="col-md-6">
                    <h5 style="font-weight:700; border-left:4px solid #C8102E;
                                padding-left:10px; margin-bottom:15px;">
                        Equipo Local
                    </h5>
                    @foreach($statsConfig as $campo => $etiqueta)
                        <div class="mb-2">
                            <label class="form-label" style="font-size:0.85rem; font-weight:600;">
                                {{ $etiqueta }}
                            </label>
                            <input type="number" name="local_{{ $campo }}"
                                   class="form-control form-control-sm"
                                   value="{{ old('local_'.$campo, $statLocal?->$campo ?? 0) }}"
                                   min="0">
                        </div>
                    @endforeach
                </div>

                {{-- COLUMNA VISITANTE --}}
                <div class="col-md-6">
                    <h5 style="font-weight:700; border-left:4px solid #555;
                                padding-left:10px; margin-bottom:15px;">
                        Equipo Visitante
                    </h5>
                    @foreach($statsConfig as $campo => $etiqueta)
                        <div class="mb-2">
                            <label class="form-label" style="font-size:0.85rem; font-weight:600;">
                                {{ $etiqueta }}
                            </label>
                            <input type="number" name="visitante_{{ $campo }}"
                                   class="form-control form-control-sm"
                                   value="{{ old('visitante_'.$campo, $statVisit?->$campo ?? 0) }}"
                                   min="0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn-rojo" style="font-size:1rem; padding:12px 30px;">
            <i class="fas fa-save"></i>
            {{ $partido ? 'Guardar Cambios' : 'Crear Partido' }}
        </button>

    </form>

@endsection