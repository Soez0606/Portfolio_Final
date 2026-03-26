<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;

class ContactWidget extends Component
{
    public $isOpen = false;

    // CRITIQUE : Cette ligne dit à Livewire d'écouter l'événement "openContact"
    protected $listeners = ['openContact' => 'toggleModal'];

    public function toggleModal()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function render()
    {
        return view('livewire.contact-widget', [
            'email' => \App\Models\Setting::where('key', 'contact_email')->first()?->value,
            'linkedin' => \App\Models\Setting::where('key', 'link_linkedin')->first()?->value,
            'github' => \App\Models\Setting::where('key', 'link_github')->first()?->value,
            'instagram' => \App\Models\Setting::where('key', 'link_instagram')->first()?->value,
            'photo' => \App\Models\Setting::where('key', 'profile_photo')->first()?->value,
        ]);
    }
}
