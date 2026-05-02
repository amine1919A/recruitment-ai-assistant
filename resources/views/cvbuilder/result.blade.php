<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">✨ Votre CV Optimisé</h2>
                <p class="text-gray-600 mt-1">Généré il y a quelques instants</p>
            </div>
            <div class="flex gap-3">
                <a href="/cvbuilder/{{ $optimizedCV->id }}/edit" class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition font-semibold">
                    ✏️ Modifier
                </a>
                <a href="/cvbuilder" class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition font-semibold">
                    ← Retour
                </a>
            </div>
        </div>

        <!-- CV CONTENT -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
            <div class="prose max-w-none">
                {!! nl2br(e($optimizedContent)) !!}
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="bg-gray-50 rounded-lg p-6 flex justify-between items-center">
            <p class="text-gray-700">
                <strong>Conseil :</strong> Relisez et personnalisez ce CV avant de l'envoyer
            </p>
            <button onclick="copyToClipboard()" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition font-semibold">
                📋 Copier le texte
            </button>
        </div>

    </div>

    <script>
        function copyToClipboard() {
            const text = document.querySelector('.prose').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('✅ CV copié dans le presse-papier !');
            });
        }
    </script>
</x-app-layout>