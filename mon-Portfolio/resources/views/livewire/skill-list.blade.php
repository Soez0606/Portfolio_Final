<div class="grid grid-cols-1 md:grid-cols-2 gap-16">
    <div class="space-y-6">
        <h3 class="flex items-center gap-2 font-bold text-blue-600 uppercase tracking-widest text-sm">
            <span class="w-8 h-px bg-blue-600"></span> Soft Skills
        </h3>
        <div class="grid grid-cols-2 gap-4">
            @foreach($skills->where('type', 'soft') as $skill)
                <div class="p-4 bg-blue-50/50 rounded-xl border border-blue-100 font-bold text-blue-600">
                    {{ $skill->name }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="space-y-6">
        <h3 class="flex items-center gap-2 font-bold text-purple-600 uppercase tracking-widest text-sm">
            <span class="w-8 h-px bg-purple-600"></span> Hard Skills
        </h3>
        <div class="grid grid-cols-2 gap-4">
            @foreach($skills->where('type', 'hard') as $skill)
                <div
                    class="p-4 bg-purple-50/50 rounded-xl border border-purple-100 font-bold text-purple-600">
                    {{ $skill->name }}
                </div>
            @endforeach
        </div>
    </div>
</div>
