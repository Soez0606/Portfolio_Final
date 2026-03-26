<x-filament-panels::page>
    <div class="grid gap-y-10"> {{-- Ajoute un grand espace vertical entre les blocs --}}

        {{-- Section Diplômes --}}
        <x-filament::section>
            <x-slot name="heading">
                <span class="text-xl font-bold">Mes Diplômes</span>
            </x-slot>

            <div class="mt-4">
                @livewire('list-education-table')
            </div>
        </x-filament::section>

        {{-- Section Formations --}}
        <x-filament::section>
            <x-slot name="heading">
                <span class="text-xl font-bold">Mes Formations</span>
            </x-slot>

            <div class="mt-4">
                @livewire('list-formation-table')
            </div>
        </x-filament::section>

    </div>
</x-filament-panels::page>
