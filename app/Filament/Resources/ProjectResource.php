<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    // On garde le groupe parent
    protected static ?string $navigationGroup = 'Contenu Portfolio';

    // On change le label pour qu'il apparaisse comme un sous-élément
    protected static ?string $navigationLabel = 'Projets : Personnels';

    // Optionnel : On définit l'ordre
    protected static ?int $navigationSort = 5;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('category', 'perso');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('category')->default('perso'),

                Section::make('Détails du Projet')
                    ->description('Informations principales de ta réalisation.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre du projet')
                            ->placeholder('Ex: E-commerce Laravel')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Description')
                            ->rows(5)
                            ->required(),

                        TextInput::make('technologies')
                            ->label('Technologies utilisées')
                            ->placeholder('Laravel, Tailwind, Livewire...')
                            ->required(),

                        FileUpload::make('image')
                            ->label('Capture d\'écran')
                            ->image()
                            ->directory('projects')
                            ->disk('public'),
                    ])->columnSpan(2),

                Section::make('Liens & Réseaux')
                    ->schema([
                        TextInput::make('link')
                            ->label('Lien du site (Live)')
                            ->url()
                            ->placeholder('https://...'),

                        TextInput::make('github_link')
                            ->label('Lien GitHub')
                            ->url()
                            ->placeholder('https://github.com/...'),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
