<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-4">Résultat Analyse IA 🤖</h2>

        <div class="bg-gray-100 p-4 rounded whitespace-pre-line">
            {{ $analysis }}
        </div>

        <div class="mt-6">
            <a href="/cv" class="text-blue-600">
                ← Retour Upload
            </a>
        </div>

    </div>
</x-app-layout>