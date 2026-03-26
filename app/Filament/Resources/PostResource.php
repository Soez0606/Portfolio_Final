<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    // Personnalisation du menu
    protected static ?string $navigationIcon = 'heroicon-o-rss'; // Icône de flux RSS/Blog
    protected static ?string $navigationGroup = 'Contenu Portfolio';
    protected static ?string $navigationLabel = 'Veille Technologique';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // COLONNE PRINCIPALE : Contenu et Analyse
                        Forms\Components\Section::make('Analyse de la Veille')
                            ->columnSpan(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titre / Sujet')
                                    ->placeholder('Nom de l\'article ou de la technologie')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),

                                Forms\Components\Hidden::make('slug'),

                                // Résumé (Saisie claire de 3 à 5 lignes selon ton référentiel)
                                Forms\Components\Textarea::make('summary')
                                    ->label('Résumé de l\'information')
                                    ->helperText('Faites une synthèse claire de 3 à 5 lignes.')
                                    ->rows(4)
                                    ->required(),

                                // Impact (Obligatoire selon ton référentiel)
                                Forms\Components\RichEditor::make('content')
                                    ->label('Impact sur mon futur métier / compétences')
                                    ->placeholder('Expliquez concrètement ce que cela change pour vous...')
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        // COLONNE LATÉRALE : Métadonnées et Sources
                        Forms\Components\Section::make('Informations Source')
                            ->columnSpan(1)
                            ->schema([
                                // Date de collecte (Demandé par le référentiel)
                                Forms\Components\DatePicker::make('published_at')
                                    ->label('Date de collecte')
                                    ->default(now())
                                    ->required(),

                                // Source et URL
                                Forms\Components\TextInput::make('source_name')
                                    ->label('Nom de la source')
                                    ->placeholder('ex: Laravel News, Twitter...')
                                    ->required(),

                                Forms\Components\TextInput::make('source_url')
                                    ->label('URL de la source')
                                    ->url()
                                    ->required(),

                                // Outil de veille
                                Forms\Components\Select::make('tool')
                                    ->label('Outil de veille utilisé')
                                    ->options([
                                        'RSS' => 'Flux RSS (Feedly...)',
                                        'Newsletter' => 'Newsletter',
                                        'Social' => 'Réseaux Sociaux',
                                        'Curator' => 'Outil de curation',
                                    ])
                                    ->required(),

                                // Mots-clés (Tags)
                                Forms\Components\TagsInput::make('keywords')
                                    ->label('Mots-clés (#Tags)')
                                    ->placeholder('Appuyez sur Entrée')
                                    ->separator(','),

                                Forms\Components\Toggle::make('is_published')
                                    ->label('Afficher sur le portfolio')
                                    ->default(true)
                                    ->onColor('success'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Date de collecte demandée par ton référentiel
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Collecté le')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Sujet')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                // On affiche l'outil de veille (RSS, etc.)
                Tables\Columns\TextColumn::make('tool')
                    ->label('Outil')
                    ->badge()
                    ->color('info'),

                // On remplace "category" par tes nouveaux "keywords"
                Tables\Columns\TextColumn::make('keywords')
                    ->label('Mots-clés')
                    ->badge()
                    ->separator(',')
                    ->color('gray'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Statut de publication'),

                // Filtre par outil de veille au lieu de catégorie
                Tables\Filters\SelectFilter::make('tool')
                    ->label('Filtrer par outil')
                    ->options([
                        'RSS' => 'Flux RSS',
                        'Newsletter' => 'Newsletter',
                        'Social' => 'Réseaux Sociaux',
                        'Curator' => 'Outil de curation',
                    ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
