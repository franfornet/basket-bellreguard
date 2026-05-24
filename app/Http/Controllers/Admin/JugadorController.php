<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jugador;
use App\Models\Equipo;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    public function index()
    {
        $jugadores = Jugador::with('equipo')->orderBy('id_equipo')->get();
        return view('admin.jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $equipos = Equipo::all();
        return view('admin.jugadores.form', ['jugador' => null, 'equipos' => $equipos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|max:255',
            'dorsal'    => 'required|integer',
            'id_equipo' => 'required|exists:equipos,id_equipo',
        ]);

        Jugador::create([
            'nombre'     => $request->nombre,
            'dorsal'     => $request->dorsal,
            'id_equipo'  => $request->id_equipo,
            'imagen_url' => $request->imagen_url,
        ]);

        return redirect()->route('admin.jugadores.index')
                         ->with('success', 'Jugador creado correctamente.');
    }

    public function edit(Jugador $jugador)
    {
        $equipos = Equipo::all();
        return view('admin.jugadores.form', compact('jugador', 'equipos'));
    }

    public function update(Request $request, Jugador $jugador)
    {
        $request->validate([
            'nombre'    => 'required|max:255',
            'dorsal'    => 'required|integer',
            'id_equipo' => 'required|exists:equipos,id_equipo',
        ]);

        $jugador->update([
            'nombre'     => $request->nombre,
            'dorsal'     => $request->dorsal,
            'id_equipo'  => $request->id_equipo,
            'imagen_url' => $request->imagen_url,
        ]);

        return redirect()->route('admin.jugadores.index')
                         ->with('success', 'Jugador actualizado correctamente.');
    }

    public function destroy(Jugador $jugador)
    {
        $jugador->delete();
        return redirect()->route('admin.jugadores.index')
                         ->with('success', 'Jugador eliminado correctamente.');
    }
}