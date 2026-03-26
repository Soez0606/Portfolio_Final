<?php

namespace App\Livewire;

use Livewire\Component;

class ExperienceList extends Component
{
    public function render()
    {
        return view('livewire.experience-list', [
            'experiences' => \App\Models\Experience::orderBy('start_date', 'desc')->get(),
        ]);
    }
}
