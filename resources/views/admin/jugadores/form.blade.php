@extends('layouts.admin')
@section('titulo', $jugador ? 'Editar Jugador' : 'Nuevo Jugador')
@section('contenido')

    <div class="mb-4">
        <a href="{{ route('admin.jugadores.index') }}" style="color:#888; text-decoration:none;">
            ← Volver a Jugadores
        </a>
    </div>

    <div class="tabla-admin p-4" style="max-width:600px;">
        <h3 style="font-weight:800; margin-bottom:25px;">
            {{ $jugador ? 'Editar Jugador' : 'Nuevo Jugador' }}
        </h3>

        <form method="POST" action="{{ $jugador
            ? route('admin.jugadores.update', $jugador->id_jugador)
            : route('admin.jugadores.store') }}">
            @csrf
            @if($jugador) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label fw-bold">Nombre completo</label>
                <input type="text" name="nombre" class="form-control"
                       value="{{ old('nombre', $jugador?->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Dorsal</label>
                <input type="number" name="dorsal" class="form-control"
                       value="{{ old('dorsal', $jugador?->dorsal) }}"
                       min="0" max="99" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Equipo</label>
                <select name="id_equipo" class="form-select" required>
                    <option value="">-- Selecciona un equipo --</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id_equipo }}"
                            {{ old('id_equipo', $jugador?->id_equipo) == $equipo->id_equipo ? 'selected' : '' }}>
                            {{ $equipo->nombre }} ({{ $equipo->categoria }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">
                    URL de foto <span style="color:#aaa; font-weight:400;">(opcional)</span>
                </label>
                <input type="url" name="imagen_url" class="form-control"
                       value="{{ old('imagen_url', $jugador?->imagen_url) }}"
                       placeholder="https://...">
            </div>

            <button type="submit" class="btn-rojo">
                <i class="fas fa-save"></i>
                {{ $jugador ? 'Guardar Cambios' : 'Crear Jugador' }}
            </button>
        </form>
    </div>

@endsection