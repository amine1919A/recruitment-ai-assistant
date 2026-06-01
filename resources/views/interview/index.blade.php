<x-app-layout>
<div class="min-h-screen bg-slate-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- HEADER -->
        <div class="mb-12">

            <div class="flex items-center justify-between mb-8">

                <div>
                    <h1 class="text-4xl font-bold text-gray-900">
                        🎤 Interview AI
                    </h1>
                    <p class="text-gray-500 mt-2">
                        Entraînez-vous avec un système d’interview intelligent SaaS
                    </p>
                </div>

                @if($cvs->count() > 0)
                    <a href="/interview/start"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold shadow-sm transition hover:shadow-md">
                        ▶ Démarrer Interview
                    </a>
                @endif

            </div>

            <!-- SUCCESS -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-100 text-green-700 p-4 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Total Interviews</p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalInterviews }}</h2>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Score Moyen</p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ number_format($avgScore, 1) }}/10
                    </h2>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                    <p class="text-sm text-gray-500">Meilleur Score</p>
                    <h2 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $bestScore }}/10
                    </h2>
                </div>

            </div>

        </div>

        <!-- LIST -->
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm">

            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-900">
                    Historique des Interviews
                </h2>
            </div>

            <div class="divide-y divide-gray-100">

                @forelse($interviews as $interview)

                    <div class="p-6 hover:bg-gray-50 transition">

                        <div class="flex gap-4">

                            <!-- AI Avatar -->
                            <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">
                                AI
                            </div>

                            <div class="flex-1">

                                <div class="flex justify-between">

                                    <p class="font-semibold text-gray-900">
                                        {{ $interview->question }}
                                    </p>

                                    <span class="text-sm px-3 py-1 rounded-full
                                        {{ $interview->score >= 7 ? 'bg-green-100 text-green-700' :
                                           ($interview->score >= 5 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $interview->score }}/10
                                    </span>

                                </div>

                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $interview->created_at->diffForHumans() }}
                                </p>

                                <!-- ANSWER -->
                                <div class="mt-4 bg-slate-50 border border-gray-100 rounded-xl p-4">
                                    <p class="text-sm font-semibold text-gray-700">Votre réponse</p>
                                    <p class="text-gray-600 mt-1">
                                        {{ $interview->answer }}
                                    </p>
                                </div>

                                <!-- FEEDBACK -->
                                @if($interview->feedback)
                                    <div class="mt-3 bg-indigo-50 border border-indigo-100 rounded-xl p-4">
                                        <p class="text-sm font-semibold text-indigo-700">
                                            Feedback IA
                                        </p>
                                        <p class="text-gray-700 mt-1 whitespace-pre-line">
                                            {{ $interview->feedback }}
                                        </p>
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="p-10 text-center text-gray-500">
                        Aucun interview pour le moment
                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>
</x-app-layout>