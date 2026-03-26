<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Informations de base
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable();

            // Référentiel Veille
            $table->date('published_at')->nullable(); // Date de collecte
            $table->text('summary'); // Résumé (3 à 5 lignes)
            $table->longText('content'); // Impact métier / Analyse
            $table->string('source_name')->nullable(); // Nom de la source
            $table->string('source_url')->nullable(); // URL de la source
            $table->string('tool')->nullable(); // Outil de veille (RSS, Newsletter...)
            $table->json('keywords')->nullable(); // Mots-clés stockés en JSON (ex: #Eloquent)

            // Statut
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
