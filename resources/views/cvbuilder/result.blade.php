<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-12">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HEADER -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-10 border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">✨ CV Optimisé</h1>
                        <p class="text-gray-600 mt-1">Résultat généré par l’IA</p>
                    </div>

                    <div class="flex flex-wrap gap-3">

                        <a href="/cvbuilder/{{ $optimizedCV->id }}/edit"
                           class="px-5 py-2 rounded-xl bg-blue-500 text-white font-semibold shadow hover:bg-blue-600 hover:shadow-lg transition">
                            ✏️ Modifier
                        </a>

                        <a href="/cvbuilder"
                           class="px-5 py-2 rounded-xl bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200 transition">
                            ← Retour
                        </a>

                    </div>

                </div>
            </div>

            <!-- CONTENT -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold shadow">
                        AI
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Contenu généré</h2>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 text-gray-800 leading-relaxed whitespace-pre-wrap">
                    {!! nl2br(e($optimizedContent)) !!}
                </div>

            </div>

            <!-- ACTION BAR -->
            <div class="mt-6 bg-white rounded-2xl shadow-lg p-6 border border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <p class="text-gray-600">
                    💡 Conseil: personnalisez avant envoi
                </p>

                <button onclick="copyText()"
                        class="px-5 py-3 rounded-xl bg-green-500 text-white font-semibold shadow hover:bg-green-600 hover:shadow-lg transition">
                    📋 Copier
                </button>

            </div>

        </div>

    </div>

    <script>
        function copyText() {
            navigator.clipboard.writeText(
                document.querySelector('.whitespace-pre-wrap').innerText
            ).then(() => {
                const btn = event.target;
                btn.innerText = '✅ Copié';
                setTimeout(() => btn.innerText = '📋 Copier', 1500);
            });
        }
    </script>

</x-app-layout>