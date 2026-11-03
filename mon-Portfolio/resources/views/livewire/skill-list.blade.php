@php
    $hard = $skills->where('type', 'hard')->sortBy('name');
    $soft = $skills->where('type', 'soft')->sortBy('name');

    // Groupes dans l'ordre défini sur le modèle, les compétences sans groupe en dernier.
    $hardGroups = collect(\App\Models\Skill::CATEGORIES)
        ->map(fn ($label, $key) => ['label' => $label, 'skills' => $hard->where('category', $key)])
        ->push(['label' => 'Autres', 'skills' => $hard->whereNotIn('category', array_keys(\App\Models\Skill::CATEGORIES))])
        ->filter(fn ($group) => $group['skills']->isNotEmpty());
    $showGroupLabels = $hardGroups->count() > 1;
@endphp

<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
    {{-- Hard skills --}}
    <div class="lg:col-span-3 bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8 space-y-6">
        <h3 class="flex items-center justify-between gap-4">
            <span class="flex items-center gap-3 font-black text-purple-700 uppercase tracking-widest text-sm">
                <span class="w-8 h-px bg-purple-600" aria-hidden="true"></span> Techniques
            </span>
            <span class="text-xs font-bold text-slate-400">{{ $hard->count() }}</span>
        </h3>

        @foreach($hardGroups as $group)
            <div class="space-y-3">
                @if($showGroupLabels)
                    <h4 class="text-[11px] font-bold uppercase tracking-widest text-slate-400">{{ $group['label'] }}</h4>
                @endif
                <ul class="flex flex-wrap gap-2">
                    @foreach($group['skills'] as $skill)
                        <li
                            class="px-3.5 py-1.5 rounded-full bg-purple-50 text-purple-800 ring-1 ring-purple-100 text-sm font-semibold hover:bg-purple-100 transition">
                            {{ $skill->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    {{-- Soft skills --}}
    <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm p-6 md:p-8 space-y-6">
        <h3 class="flex items-center justify-between gap-4">
            <span class="flex items-center gap-3 font-black text-blue-700 uppercase tracking-widest text-sm">
                <span class="w-8 h-px bg-blue-600" aria-hidden="true"></span> Humaines
            </span>
            <span class="text-xs font-bold text-slate-400">{{ $soft->count() }}</span>
        </h3>
        <ul class="flex flex-wrap gap-2">
            @foreach($soft as $skill)
                <li
                    class="px-3.5 py-1.5 rounded-full bg-blue-50 text-blue-800 ring-1 ring-blue-100 text-sm font-semibold hover:bg-blue-100 transition">
                    {{ $skill->name }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
