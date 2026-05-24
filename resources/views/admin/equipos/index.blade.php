@extends('layouts.admin')
@section('titulo', 'Equipos')
@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-weight:800;">Equipos</h2>
        <a href="{{ route('admin.equipos.create') }}" class="btn-rojo">
            <i class="fas fa-plus"></i> Nuevo Equipo
        </a>
    </div>

    <div class="tabla-admin">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Jugadores</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipos as $equipo)
                    <tr>
                        <td><strong>{{ $equipo->nombre }}</strong></td>
                        <td>
                            <span class="badge" style="background:#C8102E;">
                                {{ $equipo->categoria }}
                            </span>
                        </td>
                        <td>{{ $equipo->jugadores_count }}</td>
                        <td>
                            <a href="{{ route('admin.equipos.edit', $equipo->id_equipo) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('admin.equipos.destroy', $equipo->id_equipo) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Seguro? Se borrarán también sus jugadores.')">
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
                            No hay equipos todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection