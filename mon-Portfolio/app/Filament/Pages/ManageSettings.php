<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.pages.manage-settings';
    protected static ?string $navigationLabel = 'Mon Profil';
    protected static ?string $title = 'Configuration du profil';
    protected static ?string $navigationGroup = 'Administration';

    public ?array $data = [];

    public function mount(): void
    {
        $photo = Setting::where('key', 'hero_photo')->first()?->value;

        $this->form->fill([
            'hero_title' => Setting::where('key', 'hero_title')->first()?->value,
            'hero_description' => Setting::where('key', 'hero_description')->first()?->value,

            'hero_photo' => null,

            'contact_email' => Setting::where('key', 'contact_email')->first()?->value,
            'link_linkedin' => Setting::where('key', 'link_linkedin')->first()?->value,
            'link_github' => Setting::where('key', 'link_github')->first()?->value,
            'link_instagram' => Setting::where('key', 'link_instagram')->first()?->value,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Présentation du Hero')
                    ->schema([
                        TextInput::make('hero_title')->label('Titre')->required(),
                        Textarea::make('hero_description')->label('Description')->rows(4)->required(),
                        FileUpload::make('hero_photo')
                            ->label('Photo de profil')
                            ->image()
                            ->directory('profile-photos')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->previewable(true)
                            ->dehydrated(fn($state) => filled($state))
                    ]),

                Section::make('Contact & Réseaux Sociaux')
                    ->description('Ces informations seront affichées dans le pied de page (Footer).')
                    ->schema([
                        TextInput::make('contact_email')
                            ->label('Email de contact')
                            ->email(),
                        TextInput::make('link_linkedin')
                            ->label('Lien LinkedIn')
                            ->url(),
                        TextInput::make('link_github')
                            ->label('Lien GitHub')
                            ->url(),
                        TextInput::make('link_instagram')
                            ->label('Lien Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/ton_compte'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Enregistrer les modifications')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            Notification::make()
                ->title('Paramètres mis à jour !')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Erreur lors de la sauvegarde')
                ->danger()
                ->send();
        }
    }
}
