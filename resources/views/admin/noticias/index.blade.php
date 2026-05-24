@extends('layouts.admin')
@section('titulo', 'Noticias')
@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-weight:800;">Noticias</h2>
        <a href="{{ route('admin.noticias.create') }}" class="btn-rojo">
            <i class="fas fa-plus"></i> Nueva Noticia
        </a>
    </div>

    <div class="tabla-admin">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Destacada</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($noticias as $noticia)
                    <tr>
                        <td><strong>{{ $noticia->titulo }}</strong></td>
                        <td>
                            @if($noticia->destacada)
                                <span class="badge" style="background:#C8102E;">Sí</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>{{ $noticia->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.noticias.edit', $noticia->id_noticia) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('admin.noticias.destroy', $noticia->id_noticia) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Seguro que quieres borrar esta noticia?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            No hay noticias todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection