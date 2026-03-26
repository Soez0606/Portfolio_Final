<div class="py-24 max-w-7xl mx-auto px-6 relative">

    {{-- En-tête --}}
    <div class="mb-20">
        <h1 class="text-5xl font-black text-slate-900 tracking-tighter italic">Expériences Professionnelles</h1>
        <div class="mt-4 h-1.5 w-24 bg-blue-600 rounded-full"></div>
    </div>

    <div class="max-w-5xl space-y-24">
        @foreach($experiences as $exp)
            <article class="group relative pl-12">
                {{-- LIGNE AFFINÉE : Passage de w-1 à w-px (1px) --}}
                <div
                    class="absolute left-0 top-0 bottom-0 w-px bg-slate-200 group-hover:bg-blue-600 transition-all duration-500">
                </div>

                {{-- POINT D'ANCRAGE AJUSTÉ : Plus petit pour matcher la ligne fine --}}
                <div
                    class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full border-2 border-white bg-blue-600 shadow-[0_0_0_3px_rgba(37,99,235,0.1)]">
                </div>

                <div class="flex flex-col lg:flex-row gap-12 items-start">

                    {{-- GAUCHE : Bloc Date Style "Glass" (Conservé selon ton souhait) --}}
                    <div class="w-full lg:w-64 flex-shrink-0">
                        <div
                            class="relative p-6 rounded-[2rem] border border-slate-100 bg-white/40 backdrop-blur-md shadow-xl shadow-blue-900/5 group-hover:-translate-y-1 transition-transform duration-500">
                            <div class="absolute top-4 right-4 w-2 h-2 rounded-full bg-blue-600/20"></div>

                            <div class="space-y-1">
                                <span
                                    class="block text-[10px] font-black uppercase tracking-widest text-slate-400">Depuis</span>
                                <span class="block text-xl font-black text-slate-900 tracking-tight uppercase">
                                    {{ $exp->start_date->translatedFormat('M Y') }}
                                </span>
                            </div>

                            <div class="my-4 h-px w-full bg-slate-100"></div>

                            <div class="space-y-1">
                                <span
                                    class="block text-[10px] font-black uppercase tracking-widest text-blue-600/60">Jusqu'à</span>
                                <span class="block text-xl font-black text-blue-600 tracking-tight uppercase">
                                    {{ $exp->end_date ? $exp->end_date->translatedFormat('M Y') : 'Présent' }}
                                </span>
                            </div>

                            <p
                                class="mt-4 flex items-center gap-2 text-[9px] font-bold text-slate-400 uppercase tracking-widest">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                {{ $exp->location ?? 'France' }}
                            </p>
                        </div>
                    </div>

                    {{-- DROITE : Détails --}}
                    <div class="flex-grow space-y-6">
                        <div>
                            <h2
                                class="text-3xl font-black text-slate-900 tracking-tight leading-tight group-hover:text-blue-600 transition-colors duration-500">
                                {{ $exp->job_title }}
                            </h2>
                            <p class="text-xl text-blue-600 font-bold italic mt-1 uppercase tracking-tighter">
                                {{ $exp->company }}
                            </p>
                        </div>

                        {{-- Description --}}
                        <div
                            class="text-slate-500 leading-relaxed text-base max-w-3xl border-l-2 border-slate-100 pl-6 py-2 italic bg-slate-50/30 rounded-r-2xl">
                            {!! nl2br(e($exp->description)) !!}
                        </div>

                        {{-- Technologies --}}
                        @if($exp->technologies)
                            <div class="flex flex-wrap gap-2 pt-2">
                                @foreach(explode(',', $exp->technologies) as $tech)
                                    <span
                                        class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-sm hover:bg-blue-600 hover:-translate-y-1 transition-all duration-300">
                                        {{ trim($tech) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</div>
