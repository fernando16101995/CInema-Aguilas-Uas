<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id(); // Crea la columna 'id' (SERIAL PRIMARY KEY)

            // --- CAMPOS DE LA PELÍCULA ---
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('poster_url', 512)->nullable(); // Aumentamos la longitud por si es una URL larga
            $table->string('video_url', 512)->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->string('genre', 100)->nullable();
            // -----------------------------

            $table->timestamps(); // Crea 'created_at' y 'updated_at'
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};