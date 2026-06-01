<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-black text-white">

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- HEADER -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold">Dashboard AI 🚀</h1>
            <p class="text-white/60 mt-2">Analyse intelligente de recrutement</p>
        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

            @foreach([
                ['📄',$cvs->count(),'CV'],
                ['🎤',$interviews->count(),'Interviews'],
                ['🔍',$matches->count(),'Matches'],
                ['✨',optional($optimizedCVs)->count() ?? 0,'Optimisés']
            ] as [$icon,$value,$label])

                <div class="bg-white/10 backdrop-blur-xl border border-white/10 rounded-2xl p-6">
                    <div class="text-3xl">{{ $icon }}</div>
                    <div class="text-3xl font-bold mt-2">{{ $value }}</div>
                    <div class="text-white/60 text-sm">{{ $label }}</div>
                </div>

            @endforeach

        </div>

        <!-- QUICK ACTIONS -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-10">

            @foreach([
                ['cv','📄 Analyse CV'],
                ['interview','🎤 Interview'],
                ['match','🔍 Match'],
                ['cvbuilder','✨ Builder'],
                ['admin','👔 Admin']
            ] as [$url,$label])

                <a href="/{{ $url }}"
                   class="bg-white/10 hover:bg-white/20 transition p-6 rounded-2xl border border-white/10">
                    {{ $label }}
                </a>

            @endforeach

        </div>

        <!-- LISTS -->
        <div class="grid md:grid-cols-2 gap-6">

            <div class="bg-white/10 p-6 rounded-2xl border border-white/10">
                <h3 class="font-bold mb-4">Derniers CV</h3>
                @foreach($cvs->take(5) as $cv)
                    <div class="text-white/70 text-sm border-b border-white/10 py-2">
                        {{ basename($cv->file_path) }}
                    </div>
                @endforeach
            </div>

            <div class="bg-white/10 p-6 rounded-2xl border border-white/10">
                <h3 class="font-bold mb-4">Interviews</h3>
                @foreach($interviews->take(5) as $i)
                    <div class="text-white/70 text-sm border-b border-white/10 py-2">
                        {{ \Illuminate\Support\Str::limit($i->question, 50) }}
                    </div>
                @endforeach
            </div>

        </div>

    </div>

</div>
</x-app-layout>