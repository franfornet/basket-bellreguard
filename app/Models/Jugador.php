<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';
    protected $primaryKey = 'id_jugador';

    protected $fillable = [
        'nombre',
        'dorsal',
        'id_equipo',
        'imagen_url',
    ];

    // Un jugador pertenece a un equipo
    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id_equipo');
    }
}