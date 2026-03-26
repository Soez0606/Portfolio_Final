<?php

namespace App\Filament\Resources\ScolaireProjectResource\Pages;

use App\Filament\Resources\ScolaireProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScolaireProjects extends ListRecords
{
    protected static string $resource = ScolaireProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
