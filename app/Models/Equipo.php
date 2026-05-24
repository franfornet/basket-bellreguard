<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'id_equipo';

    protected $fillable = [
        'nombre',
        'categoria',
        'color',
        'image_url',
    ];

    // Un equipo tiene muchos jugadores
    public function jugadores()
    {
        return $this->hasMany(Jugador::class, 'id_equipo', 'id_equipo');
    }

    // Un equipo tiene muchos partidos como local
    public function partidosLocal()
    {
        return $this->hasMany(Partido::class, 'id_equipo_local', 'id_equipo');
    }

    // Un equipo tiene muchos partidos como visitante
    public function partidosVisitante()
    {
        return $this->hasMany(Partido::class, 'id_equipo_visitante', 'id_equipo');
    }
}