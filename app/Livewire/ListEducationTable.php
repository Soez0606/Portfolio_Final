<?php

namespace App\Livewire;

use App\Models\Education;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use App\Filament\Resources\EducationResource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ListEducationTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Education::query())
            ->columns([
                TextColumn::make('degree')->label('Diplôme'),
                TextColumn::make('school')->label('École'),
                TextColumn::make('start_date')->label('Début')->date('Y'),
                TextColumn::make('end_date')->label('Fin')->date('Y')->placeholder('Présent'),
                ])
                ->actions([
                    EditAction::make()
                        ->form(EducationResource::getFormFields()), // On réutilise tes champs !
                    DeleteAction::make(),
                ]);
    }

    public function render()
    {
        return view('livewire.list-education-table');
    }
}
