@extends('layouts.admin')
@section('titulo', 'Jugadores')
@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-weight:800;">Jugadores</h2>
        <a href="{{ route('admin.jugadores.create') }}" class="btn-rojo">
            <i class="fas fa-plus"></i> Nuevo Jugador
        </a>
    </div>

    <div class="tabla-admin">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Dorsal</th>
                    <th>Nombre</th>
                    <th>Equipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jugadores as $jugador)
                    <tr>
                        <td>
                            <span style="background:#C8102E; color:white; padding:3px 10px;
                                         border-radius:20px; font-weight:800;">
                                #{{ $jugador->dorsal }}
                            </span>
                        </td>
                        <td><strong>{{ $jugador->nombre }}</strong></td>
                        <td>{{ $jugador->equipo->nombre ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.jugadores.edit', $jugador->id_jugador) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('admin.jugadores.destroy', $jugador->id_jugador) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Seguro que quieres borrar este jugador?')">
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
                            No hay jugadores todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection