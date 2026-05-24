<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Partido;
use App\Models\Noticia;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (session('admin_logueado')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Buscamos el usuario admin en la BD
        $usuario = \App\Models\User::where('email', $request->email)
                                   ->where('rol', 'admin')
                                   ->first();

        if ($usuario && password_verify($request->password, $usuario->hash_password)) {
            session(['admin_logueado' => true, 'admin_nombre' => $usuario->nombre]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email o contraseña incorrectos.');
    }

    public function logout()
    {
        session()->forget(['admin_logueado', 'admin_nombre']);
        return redirect()->route('inicio');
    }

    public function dashboard()
    {
        $datos = [
            'total_equipos'  => Equipo::count(),
            'total_jugadores'=> Jugador::count(),
            'total_partidos' => Partido::count(),
            'total_noticias' => Noticia::count(),
        ];
        return view('admin.dashboard', compact('datos'));
    }
}