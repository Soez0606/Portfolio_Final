<?php

namespace App\Livewire;

use App\Models\Skill;
use Livewire\Component;

class SkillList extends Component
{
    public function render()
    {
        return view('livewire.skill-list', [
            'skills' => Skill::all(),
        ]);
    }
}
