<?php

namespace App\Filament\Pages;

use App\Filament\Resources\EducationResource;
use App\Filament\Resources\FormationResource;
use Filament\Pages\Page;
use Filament\Actions\CreateAction;

class MonParcours extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Contenu Portfolio';
    protected static ?string $navigationLabel = 'Mon Parcours';
    protected static string $view = 'filament.pages.mon-parcours';

    // On ajoute des boutons de création rapide en haut de page
    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make('add_diplome')
                ->label('Ajouter un Diplôme')
                ->model(\App\Models\Education::class)
                ->form(EducationResource::getFormFields()), // Utilise getFormFields()

            \Filament\Actions\CreateAction::make('add_formation')
                ->label('Ajouter une Formation')
                ->model(\App\Models\Formation::class)
                ->form(FormationResource::getFormFields()), // Utilise getFormFields()
        ];
    }
}
