<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'titulo',
        'contenido',
        'imagen_url',
        'destacada',
    ];
}