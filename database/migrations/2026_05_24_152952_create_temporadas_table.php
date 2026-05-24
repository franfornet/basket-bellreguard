<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temporadas', function (Blueprint $table) {
            $table->id('id_temporada');
            $table->integer('anyo_inicio');
            $table->integer('anyo_fin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temporadas');
    }
};