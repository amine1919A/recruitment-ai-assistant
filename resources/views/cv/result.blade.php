<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Résultat Analyse CV 🤖</h2>

        <div class="bg-gray-100 p-4 rounded">
            {!! nl2br(e($analysis)) !!}
        </div>

        <a href="/cv" class="text-blue-500 mt-4 inline-block">
            ← Retour
        </a>

    </div>
</x-app-layout>