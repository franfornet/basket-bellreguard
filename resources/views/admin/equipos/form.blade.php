@extends('layouts.admin')
@section('titulo', $equipo ? 'Editar Equipo' : 'Nuevo Equipo')
@section('contenido')

    <div class="mb-4">
        <a href="{{ route('admin.equipos.index') }}" style="color:#888; text-decoration:none;">
            ← Volver a Equipos
        </a>
    </div>

    <div class="tabla-admin p-4" style="max-width:600px;">
        <h3 style="font-weight:800; margin-bottom:25px;">
            {{ $equipo ? 'Editar Equipo' : 'Nuevo Equipo' }}
        </h3>

        <form method="POST" action="{{ $equipo
            ? route('admin.equipos.update', $equipo->id_equipo)
            : route('admin.equipos.store') }}">
            @csrf
            @if($equipo) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label fw-bold">Nombre del equipo</label>
                <input type="text" name="nombre" class="form-control"
                       value="{{ old('nombre', $equipo?->nombre) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Categoría</label>
                <input type="text" name="categoria" class="form-control"
                       value="{{ old('categoria', $equipo?->categoria) }}"
                       placeholder="Ej: Senior, Junior, Cadete..."
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">
                    Color <span style="color:#aaa; font-weight:400;">(opcional)</span>
                </label>
                <input type="text" name="color" class="form-control"
                       value="{{ old('color', $equipo?->color) }}"
                       placeholder="Ej: Rojo y negro">
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">
                    URL de imagen <span style="color:#aaa; font-weight:400;">(opcional)</span>
                </label>
                <input type="url" name="image_url" class="form-control"
                       value="{{ old('image_url', $equipo?->image_url) }}"
                       placeholder="https://...">
            </div>

            <button type="submit" class="btn-rojo">
                <i class="fas fa-save"></i>
                {{ $equipo ? 'Guardar Cambios' : 'Crear Equipo' }}
            </button>
        </form>
    </div>

@endsection