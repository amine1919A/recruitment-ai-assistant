<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- HEADER -->
            <div class="mb-10">
                <h1 class="text-4xl font-extrabold text-gray-900">🎤 Interview AI</h1>
                <p class="text-gray-600 mt-2 text-lg">
                    Entraînez-vous avec un recruteur intelligent
                </p>

                @if($cvs->count() > 0)
                    <a href="/interview/select"
                       class="inline-block mt-6 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:scale-105 transition font-semibold">
                        Démarrer une interview
                    </a>
                @endif
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <div class="bg-white p-6 rounded-2xl shadow border">
                    <p class="text-gray-500">Total interviews</p>
                    <p class="text-3xl font-bold">{{ $totalInterviews }}</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow border">
                    <p class="text-gray-500">Score moyen</p>
                    <p class="text-3xl font-bold">{{ number_format($avgScore,1) }}/10</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow border">
                    <p class="text-gray-500">Meilleur score</p>
                    <p class="text-3xl font-bold">{{ $bestScore }}/10</p>
                </div>

            </div>

            <!-- EMPTY STATE -->
            @if($interviews->count() == 0)
                <div class="bg-white p-10 rounded-2xl shadow text-center">
                    <p class="text-gray-500 text-lg">Aucun interview encore</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>