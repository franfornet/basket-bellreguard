<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partido;
use App\Models\Equipo;
use App\Models\Temporada;
use App\Models\EstadisticaEquipo;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index()
    {
        $partidos = Partido::with(['equipoLocal', 'equipoVisitante', 'temporada'])
                           ->orderBy('fecha', 'desc')
                           ->get();
        return view('admin.partidos.index', compact('partidos'));
    }

    public function create()
    {
        $equipos   = Equipo::all();
        $temporadas = Temporada::orderBy('anyo_inicio', 'desc')->get();

        if ($temporadas->isEmpty()) {
            Temporada::create(['anyo_inicio' => 2024, 'anyo_fin' => 2025]);
            $temporadas = Temporada::all();
        }

        return view('admin.partidos.form', [
            'partido'    => null,
            'equipos'    => $equipos,
            'temporadas' => $temporadas,
            'statLocal'  => null,
            'statVisit'  => null,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha'              => 'required|date',
            'lugar'              => 'required',
            'id_equipo_local'    => 'required|exists:equipos,id_equipo',
            'id_equipo_visitante'=> 'required|exists:equipos,id_equipo',
            'id_temporada'       => 'required|exists:temporadas,id_temporada',
        ]);

        $partido = Partido::create([
            'fecha'               => $request->fecha,
            'lugar'               => $request->lugar,
            'id_equipo_local'     => $request->id_equipo_local,
            'id_equipo_visitante' => $request->id_equipo_visitante,
            'id_temporada'        => $request->id_temporada,
            'pts_local'           => $request->pts_local ?: null,
            'pts_visitante'       => $request->pts_visitante ?: null,
        ]);

        $this->guardarEstadisticas($request, $partido);

        return redirect()->route('admin.partidos.index')
                         ->with('success', 'Partido creado correctamente.');
    }

    public function edit(Partido $partido)
    {
        $equipos    = Equipo::all();
        $temporadas = Temporada::orderBy('anyo_inicio', 'desc')->get();
        $statLocal  = EstadisticaEquipo::where('id_partido', $partido->id_partido)
                                       ->where('es_local', true)->first();
        $statVisit  = EstadisticaEquipo::where('id_partido', $partido->id_partido)
                                       ->where('es_local', false)->first();

        return view('admin.partidos.form', compact(
            'partido', 'equipos', 'temporadas', 'statLocal', 'statVisit'
        ));
    }

    public function update(Request $request, Partido $partido)
    {
        $request->validate([
            'fecha'              => 'required|date',
            'lugar'              => 'required',
            'id_equipo_local'    => 'required|exists:equipos,id_equipo',
            'id_equipo_visitante'=> 'required|exists:equipos,id_equipo',
            'id_temporada'       => 'required|exists:temporadas,id_temporada',
        ]);

        $partido->update([
            'fecha'               => $request->fecha,
            'lugar'               => $request->lugar,
            'id_equipo_local'     => $request->id_equipo_local,
            'id_equipo_visitante' => $request->id_equipo_visitante,
            'id_temporada'        => $request->id_temporada,
            'pts_local'           => $request->pts_local ?: null,
            'pts_visitante'       => $request->pts_visitante ?: null,
        ]);

        EstadisticaEquipo::where('id_partido', $partido->id_partido)->delete();
        $this->guardarEstadisticas($request, $partido);

        return redirect()->route('admin.partidos.index')
                         ->with('success', 'Partido actualizado correctamente.');
    }

    public function destroy(Partido $partido)
    {
        $partido->delete();
        return redirect()->route('admin.partidos.index')
                         ->with('success', 'Partido eliminado correctamente.');
    }

    // Método privado para guardar estadísticas de ambos equipos
    private function guardarEstadisticas(Request $request, Partido $partido)
    {
        $campos = [
            'puntos_anotados', 't2_intentados', 't3_intentados',
            't1_intentados', 'balones_perdidos', 'rebotes_ofensivos',
            't2_anotados', 't3_anotados', 't1_anotados',
            'rebotes_defensivos', 'asistencias', 'robos', 'tapones', 'faltas'
        ];

        foreach (['local', 'visitante'] as $tipo) {
            $esLocal = $tipo === 'local';
            $datos = ['id_partido' => $partido->id_partido,
                      'id_equipo'  => $esLocal
                                        ? $request->id_equipo_local
                                        : $request->id_equipo_visitante,
                      'es_local'   => $esLocal];

            foreach ($campos as $campo) {
                $datos[$campo] = $request->input("{$tipo}_{$campo}", 0);
            }

            EstadisticaEquipo::create($datos);
        }
    }
}