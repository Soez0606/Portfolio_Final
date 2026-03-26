<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-slate-50 font-sans antialiased text-slate-900">
    <div class="fixed inset-0 -z-10 overflow-hidden bg-slate-50">
        <div
            class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-blue-200/40 blur-[120px] animate-blob">
        </div>
        <div
            class="absolute top-[20%] -right-[10%] w-[35%] h-[35%] rounded-full bg-indigo-200/40 blur-[120px] animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-[10%] left-[20%] w-[40%] h-[40%] rounded-full bg-purple-200/30 blur-[120px] animate-blob animation-delay-4000">
        </div>
    </div>


    <main class="max-w-5xl mx-auto p-6">
        {{ $slot }}
    </main>

    @livewire('contact-widget')

    @php
        $email = \App\Models\Setting::where('key', 'contact_email')->first()?->value;
        $linkedin = \App\Models\Setting::where('key', 'link_linkedin')->first()?->value;
        $github = \App\Models\Setting::where('key', 'link_github')->first()?->value;
        $instagram = \App\Models\Setting::where('key', 'link_instagram')->first()?->value;
    @endphp

    <footer class="mt-20 border-t border-slate-100 bg-white/50 backdrop-blur-md">
    </footer>

    <nav class="fixed top-8 left-1/2 -translate-x-1/2 z-">
        <div
            class="bg-white/90 backdrop-blur-md border border-white/40 px-8 py-3 rounded-full shadow-2xl flex items-center gap-10">
        </div>
    </nav>

    @livewireScripts
</body>

</html>
@php
    $email = \App\Models\Setting::where('key', 'contact_email')->first()?->value;
    $linkedin = \App\Models\Setting::where('key', 'link_linkedin')->first()?->value;
    $github = \App\Models\Setting::where('key', 'link_github')->first()?->value;
    $instagram = \App\Models\Setting::where('key', 'link_instagram')->first()?->value;
@endphp

<footer class="mt-20 border-t border-slate-100 bg-white/50 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-12">

        <div class="space-y-4">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-900">Masurier Soëz</h3>
            <p class="text-sm text-slate-500">Portfolio développé avec Laravel & Filament.</p>
        </div>

        <div class="space-y-4">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-900">Contact</h3>
            <div class="flex flex-col gap-2">
                @if($email)
                    <a href="mailto:{{ $email }}"
                        class="text-sm text-slate-500 hover:text-blue-600 transition italic">{{ $email }}</a>
                @endif
                <div class="flex gap-4 pt-2">
                    @if($linkedin)
                        <a href="{{ $linkedin }}" target="_blank"
                            class="text-slate-400 hover:text-[#0077b5] transition-all transform hover:scale-110"
                            title="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.761 0 5-2.239 5-5v-14c0-2.761-2.239-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg>
                        </a>
                    @endif

                    @if($github)
                        <a href="{{ $github }}" target="_blank"
                            class="text-slate-400 hover:text-[#333] transition-all transform hover:scale-110"
                            title="GitHub">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                            </svg>
                        </a>
                    @endif

                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank"
                            class="text-slate-400 hover:text-[#e4405f] transition-all transform hover:scale-110"
                            title="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-900">Légal</h3>
            <p class="text-[10px] text-slate-400">© {{ date('Y') }} — Fait avec passion.</p>
            <p class="text-[10px] text-slate-400">Hébergé par [Ton Hébergeur]</p>
        </div>

    </div>
</footer>

<nav class="fixed top-8 left-1/2 -translate-x-1/2 z-90">
    <div
        class="bg-white/90 backdrop-blur-md border border-white/40 px-8 py-3 rounded-full shadow-2xl flex items-center gap-10">

        {{-- 1. ACCUEIL --}}
        <a href="/"
            class="text-xs font-black uppercase tracking-[0.2em] {{ request()->is('/') ? 'text-slate-800 font-extrabold' : 'text-slate-400' }} hover:text-blue-600 transition-colors">
            Accueil
        </a>

        {{-- 2. COMPÉTENCES --}}
        <a href="/#skills"
            class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 hover:text-blue-600 transition-colors">
            Compétences
        </a>

        {{-- 3. EXPÉRIENCES --}}
        <a href="{{ route('experiences') }}"
            class="text-xs font-black uppercase tracking-[0.2em] {{ request()->is('experiences') ? 'text-slate-800' : 'text-slate-400' }} hover:text-blue-600 transition-colors">
            Expériences
        </a>

        {{-- 4. PARCOURS SCOLAIRE --}}
        <a href="{{ route('education.index') }}"
            class="text-xs font-black uppercase tracking-[0.2em] {{ request()->is('parcours') ? 'text-slate-800' : 'text-slate-400' }} hover:text-blue-600 transition-colors">
            Parcours scolaire
        </a>

        {{-- 5. PROJETS --}}
        <a href="{{ route('projects.index') }}"
            class="text-xs font-black uppercase tracking-[0.2em] {{ request()->is('projets') ? 'text-slate-800' : 'text-slate-400' }} hover:text-blue-600 transition-colors">
            Projets
        </a>

        {{-- 6. VEILLE TECHNOLOGIQUE --}}
        <a href="{{ route('veille') }}"
            class="text-xs font-black uppercase tracking-[0.2em] {{ request()->is('veille') ? 'text-slate-800' : 'text-slate-400' }} hover:text-blue-600 transition-colors">
            Veille Technologique
        </a>

    </div>
</nav>

@livewireScripts
</body>

</html>
