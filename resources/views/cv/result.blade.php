<x-app-layout>

    <div class="min-h-screen bg-gray-100">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8">

                <div>
                    <h1 class="text-4xl font-bold text-gray-800">
                        🤖 Analyse IA du CV
                    </h1>

                    <p class="text-gray-500 mt-2">
                        {{ basename($cv->file_path) }}
                    </p>
                </div>

                <a href="{{ route('cv.index') }}"
                   class="mt-4 lg:mt-0 bg-gray-700 hover:bg-gray-800 text-white px-6 py-3 rounded-xl font-semibold transition">
                    ← Retour
                </a>

            </div>

            <!-- Main Result -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-6">

                    <h2 class="text-2xl font-bold">
                        📊 Résultat de l'analyse
                    </h2>

                    <p class="opacity-90 mt-2">
                        Rapport généré automatiquement par l'intelligence artificielle.
                    </p>

                </div>

                <div class="p-8">

                    <div id="analysisContent"
                         class="bg-gray-50 border rounded-2xl p-6 text-gray-800 leading-8 whitespace-pre-wrap text-base">
                        {!! nl2br(e($analysis)) !!}
                    </div>

                </div>

            </div>

            <!-- Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mt-8">

                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-5">

                    <div>

                        <h3 class="font-bold text-gray-800">
                            Informations
                        </h3>

                        <p class="text-gray-500 mt-1">
                            Analysé le {{ $cv->created_at->format('d/m/Y à H:i') }}
                        </p>

                    </div>

                    <div class="flex flex-wrap gap-3">

                        <button onclick="copyToClipboard()"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                            📋 Copier
                        </button>

                        <button onclick="window.print()"
                                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                            🖨️ Imprimer
                        </button>

                        <a href="/interview/start?cv_id={{ $cv->id }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                            🎤 Interview IA
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        function copyToClipboard() {

            const text =
                document.getElementById('analysisContent').innerText;

            navigator.clipboard.writeText(text)
                .then(() => {
                    alert('✅ Analyse copiée avec succès');
                })
                .catch(() => {
                    alert('❌ Erreur lors de la copie');
                });
        }
    </script>

</x-app-layout>