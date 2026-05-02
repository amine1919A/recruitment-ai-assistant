<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">🤖 Analyse CV</h2>
                <p class="text-gray-600 mt-1">{{ basename($cv->file_path) }}</p>
            </div>
            <a href="{{ route('cv.index') }}"
               class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition font-semibold">
                ← Retour
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8 border">
            <div class="prose max-w-none">
                <div class="bg-gray-50 p-6 rounded-lg border text-gray-800 leading-relaxed whitespace-pre-wrap">
                    {!! nl2br(e($analysis)) !!}
                </div>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="bg-gray-50 rounded-lg p-6 mt-6 flex justify-between items-center">
            <p class="text-gray-700">
                <strong>Analysé le :</strong> {{ $cv->created_at->format('d/m/Y à H:i') }}
            </p>
            <div class="flex gap-3">
                <button onclick="copyToClipboard()" 
                        class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition font-semibold">
                    📋 Copier
                </button>
                <a href="/interview/start?cv_id={{ $cv->id }}" 
                   class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition font-semibold">
                    🎤 Interview
                </a>
            </div>
        </div>

    </div>

    <script>
        function copyToClipboard() {
            const text = document.querySelector('.whitespace-pre-wrap').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('✅ Analyse copiée dans le presse-papier !');
            });
        }
    </script>
</x-app-layout>