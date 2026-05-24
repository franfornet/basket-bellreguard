<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estadisticas_equipos', function (Blueprint $table) {
            $table->foreignId('id_partido')
                  ->constrained('partidos', 'id_partido')
                  ->onDelete('cascade');
            $table->foreignId('id_equipo')
                  ->constrained('equipos', 'id_equipo');
            $table->boolean('es_local');
            $table->integer('puntos_anotados')->default(0);
            $table->integer('t2_intentados')->default(0);
            $table->integer('t3_intentados')->default(0);
            $table->integer('t1_intentados')->default(0);
            $table->integer('balones_perdidos')->default(0);
            $table->integer('rebotes_ofensivos')->default(0);
            $table->integer('t2_anotados')->default(0);
            $table->integer('t3_anotados')->default(0);
            $table->integer('t1_anotados')->default(0);
            $table->integer('rebotes_defensivos')->default(0);
            $table->integer('asistencias')->default(0);
            $table->integer('robos')->default(0);
            $table->integer('tapones')->default(0);
            $table->integer('faltas')->default(0);
            $table->primary(['id_partido', 'id_equipo']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estadisticas_equipos');
    }
};