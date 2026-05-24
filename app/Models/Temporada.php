<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $table = 'temporadas';
    protected $primaryKey = 'id_temporada';

    protected $fillable = [
        'anyo_inicio',
        'anyo_fin',
    ];

    public function partidos()
    {
        return $this->hasMany(Partido::class, 'id_temporada', 'id_temporada');
    }
}