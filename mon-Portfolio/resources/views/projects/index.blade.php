<x-layouts.app>
    <div class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- En-tête --}}
        <div class="mb-20">
            <h1 class="text-5xl font-black text-slate-900 tracking-tighter italic ">Mes Réalisations</h1>
            <div class="mt-4 h-1.5 w-24 bg-blue-600 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">

            {{-- COLONNE GAUCHE : PROJETS PERSO --}}
            <div class="space-y-12">
                <h2 class="text-xl font-bold text-blue-600 uppercase tracking-[0.2em] flex items-center gap-4">
                    Projets Personnels
                    <div class="flex-grow h-px bg-blue-100"></div>
                </h2>

                <div class="space-y-16">
                    @foreach($projects->where('category', 'perso') as $project)
                        <article class="group relative pl-10">
                            <div
                                class="absolute left-0 top-0 bottom-0 w-px bg-slate-200 group-hover:bg-blue-400 transition-colors">
                            </div>
                            <div
                                class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full border-2 border-white bg-blue-600 shadow-[0_0_0_3px_rgba(37,99,235,0.1)]">
                            </div>

                            <div class="space-y-6">
                                {{-- ON AFFICHE LE RECTANGLE UNIQUEMENT SI L'IMAGE EXISTE --}}
                                @if($project->image)
                                    <div
                                        class="w-full overflow-hidden rounded-[2.5rem] shadow-xl shadow-blue-900/5 bg-white border border-slate-100 p-6 flex items-center justify-center min-h-[200px] group-hover:-translate-y-1 transition-transform duration-500">
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                            class="max-w-full max-h-40 object-contain transition-transform duration-700 group-hover:scale-110">
                                    </div>
                                @endif

                                <div class="space-y-2">
                                    <h3
                                        class="text-2xl font-extrabold text-slate-900 uppercase group-hover:text-blue-600 transition-colors">
                                        {{ $project->title }}
                                    </h3>
                                    <div
                                        class="text-slate-500 leading-relaxed text-sm border-l-2 border-slate-100 pl-4 py-1 italic bg-slate-50/30 rounded-r-xl">
                                        {{ $project->description }}
                                    </div>
                                </div>

                                @if($project->technologies)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $project->technologies) as $tech)
                                            <span
                                                class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-sm hover:bg-blue-600 hover:-translate-y-1 transition-all duration-300">
                                                {{ trim($tech) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            {{-- COLONNE DROITE : RÉALISATIONS SCOLAIRES --}}
            <div class="space-y-12">
                <h2 class="text-xl font-bold text-purple-600 uppercase tracking-[0.2em] flex items-center gap-4">
                    Projets Scolaire
                    <div class="flex-grow h-px bg-purple-100"></div>
                </h2>

                <div class="space-y-12">
                    @foreach($projects->where('category', 'scolaire') as $project)
                        <article class="group relative pl-10">
                            <div
                                class="absolute left-0 top-0 bottom-0 w-px bg-slate-200 group-hover:bg-purple-400 transition-colors">
                            </div>
                            <div
                                class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full border-2 border-white bg-purple-600 shadow-[0_0_0_3px_rgba(147,51,234,0.1)]">
                            </div>

                            <div class="space-y-4">
                                {{-- OPTIONNEL : Même logique ici si tu ajoutes des images aux TPs un jour --}}
                                @if($project->image)
                                    <div
                                        class="w-full overflow-hidden rounded-[2.5rem] shadow-xl shadow-purple-900/5 bg-white border border-slate-100 p-6 flex items-center justify-center min-h-[150px] mb-6">
                                        <img src="{{ asset('storage/' . $project->image) }}" class="max-h-32 object-contain">
                                    </div>
                                @endif

                                <h3
                                    class="text-2xl font-extrabold text-slate-900 uppercase group-hover:text-purple-600 transition-colors">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-lg text-slate-500 font-medium italic leading-relaxed">
                                    {{ $project->description }}
                                </p>

                                <div class="flex flex-wrap gap-4 mt-4">
                                    @if($project->link)
                                        <a href="{{ $project->link }}" target="_blank"
                                            class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-purple-600 hover:text-purple-700 transition-all group/link">
                                            <span>Consulter</span>
                                            <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    @endif

                                    @if($project->file)
                                        <a href="{{ asset('storage/' . $project->file) }}" target="_blank"
                                            class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-purple-600 hover:text-purple-700 transition-all group/file">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>Voir le Compte-rendu</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>
