<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id('id_partido');
            $table->date('fecha');
            $table->string('lugar');
            $table->foreignId('id_equipo_local')
                  ->constrained('equipos', 'id_equipo');
            $table->foreignId('id_equipo_visitante')
                  ->constrained('equipos', 'id_equipo');
            $table->foreignId('id_temporada')
                  ->constrained('temporadas', 'id_temporada');
            $table->integer('pts_local')->nullable();
            $table->integer('pts_visitante')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};