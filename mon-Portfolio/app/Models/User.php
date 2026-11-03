<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Hors environnement local, Filament refuse l'accès (403) aux utilisateurs
     * qui n'implémentent pas FilamentUser. Il n'y a pas d'inscription publique,
     * donc tout compte existant est un administrateur.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
