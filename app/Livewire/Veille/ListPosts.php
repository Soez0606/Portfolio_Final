<?php

namespace App\Livewire\Veille;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ListPosts extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.veille.list-posts', [
            'posts' => Post::where('is_published', true)
                ->latest()
                ->paginate(9),
        ]);
    }
}
