@extends('layouts.admin')
@section('titulo', $noticia ? 'Editar Noticia' : 'Nueva Noticia')
@section('contenido')

    <div class="mb-4">
        <a href="{{ route('admin.noticias.index') }}" style="color:#888; text-decoration:none;">
            ← Volver a Noticias
        </a>
    </div>

    <div class="tabla-admin p-4" style="max-width:700px;">
        <h3 style="font-weight:800; margin-bottom:25px;">
            {{ $noticia ? 'Editar Noticia' : 'Nueva Noticia' }}
        </h3>

        <form method="POST" action="{{ $noticia
            ? route('admin.noticias.update', $noticia->id_noticia)
            : route('admin.noticias.store') }}">
            @csrf
            @if($noticia) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label fw-bold">Título</label>
                <input type="text" name="titulo" class="form-control"
                       value="{{ old('titulo', $noticia?->titulo) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Contenido</label>
                <textarea name="contenido" class="form-control" rows="6" required>{{ old('contenido', $noticia?->contenido) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">URL de imagen <span style="color:#aaa; font-weight:400;">(opcional)</span></label>
                <input type="url" name="imagen_url" class="form-control"
                       value="{{ old('imagen_url', $noticia?->imagen_url) }}"
                       placeholder="https://...">
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input type="checkbox" name="destacada" class="form-check-input"
                           id="destacada"
                           {{ old('destacada', $noticia?->destacada) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="destacada">
                        Mostrar en portada como noticia destacada
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-rojo">
                <i class="fas fa-save"></i>
                {{ $noticia ? 'Guardar Cambios' : 'Crear Noticia' }}
            </button>
        </form>
    </div>

@endsection