<div> {{-- DIV RACINE UNIQUE POUR LIVEWIRE --}}
    <div class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- En-tête : Cohérence avec Expériences --}}
        <div class="mb-20">
            <h1 class="text-5xl font-black text-slate-900 tracking-tighter italic">Veille Technologique</h1>
            <div class="mt-4 h-1.5 w-24 bg-blue-600 rounded-full"></div>
        </div>

        <div class="max-w-5xl border-l border-slate-100 ml-4">
            @foreach($posts as $post)
                <article class="relative pl-12 pb-20 group">
                    {{-- Ligne et Point de timeline affinés (1px) --}}
                    <div
                        class="absolute left-0 top-0 bottom-0 w-px bg-slate-200 group-hover:bg-blue-400 transition-colors">
                    </div>
                    <div
                        class="absolute -left-[5px] top-2 h-2.5 w-2.5 rounded-full border-2 border-white bg-blue-600 shadow-[0_0_0_3px_rgba(37,99,235,0.1)]">
                    </div>

                    <div class="flex flex-col gap-6">
                        {{-- Meta & Titre (Style Expériences) --}}
                        <div class="space-y-1">
                            <div
                                class="flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.2em] text-blue-600/70">
                                <span>{{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : $post->created_at->translatedFormat('d M Y') }}</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span class="text-slate-400 italic lowercase font-medium">via {{ $post->tool }}</span>
                            </div>

                            <h2
                                class="text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase group-hover:text-blue-600 transition-colors duration-300">
                                {{ $post->title }}
                            </h2>
                        </div>

                        {{-- Description : Bloc platiné (Repris d'Expériences) --}}
                        <div
                            class="text-slate-500 leading-relaxed text-base max-w-3xl border-l-2 border-slate-100 pl-6 py-2 italic bg-slate-50/30 rounded-r-2xl">
                            <p
                                class="font-bold text-slate-700 not-italic mb-2 uppercase text-[11px] tracking-widest text-blue-600/80">
                                Résumé de veille</p>
                            {!! $post->summary !!}
                        </div>

                        {{-- Mots-clés : Badges Noirs (Exactement comme image_88dd7c) --}}
                        @if($post->keywords)
                            <div class="flex flex-wrap gap-2 pt-2">
                                @php $keywordsArray = is_array($post->keywords) ? $post->keywords : explode(',', $post->keywords); @endphp
                                @foreach($keywordsArray as $keyword)
                                    <span
                                        class="px-3 py-1 bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-full shadow-sm hover:bg-blue-600 hover:-translate-y-1 transition-all duration-300">
                                        {{ trim($keyword) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Action : Flèche animée (Cohérence Projets/Expériences) --}}
                        @if($post->source_url)
                            <div class="pt-2">
                                <a href="{{ $post->source_url }}" target="_blank"
                                    class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 hover:text-blue-600 hover:gap-4 transition-all duration-300">
                                    <span>Consulter la source</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>

        @if($posts->hasPages())
            <div class="mt-12 pt-10 border-t border-slate-50">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
