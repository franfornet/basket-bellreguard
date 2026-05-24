@extends('layouts.admin')
@section('titulo', 'Partidos')
@section('contenido')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="font-weight:800;">Partidos</h2>
        <a href="{{ route('admin.partidos.create') }}" class="btn-rojo">
            <i class="fas fa-plus"></i> Nuevo Partido
        </a>
    </div>

    <div class="tabla-admin">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Local</th>
                    <th class="text-center">Resultado</th>
                    <th>Visitante</th>
                    <th>Lugar</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partidos as $partido)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>
                        <td><strong>{{ $partido->equipoLocal->nombre }}</strong></td>
                        <td class="text-center">
                            @if($partido->pts_local !== null)
                                <span style="background:#C8102E; color:white; padding:3px 12px;
                                             border-radius:20px; font-weight:800;">
                                    {{ $partido->pts_local }} - {{ $partido->pts_visitante }}
                                </span>
                            @else
                                <span class="badge bg-secondary">Pendiente</span>
                            @endif
                        </td>
                        <td>{{ $partido->equipoVisitante->nombre }}</td>
                        <td>{{ $partido->lugar }}</td>
                        <td>
                            <a href="{{ route('admin.partidos.edit', $partido->id_partido) }}"
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST"
                                  action="{{ route('admin.partidos.destroy', $partido->id_partido) }}"
                                  style="display:inline;"
                                  onsubmit="return confirm('¿Seguro que quieres borrar este partido?')">
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
                        <td colspan="6" class="text-center text-muted py-4">
                            No hay partidos todavía.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection