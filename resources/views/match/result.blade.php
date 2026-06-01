<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- HEADER -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">🔍 Résultat du Matching</h2>
                        <p class="text-gray-600 mt-2">{{ basename($cv->file_path) }}</p>
                        <p class="text-sm text-purple-600 font-semibold mt-1">
                            Analyse IA générée automatiquement
                        </p>
                    </div>

                    <a href="{{ route('match.index') }}"
                       class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition shadow-sm">
                        ← Retour
                    </a>
                </div>
            </div>

            <!-- RESULT CARD -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow">
                        AI
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Analyse détaillée</h3>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 text-gray-800 leading-relaxed whitespace-pre-wrap">
                    {!! nl2br(e($result)) !!}
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <p class="text-gray-700">
                    <span class="font-semibold">Analysé le :</span>
                    <span class="text-gray-900">{{ $match->created_at->format('d/m/Y à H:i') }}</span>
                </p>

                <div class="flex flex-wrap gap-3">

                    <button onclick="copyToClipboard()"
                            class="px-5 py-3 rounded-xl bg-green-500 text-white font-semibold shadow hover:bg-green-600 hover:shadow-lg transition">
                        📋 Copier
                    </button>

                    <a href="/cvbuilder/create?cv_id={{ $cv->id }}"
                       class="px-5 py-3 rounded-xl bg-orange-500 text-white font-semibold shadow hover:bg-orange-600 hover:shadow-lg transition">
                        ✨ Optimiser CV
                    </a>

                    <a href="{{ route('match.index') }}"
                       class="px-5 py-3 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                        Retour
                    </a>

                </div>
            </div>

        </div>
    </div>

    <script>
        function copyToClipboard() {
            const text = document.querySelector('.whitespace-pre-wrap').innerText;
            navigator.clipboard.writeText(text).then(() => {
                const btn = event.target;
                btn.innerText = '✅ Copié';
                setTimeout(() => {
                    btn.innerText = '📋 Copier';
                }, 2000);
            });
        }
    </script>
</x-app-layout>