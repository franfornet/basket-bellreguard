<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Equipo;
use App\Models\Partido;
use App\Models\EstadisticaEquipo;

class PublicoController extends Controller
{
    // Página de inicio
    public function inicio()
    {
        $noticias = Noticia::where('destacada', true)
                           ->latest()
                           ->take(3)
                           ->get();

        $partidos = Partido::with(['equipoLocal', 'equipoVisitante'])
                           ->latest('fecha')
                           ->take(5)
                           ->get();

        return view('publico.inicio', compact('noticias', 'partidos'));
    }

    // Página de equipos
    public function equipos()
    {
        $equipos = Equipo::all();
        return view('publico.equipos', compact('equipos'));
    }

    // Detalle de un equipo con sus jugadores
    public function equipoDetalle($id)
    {
        $equipo = Equipo::with('jugadores')->findOrFail($id);
        return view('publico.equipo_detalle', compact('equipo'));
    }

    // Calendario de partidos
    public function calendario()
    {
        $partidos = Partido::with(['equipoLocal', 'equipoVisitante', 'temporada'])
                           ->orderBy('fecha', 'desc')
                           ->get();

        return view('publico.calendario', compact('partidos'));
    }

    // Estadísticas de un partido
    public function estadisticas($id_partido)
    {
        $partido = Partido::with(['equipoLocal', 'equipoVisitante'])
                          ->findOrFail($id_partido);

        $estadisticas = EstadisticaEquipo::with('equipo')
                                         ->where('id_partido', $id_partido)
                                         ->get();

        $local = $estadisticas->where('es_local', true)->first();
        $visitante = $estadisticas->where('es_local', false)->first();

        return view('publico.estadisticas', compact('partido', 'local', 'visitante'));
    }
}