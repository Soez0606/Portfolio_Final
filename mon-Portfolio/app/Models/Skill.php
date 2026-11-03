<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /** Groupes d'affichage des hard skills (colonne `category`). */
    public const CATEGORIES = [
        'languages' => 'Langages',
        'frameworks' => 'Frameworks & librairies',
        'databases' => 'Bases de données',
        'tools' => 'Outils & DevOps',
    ];

    protected $fillable = ['name', 'type', 'category'];
}
