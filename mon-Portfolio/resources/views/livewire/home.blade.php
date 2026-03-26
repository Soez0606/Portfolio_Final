<div class="py-12 space-y-24">
    <section class="relative min-h-[80vh] flex items-center pt-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

            <div class="lg:col-span-7 space-y-8 order-2 lg:order-1">
                <div class="space-y-4">

                    <h1 class="text-6xl xl:text-8xl font-black text-slate-900 leading-[0.9] tracking-tighter">
                        {!! $title !!}
                    </h1>
                </div>

                <p class="text-xl text-slate-500 max-w-xl leading-relaxed font-medium border-l-4 border-blue-600 pl-6">
                    {{ $description }}
                </p>

                <div class="flex flex-wrap gap-5 pt-4">
                    <a href="{{ route('projects.index') }}"
                        class="group relative px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold overflow-hidden transition-all">
                        <span class="relative z-10">Voir mes projets</span>
                        <div
                            class="absolute inset-0 bg-blue-600 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        </div>
                    </a>
                    <button x-on:click="$dispatch('openContact')"
                        class="px-8 py-4 bg-white border border-slate-200 text-slate-900 rounded-2xl font-bold hover:bg-slate-50 transition-all shadow-sm">
                        Me contacter
                    </button>
                </div>
            </div>

            <div class="lg:col-span-5 order-1 lg:order-2">
                <div class="relative">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-purple-600/10 rounded-full blur-3xl"></div>

                    <div
                        class="relative z-10 aspect-[4/5] overflow-hidden rounded-[2rem] shadow-2xl border-[12px] border-white rotate-2 transition-all duration-[3000ms] animate-soft-float">
                        <img src="{{ asset('storage/' . $photo) }}" alt="Soëz Masurier"
                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section id="skills" class="space-y-10">
        <div class="flex items-center gap-4">
            <h2 class="text-3xl font-bold">Mes Compétences</h2>
            <div class="h-px flex-1 bg-slate-200"></div>
        </div>

        <livewire:skill-list />
    </section>
</div>
