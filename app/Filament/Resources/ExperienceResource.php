<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    // Label dans le menu de gauche
    protected static ?string $navigationLabel = 'Expériences';
    protected static ?string $navigationGroup = 'Contenu Portfolio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails du poste')
                    ->description('Informations sur l\'entreprise et la durée.')
                    ->schema([
                        Forms\Components\TextInput::make('job_title')
                            ->label('Intitulé du poste')
                            ->placeholder('ex: Développeur Fullstack')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('company')
                            ->label('Entreprise')
                            ->placeholder('ex: Google, Freelance...')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('location')
                            ->label('Lieu')
                            ->placeholder('ex: Paris, Télétravail...'),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\DatePicker::make('start_date')
                                ->label('Date de début')
                                ->required(),
                            Forms\Components\DatePicker::make('end_date')
                                ->label('Date de fin')
                                ->helperText('Laissez vide si vous êtes toujours en poste'),
                        ]),
                    ])->columnSpan(2),

                Forms\Components\Section::make('Contenu & Techs')
                    ->schema([
                        Forms\Components\TextInput::make('technologies')
                            ->label('Technologies')
                            ->placeholder('ex: Laravel, Tailwind, React'),
                        Forms\Components\Textarea::make('description')
                            ->label('Missions & Réalisations')
                            ->rows(10)
                            ->required(),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Poste')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('company')
                    ->label('Entreprise')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Début')
                    ->date('M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Fin')
                    ->date('M Y')
                    ->placeholder('Présent'),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListExperiences::route('/'),
            'create' => Pages\CreateExperience::route('/create'),
            'edit' => Pages\EditExperience::route('/{record}/edit'),
        ];
    }
}
