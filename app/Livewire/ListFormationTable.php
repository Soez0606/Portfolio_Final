<?php

namespace App\Livewire;

use App\Models\Formation;
use App\Filament\Resources\FormationResource;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class ListFormationTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Formation::query())
            ->columns([
                TextColumn::make('titre')
                    ->label('Formation')
                    ->searchable(),
                TextColumn::make('organisme')
                    ->label('Organisme'),
                TextColumn::make('date')
                    ->label('Date'),
                IconColumn::make('file')
                    ->label('Justificatif')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-check'),
            ])
            ->actions([
                EditAction::make()
                    ->form(FormationResource::getFormFields()),
                DeleteAction::make(),
            ]);
    }

    public function render()
    {
        return view('livewire.list-formation-table');
    }
}
