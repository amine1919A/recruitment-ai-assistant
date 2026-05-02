<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <h2 class="text-3xl font-bold text-gray-800 mb-8">
            Dashboard Recrutement AI 📊
        </h2>

        <!-- ================== QUICK ACTIONS ================== -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">

            <a href="/cv"
               class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-center py-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                <span class="text-4xl">📄</span>
                <p class="mt-2 font-semibold">Analyser CV</p>
            </a>

            <a href="/interview"
               class="bg-gradient-to-r from-green-500 to-green-600 text-white text-center py-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                <span class="text-4xl">🎤</span>
                <p class="mt-2 font-semibold">Interview AI</p>
            </a>

            <a href="/match"
               class="bg-gradient-to-r from-purple-500 to-purple-600 text-white text-center py-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                <span class="text-4xl">🔍</span>
                <p class="mt-2 font-semibold">Job Match</p>
            </a>

            <!-- 🔥 CV BUILDER AJOUTÉ -->
            <a href="/cvbuilder"
               class="bg-gradient-to-r from-orange-500 to-orange-600 text-white text-center py-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                <span class="text-4xl">✨</span>
                <p class="mt-2 font-semibold">CV Builder</p>
            </a>

            <a href="/admin"
               class="bg-gradient-to-r from-gray-500 to-gray-600 text-white text-center py-6 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                <span class="text-4xl">👔</span>
                <p class="mt-2 font-semibold">Admin</p>
            </a>

        </div>

        <!-- ================== STATS ================== -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                <h3 class="text-gray-500 text-sm">CV Analysés</h3>
                <p class="text-3xl font-bold">{{ $cvs->count() }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                <h3 class="text-gray-500 text-sm">Entretiens</h3>
                <p class="text-3xl font-bold">{{ $interviews->count() }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                <h3 class="text-gray-500 text-sm">Job Matches</h3>
                <p class="text-3xl font-bold">{{ $matches->count() }}</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-orange-500">
                <h3 class="text-gray-500 text-sm">CV Optimisés</h3>
                <p class="text-3xl font-bold">
                    {{ optional($optimizedCVs)->count() ?? 0 }}
                </p>
            </div>

        </div>

        <!-- ================== PERFORMANCE ================== -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h3 class="font-bold mb-4">📈 Performance Moyenne</h3>

            <div class="w-full bg-gray-200 h-6 rounded-full overflow-hidden">
                <div class="bg-green-500 h-6 text-right pr-3 text-white"
                     style="width: {{ $avgScore ?? 0 }}%">
                    {{ round($avgScore ?? 0, 1) }}%
                </div>
            </div>
        </div>

        <!-- ================== LISTS ================== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- CV LIST -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold mb-4">📄 Derniers CV</h3>

                @forelse($cvs->take(5) as $cv)
                    <div class="border-b py-2">
                        {{ basename($cv->file_path) }}
                    </div>
                @empty
                    <p>Aucun CV</p>
                @endforelse
            </div>

            <!-- INTERVIEW LIST -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold mb-4">🎤 Entretiens</h3>

                @forelse($interviews->take(5) as $i)
                    <div class="border-b py-2">
                        {{ Str::limit($i->question, 50) }}
                    </div>
                @empty
                    <p>Aucun entretien</p>
                @endforelse
            </div>

        </div>

        <!-- ================== CV BUILDER LIST ================== -->
        <div class="bg-white p-6 rounded-lg shadow-md mt-8">
            <h3 class="font-bold mb-4">✨ CV Optimisés</h3>

            @forelse($optimizedCVs as $opt)
                <div class="border-b py-3 flex justify-between">
                    <div>
                        <p>{{ basename($opt->cv->file_path ?? 'N/A') }}</p>
                        <small>{{ $opt->created_at->diffForHumans() }}</small>
                    </div>

                    <a href="/cvbuilder/{{ $opt->id }}/edit"
                       class="text-blue-600 hover:underline">
                        Modifier
                    </a>
                </div>
            @empty
                <p class="text-gray-500 text-center">
                    Aucun CV optimisé
                </p>
            @endforelse

            <a href="/cvbuilder"
               class="block text-center text-orange-600 mt-4">
                Voir tous →
            </a>
        </div>

    </div>
</x-app-layout>