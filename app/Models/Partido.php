<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $table = 'partidos';
    protected $primaryKey = 'id_partido';

    protected $fillable = [
        'fecha',
        'lugar',
        'id_equipo_local',
        'id_equipo_visitante',
        'id_temporada',
        'pts_local',
        'pts_visitante',
    ];

    // El partido tiene un equipo local
    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_local', 'id_equipo');
    }

    // El partido tiene un equipo visitante
    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo_visitante', 'id_equipo');
    }

    // El partido pertenece a una temporada
    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'id_temporada', 'id_temporada');
    }

    // El partido tiene estadísticas
    public function estadisticas()
    {
        return $this->hasMany(EstadisticaEquipo::class, 'id_partido', 'id_partido');
    }
}