<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::withCount('jugadores')->get();
        return view('admin.equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('admin.equipos.form', ['equipo' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|max:255',
            'categoria' => 'required|max:255',
        ]);

        Equipo::create([
            'nombre'    => $request->nombre,
            'categoria' => $request->categoria,
            'color'     => $request->color,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('admin.equipos.index')
                         ->with('success', 'Equipo creado correctamente.');
    }

    public function edit(Equipo $equipo)
    {
        return view('admin.equipos.form', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $request->validate([
            'nombre'    => 'required|max:255',
            'categoria' => 'required|max:255',
        ]);

        $equipo->update([
            'nombre'    => $request->nombre,
            'categoria' => $request->categoria,
            'color'     => $request->color,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('admin.equipos.index')
                         ->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('admin.equipos.index')
                         ->with('success', 'Equipo eliminado correctamente.');
    }
}