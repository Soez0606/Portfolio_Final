<x-layouts.app>
    <div class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- En-tête avec un trait de rappel --}}
        <div class="mb-20">
            <h1 class="text-5xl font-black text-slate-900 tracking-tighter italic">Mon Parcours scolaire</h1>
            <div class="mt-4 h-1.5 w-24 bg-blue-600 rounded-full"></div>
        </div>

        {{-- GRILLE PRINCIPALE --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start">

            {{-- COLONNE GAUCHE : DIPLÔMES (Accent Bleu) --}}
            <div class="space-y-12">
                <h2 class="text-xl font-bold text-blue-600 uppercase tracking-[0.2em] flex items-center gap-4">
                    Diplômes
                    <div class="flex-grow h-px bg-blue-100"></div>
                </h2>

                <div class="space-y-12">
                    @foreach($educations as $edu)
                        <div class="group relative pl-10">
                            {{-- Ligne verticale --}}
                            <div
                                class="absolute left-0 top-0 bottom-0 w-px bg-slate-200 group-hover:bg-blue-400 transition-colors">
                            </div>
                            {{-- Point coloré --}}
                            <div
                                class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full border-2 border-white bg-blue-600 shadow-[0_0_0_3px_rgba(37,99,235,0.1)]">
                            </div>

                            <div class="space-y-2">
                                <span class="text-sm font-bold text-blue-500/80">
                                    {{ $edu->start_date->format('Y') }} —
                                    {{ $edu->end_date ? $edu->end_date->format('Y') : 'Présent' }}
                                </span>
                                <h3 class="text-2xl font-extrabold text-slate-900 leading-tight">
                                    {{ $edu->degree }}
                                </h3>
                                <p class="text-lg text-slate-500 font-medium italic">{{ $edu->school }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- COLONNE DROITE : FORMATIONS (Accent Violet) --}}
            <div class="space-y-12">
                <h2 class="text-xl font-bold text-purple-600 uppercase tracking-[0.2em] flex items-center gap-4">
                    Formations
                    <div class="flex-grow h-px bg-purple-100"></div>
                </h2>

                <div class="space-y-12">
                    @foreach($formations as $formation)
                        <div class="group relative pl-10">
                            {{-- Ligne verticale --}}
                            <div
                                class="absolute left-0 top-0 bottom-0 w-px bg-slate-200 group-hover:bg-purple-400 transition-colors">
                            </div>
                            {{-- Point coloré --}}
                            <div
                                class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full border-2 border-white bg-purple-600 shadow-[0_0_0_3px_rgba(147,51,234,0.1)]">
                            </div>

                            <div class="space-y-2">
                                <span class="text-sm font-bold text-purple-500/80">
                                    {{ $formation->date }}
                                </span>
                                <h3 class="text-2xl font-extrabold text-slate-900 leading-tight">
                                    {{ $formation->titre }}
                                </h3>
                                <p class="text-lg text-slate-500 font-medium italic">{{ $formation->organisme }}</p>

                                @if($formation->file)
                                    <div class="mt-4 pt-2">
                                        <a href="{{ asset('storage/' . $formation->file) }}" target="_blank"
                                            class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-widest text-purple-600 hover:text-purple-700 transition-all group/link">
                                            <span>Consulter le certificat</span>
                                            <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>
