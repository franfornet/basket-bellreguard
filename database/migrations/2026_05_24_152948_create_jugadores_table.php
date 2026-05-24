<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id('id_jugador');
            $table->string('nombre');
            $table->integer('dorsal');
            $table->foreignId('id_equipo')
                  ->constrained('equipos', 'id_equipo')
                  ->onDelete('cascade');
            $table->string('imagen_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};