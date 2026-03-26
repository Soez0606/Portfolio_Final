<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormationResource\Pages;
use App\Models\Formation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormationResource extends Resource
{
    protected static ?string $model = Formation::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Contenu Portfolio';
    protected static ?string $navigationLabel = 'Certifications & Formations';
    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = false;

    /**
     * Cette méthode remplace getFormSchema pour éviter les erreurs de type.
     */
    public static function getFormFields(): array
    {
        return [
            Forms\Components\TextInput::make('titre')
                ->label('Titre de la formation')
                ->required(),

            Forms\Components\TextInput::make('organisme')
                ->label('Organisme / Plateforme')
                ->placeholder('Ex: Udemy, OpenClassrooms')
                ->required(),

            Forms\Components\TextInput::make('date')
                ->label('Année / Période')
                ->placeholder('Ex: 2024')
                ->required(),

            Forms\Components\RichEditor::make('description')
                ->label('Contenu de la formation')
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('file')
                ->label('Justificatif (PDF ou Image)')
                ->directory('formations-files')
                ->acceptedFileTypes(['application/pdf', 'image/*'])
                ->preserveFilenames()
                ->openable()
                ->downloadable()
                ->columnSpanFull(),
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de la Certification')
                    ->description('Ajoute ici tes formations complémentaires et justificatifs.')
                    ->schema(static::getFormFields()) // On utilise les champs ici
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')->label('Formation')->searchable(),
                Tables\Columns\TextColumn::make('organisme')->label('Organisme'),
                Tables\Columns\TextColumn::make('date')->label('Date'),
                Tables\Columns\IconColumn::make('file')
                    ->label('Justificatif')
                    ->boolean()
                    ->trueIcon('heroicon-o-document-check')
                    ->falseIcon('heroicon-o-x-mark'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormations::route('/'),
            'create' => Pages\CreateFormation::route('/create'),
            'edit' => Pages\EditFormation::route('/{record}/edit'),
        ];
    }
}
