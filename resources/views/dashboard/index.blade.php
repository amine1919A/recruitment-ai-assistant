<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            <!-- HEADER -->
            <div class="mb-10">
                <h1 class="text-4xl font-bold text-gray-900">
                    Dashboard Recrutement AI 📊
                </h1>
                <p class="text-gray-500 mt-2">
                    Suivi global de votre activité IA de recrutement
                </p>
            </div>

            <!-- QUICK ACTIONS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">

                <a href="/cv" class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition hover:-translate-y-1 border border-gray-100">
                    <div class="text-4xl mb-3">📄</div>
                    <h3 class="font-bold text-gray-800">Analyse CV</h3>
                    <p class="text-sm text-gray-500 mt-1">Uploader et analyser CV</p>
                </a>

                <a href="/interview" class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition hover:-translate-y-1 border border-gray-100">
                    <div class="text-4xl mb-3">🎤</div>
                    <h3 class="font-bold text-gray-800">Interview AI</h3>
                    <p class="text-sm text-gray-500 mt-1">Simulation entretien</p>
                </a>

                <a href="/match" class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition hover:-translate-y-1 border border-gray-100">
                    <div class="text-4xl mb-3">🔍</div>
                    <h3 class="font-bold text-gray-800">Job Match</h3>
                    <p class="text-sm text-gray-500 mt-1">Matching intelligent</p>
                </a>

                <a href="/cvbuilder" class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition hover:-translate-y-1 border border-gray-100">
                    <div class="text-4xl mb-3">✨</div>
                    <h3 class="font-bold text-gray-800">CV Builder</h3>
                    <p class="text-sm text-gray-500 mt-1">Optimisation CV IA</p>
                </a>

                <a href="/admin" class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition hover:-translate-y-1 border border-gray-100">
                    <div class="text-4xl mb-3">👔</div>
                    <h3 class="font-bold text-gray-800">Admin</h3>
                    <p class="text-sm text-gray-500 mt-1">Gestion système</p>
                </a>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl p-6 shadow-lg">
                    <p class="text-sm opacity-90">CV Analysés</p>
                    <h2 class="text-4xl font-bold mt-2">{{ $cvs->count() }}</h2>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl p-6 shadow-lg">
                    <p class="text-sm opacity-90">Entretiens</p>
                    <h2 class="text-4xl font-bold mt-2">{{ $interviews->count() }}</h2>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-2xl p-6 shadow-lg">
                    <p class="text-sm opacity-90">Job Matches</p>
                    <h2 class="text-4xl font-bold mt-2">{{ $matches->count() }}</h2>
                </div>

                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl p-6 shadow-lg">
                    <p class="text-sm opacity-90">CV Optimisés</p>
                    <h2 class="text-4xl font-bold mt-2">
                        {{ optional($optimizedCVs)->count() ?? 0 }}
                    </h2>
                </div>

            </div>

            <!-- PERFORMANCE -->
            <div class="bg-white rounded-2xl shadow-md p-6 mb-10 border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">📈 Performance Moyenne</h3>
                    <span class="text-sm text-gray-500">{{ round($avgScore ?? 0, 1) }}%</span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-400 to-green-600 h-4 text-xs text-white text-center leading-4"
                         style="width: {{ $avgScore ?? 0 }}%">
                    </div>
                </div>
            </div>

            <!-- LISTES -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- CV -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4">📄 Derniers CV</h3>

                    @forelse($cvs->take(5) as $cv)
                        <div class="flex justify-between py-2 border-b last:border-0">
                            <span class="text-gray-700 text-sm">
                                {{ basename($cv->file_path) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">Aucun CV</p>
                    @endforelse
                </div>

                <!-- INTERVIEWS -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-800 mb-4">🎤 Entretiens</h3>

                    @forelse($interviews->take(5) as $i)
                        <div class="flex justify-between py-2 border-b last:border-0">
                            <span class="text-gray-700 text-sm">
                                {{ \Illuminate\Support\Str::limit($i->question, 50) }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-sm">Aucun entretien</p>
                    @endforelse
                </div>

            </div>

            <!-- CV BUILDER -->
            <div class="bg-white rounded-2xl shadow-md p-6 mt-10 border border-gray-100">
                <h3 class="font-bold text-gray-800 mb-4">✨ CV Optimisés</h3>

                @forelse($optimizedCVs as $opt)
                    <div class="flex justify-between items-center py-3 border-b last:border-0">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ basename($opt->cv->file_path ?? 'N/A') }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $opt->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <a href="/cvbuilder/{{ $opt->id }}/edit"
                           class="text-sm text-blue-600 hover:underline">
                            Modifier
                        </a>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Aucun CV optimisé</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>