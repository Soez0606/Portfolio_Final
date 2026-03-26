<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $settings = Setting::where('key', 'like', 'hero_%')->pluck('value', 'key');

        return view('livewire.home', [
            'title'       => $settings['hero_title'] ?? 'Développeur Web',
            'description' => $settings['hero_description'] ?? 'Bienvenue sur mon portfolio.',
            'photo'       => $settings['hero_photo'] ?? null,
        ]);
    }
}
