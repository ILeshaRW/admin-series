<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('film_has_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('films', indexName: 'films_has_seasons_film_id_foreign');
            $table->foreignId('season_id')->constrained('seasons', indexName: 'films_has_seasons_season_id_foreign');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('film_has_seasons');
    }
};
