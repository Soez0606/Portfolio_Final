<?php

use App\Livewire\Home;
use Illuminate\Support\Facades\Route;
use App\Livewire\Veille\ListPosts;
use App\Livewire\ExperienceList;

Route::get('/', Home::class);

Route::get('/projets', function () {
    return view('projects.index', [
        'projects' => \App\Models\Project::all()
    ]);
})->name('projects.index');

Route::get('/parcours', function () {
    return view('education.index', [
        // On récupère le parcours scolaire classique
        'educations' => \App\Models\Education::orderBy('start_date', 'desc')->get(),

        // On ajoute la récupération de tes nouvelles formations
        'formations' => \App\Models\Formation::orderBy('date', 'desc')->get()
    ]);
})->name('education.index');

Route::get('/veille', ListPosts::class)->name('veille');
Route::get('/experiences', ExperienceList::class)->name('experiences');
