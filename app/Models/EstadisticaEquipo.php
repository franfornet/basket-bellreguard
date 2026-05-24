<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadisticaEquipo extends Model
{
    protected $table = 'estadisticas_equipos';

    protected $fillable = [
        'id_partido',
        'id_equipo',
        'es_local',
        'puntos_anotados',
        't2_intentados',
        't3_intentados',
        't1_intentados',
        'balones_perdidos',
        'rebotes_ofensivos',
        't2_anotados',
        't3_anotados',
        't1_anotados',
        'rebotes_defensivos',
        'asistencias',
        'robos',
        'tapones',
        'faltas',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id_equipo');
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class, 'id_partido', 'id_partido');
    }

    // Calcula la eficiencia de ataque (sin guardarla en BD)
    public function eficienciaAtaque(): float
    {
        $divisor = $this->t2_intentados
            + $this->t3_intentados
            + ($this->t1_intentados / 2)
            + $this->balones_perdidos
            - $this->rebotes_ofensivos;

        if ($divisor <= 0) return 0;

        return round($this->puntos_anotados / $divisor, 3);
    }
}