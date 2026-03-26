<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés massivement.
     * Mise à jour pour inclure les champs du référentiel.
     */
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'published_at', // Date de collecte
        'summary',      // Résumé 3-5 lignes
        'content',      // Impact métier / Analyse
        'source_name',
        'source_url',
        'tool',         // Outil de veille
        'keywords',     // Mots-clés
        'is_published',
    ];

    /**
     * Casts pour transformer les données stockées en base (JSON, Date)
     * en objets utilisables par PHP et Filament.
     */
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'date',
        'keywords' => 'array', // TRÈS IMPORTANT : permet de stocker les tags Filament en JSON
    ];
}
