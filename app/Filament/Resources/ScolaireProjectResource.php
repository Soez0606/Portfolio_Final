<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScolaireProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ScolaireProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    // Même groupe parent
    protected static ?string $navigationGroup = 'Contenu Portfolio';

    // Label qui suit la même logique
    protected static ?string $navigationLabel = 'Projets : Scolaires';

    // Ordre juste après le précédent
    protected static ?int $navigationSort = 6;


    // IMPORTANT : On ne filtre que les projets "scolaire"
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('category', 'scolaire');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails Scolaires')
                    ->description('Projets réalisés dans le cadre de tes études.')
                    ->schema([
                        // Champ caché pour trier automatiquement à droite sur ton site
                        Forms\Components\Hidden::make('category')
                            ->default('scolaire'),

                        Forms\Components\TextInput::make('title')
                            ->label('Nom du projet/TP')
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Description du travail')
                            ->required(),

                        Forms\Components\TextInput::make('technologies')
                            ->label('Outils utilisés (ex: PHP, Cisco...)')
                            ->placeholder('Séparez par des virgules'),
                    ])->columnSpan(2),

                Forms\Components\Section::make('Documents')
                    ->schema([
                        Forms\Components\TextInput::make('link')
                            ->label('Lien vers une démo (URL)')
                            ->url(),

                        // Ajout du champ PDF ici
                        Forms\Components\FileUpload::make('file')
                            ->label('Document PDF (Compte-rendu)')
                            ->acceptedFileTypes(['application/pdf']) // On force le PDF
                            ->directory('projects-files')
                            ->disk('public')
                            ->preserveFilenames(), // Garde le nom d'origine du fichier
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Ajouté le')->date('d/m/Y'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScolaireProjects::route('/'),
            'create' => Pages\CreateScolaireProject::route('/create'),
            'edit' => Pages\EditScolaireProject::route('/{record}/edit'),
        ];
    }
}
