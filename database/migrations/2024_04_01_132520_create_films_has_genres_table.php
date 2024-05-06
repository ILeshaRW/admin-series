<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('films_has_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('films', indexName: 'films_has_genres_film_id_foreign');
            $table->foreignId('genre_id')->constrained('film_genres', indexName: 'films_has_genres_genre_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films_has_genres');
    }
};
