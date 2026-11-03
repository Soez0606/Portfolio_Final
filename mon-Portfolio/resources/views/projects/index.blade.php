@php
    // Le projet perso le plus récent est mis en avant, les autres vont dans la grille.
    $featured = $projects->firstWhere('category', 'perso');
    $others = $featured ? $projects->reject(fn ($p) => $p->is($featured)) : $projects;
    $counts = [
        'all' => $projects->count(),
        'perso' => $projects->where('category', 'perso')->count(),
        'scolaire' => $projects->where('category', 'scolaire')->count(),
    ];
    $filters = ['all' => 'Tous', 'perso' => 'Personnels', 'scolaire' => 'Scolaires'];
@endphp

<x-layouts.app>
    <div class="py-8 md:py-12" x-data="{ filter: 'all' }">

        {{-- En-tête --}}
        <header class="mb-10 md:mb-14 space-y-4">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter">Mes Réalisations</h1>
            <div class="h-1.5 w-24 bg-blue-600 rounded-full"></div>
            <p class="text-slate-500 max-w-2xl">
                Projets personnels et travaux réalisés en formation.
            </p>
        </header>

        @if($projects->isEmpty())
            <p class="text-slate-500 italic">Aucun projet pour le moment.</p>
        @else
            {{-- Filtres --}}
            <div role="tablist" aria-label="Filtrer les projets"
                class="mb-8 inline-flex flex-wrap gap-1 p-1 bg-white rounded-2xl border border-slate-100 shadow-sm">
                @foreach($filters as $key => $label)
                    <button type="button" role="tab" @click="filter = '{{ $key }}'"
                        :aria-selected="(filter === '{{ $key }}').toString()"
                        :class="filter === '{{ $key }}' ? 'bg-slate-900 text-white' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-50'"
                        class="px-4 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition">
                        {{ $label }}
                        <span class="ml-1 opacity-60">{{ $counts[$key] }}</span>
                    </button>
                @endforeach
            </div>

            {{-- Projet à la une --}}
            @if($featured)
                <div x-show="filter === 'all' || filter === 'perso'" x-transition.opacity class="mb-8">
                    <x-project-card :project="$featured" featured />
                </div>
            @endif

            {{-- Grille --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($others as $project)
                    <div x-show="filter === 'all' || filter === '{{ $project->category }}'" x-transition.opacity
                        class="flex">
                        <x-project-card :project="$project" class="w-full" />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
