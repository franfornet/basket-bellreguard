<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.form', ['noticia' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required|max:255',
            'contenido' => 'required',
        ]);

        Noticia::create([
            'titulo'     => $request->titulo,
            'contenido'  => $request->contenido,
            'imagen_url' => $request->imagen_url,
            'destacada'  => $request->has('destacada'),
        ]);

        return redirect()->route('admin.noticias.index')
                         ->with('success', 'Noticia creada correctamente.');
    }

    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.form', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo'    => 'required|max:255',
            'contenido' => 'required',
        ]);

        $noticia->update([
            'titulo'     => $request->titulo,
            'contenido'  => $request->contenido,
            'imagen_url' => $request->imagen_url,
            'destacada'  => $request->has('destacada'),
        ]);

        return redirect()->route('admin.noticias.index')
                         ->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return redirect()->route('admin.noticias.index')
                         ->with('success', 'Noticia eliminada correctamente.');
    }
}