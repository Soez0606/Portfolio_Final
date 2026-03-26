<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationResource\Pages;
use App\Models\Education;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationResource extends Resource
{
    protected static ?string $model = Education::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Contenu Portfolio';
    protected static ?string $navigationLabel = 'Parcours Scolaire';
    protected static bool $shouldRegisterNavigation = false;

    /**
     * Cette fonction contient uniquement tes champs.
     * Elle sera utilisée par la Resource ET par ta page personnalisée.
     */
    public static function getFormFields(): array
    {
        return [
            Forms\Components\TextInput::make('school')
                ->label('École / Université')
                ->required(),

            Forms\Components\TextInput::make('degree')
                ->label('Diplôme / Titre')
                ->required(),

            Forms\Components\TextInput::make('field_of_study')
                ->label('Domaine d\'études')
                ->placeholder('Ex: Développement Web'),

            Forms\Components\DatePicker::make('start_date')
                ->label('Date de début')
                ->required(),

            Forms\Components\DatePicker::make('end_date')
                ->label('Date de fin (ou prévu)')
                ->hint('Laisse vide si en cours'),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de la Formation')
                    ->description('Renseigne tes diplômes et écoles.')
                    ->schema(static::getFormFields()) // On appelle la fonction ici
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('degree')->label('Diplôme')->searchable(),
                Tables\Columns\TextColumn::make('school')->label('École')->sortable(),
                Tables\Columns\TextColumn::make('start_date')->label('Début')->date('Y'),
                Tables\Columns\TextColumn::make('end_date')->label('Fin')->date('Y')->placeholder('Présent'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducation::route('/'),
            'create' => Pages\CreateEducation::route('/create'),
            'edit' => Pages\EditEducation::route('/{record}/edit'),
        ];
    }
}
