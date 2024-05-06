<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('films_has_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('films', indexName: 'films_has_types_film_id_foreign');
            $table->foreignId('type_id')->constrained('film_types', indexName: 'films_has_types_type_id_foreign');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films_has_types');
    }
};
