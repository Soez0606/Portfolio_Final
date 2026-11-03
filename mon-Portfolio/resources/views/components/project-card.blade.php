@props(['project', 'featured' => false])

@php
    $isPerso = $project->category === 'perso';
    $accent = $isPerso
        ? ['badge' => 'bg-blue-50 text-blue-700 ring-blue-200', 'text' => 'text-blue-700', 'hover' => 'group-hover:text-blue-700', 'placeholder' => 'from-blue-500 to-indigo-600']
        : ['badge' => 'bg-purple-50 text-purple-700 ring-purple-200', 'text' => 'text-purple-700', 'hover' => 'group-hover:text-purple-700', 'placeholder' => 'from-purple-500 to-fuchsia-600'];
    $technologies = $project->technologies
        ? array_filter(array_map('trim', explode(',', $project->technologies)))
        : [];
@endphp

<article x-data="{ expanded: false }"
    {{ $attributes->class([
        'group flex flex-col bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-900/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden',
        'md:flex-row' => $featured,
    ]) }}>

    {{-- Visuel --}}
    <div @class([
        'relative shrink-0 overflow-hidden',
        'aspect-[16/9]' => ! $featured,
        'aspect-[16/9] md:aspect-auto md:w-1/2 md:min-h-[320px]' => $featured,
    ])>
        @if($project->image)
            <div class="absolute inset-0 bg-slate-50 flex items-center justify-center p-6">
                <img src="{{ asset('storage/' . $project->image) }}" alt="" loading="lazy"
                    class="max-w-full max-h-full object-contain transition-transform duration-700 group-hover:scale-105">
            </div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br {{ $accent['placeholder'] }} flex items-center justify-center">
                <span class="text-6xl font-black text-white/90 tracking-tighter select-none" aria-hidden="true">
                    {{ mb_strtoupper(mb_substr($project->title, 0, 1)) }}
                </span>
            </div>
        @endif

        <span
            class="absolute top-4 left-4 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest ring-1 {{ $accent['badge'] }}">
            {{ $isPerso ? 'Perso' : 'Scolaire' }}
        </span>
        @if($featured)
            <span
                class="absolute top-4 right-4 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-slate-900 text-white">
                À la une
            </span>
        @endif
    </div>

    {{-- Contenu --}}
    <div @class(['flex flex-col flex-1 p-6 gap-4', 'md:p-10 md:justify-center' => $featured])>
        <h3 @class([
            'font-extrabold text-slate-900 leading-tight transition-colors',
            $accent['hover'],
            'text-xl' => ! $featured,
            'text-2xl md:text-3xl' => $featured,
        ])>
            {{ $project->title }}
        </h3>

        @if($project->description)
            <div>
                <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line"
                    :class="expanded ? '' : '{{ $featured ? 'line-clamp-5' : 'line-clamp-3' }}'">
                    {{ $project->description }}
                </p>
                @if(mb_strlen($project->description) > ($featured ? 320 : 160))
                    <button type="button" @click="expanded = !expanded" :aria-expanded="expanded.toString()"
                        class="mt-1 text-xs font-bold {{ $accent['text'] }} hover:underline">
                        <span x-text="expanded ? 'Voir moins' : 'Lire la suite'">Lire la suite</span>
                    </button>
                @endif
            </div>
        @endif

        @if(count($technologies))
            <ul class="flex flex-wrap gap-1.5" aria-label="Technologies">
                @foreach($technologies as $tech)
                    <li
                        class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[11px] font-semibold rounded-md">
                        {{ $tech }}
                    </li>
                @endforeach
            </ul>
        @endif

        @if($project->link || $project->github_link || $project->file)
            <div class="mt-auto pt-4 border-t border-slate-100 flex flex-wrap gap-x-5 gap-y-2">
                @if($project->link)
                    <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-widest {{ $accent['text'] }} hover:opacity-75 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Consulter<span class="sr-only"> {{ $project->title }} (nouvel onglet)</span>
                    </a>
                @endif
                @if($project->github_link)
                    <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-widest text-slate-700 hover:text-slate-900 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.44 9.8 8.21 11.39.6.11.79-.26.79-.58v-2.23c-3.34.73-4.03-1.42-4.03-1.42-.55-1.39-1.33-1.76-1.33-1.76-1.09-.74.08-.73.08-.73 1.2.08 1.84 1.24 1.84 1.24 1.07 1.83 2.81 1.3 3.49 1 .11-.78.42-1.31.76-1.6-2.67-.31-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.12-.3-.54-1.52.12-3.18 0 0 1-.32 3.3 1.23a11.5 11.5 0 016 0c2.29-1.55 3.3-1.23 3.3-1.23.65 1.66.24 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.81 5.62-5.48 5.92.43.37.82 1.1.82 2.22v3.29c0 .32.19.69.8.58C20.57 21.8 24 17.3 24 12c0-6.63-5.37-12-12-12z" />
                        </svg>
                        GitHub<span class="sr-only"> (nouvel onglet)</span>
                    </a>
                @endif
                @if($project->file)
                    <a href="{{ asset('storage/' . $project->file) }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-widest text-slate-700 hover:text-slate-900 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Compte-rendu<span class="sr-only"> PDF (nouvel onglet)</span>
                    </a>
                @endif
            </div>
        @endif
    </div>
</article>
