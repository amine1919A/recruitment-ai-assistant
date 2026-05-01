<x-app-layout>
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-4">Historique Entretiens 🎤</h2>

        <a href="/interview/start" class="bg-green-500 text-white px-4 py-2 rounded">
            Démarrer entretien
        </a>

        <div class="mt-6">
            @foreach($interviews as $i)
                <div class="border p-3 mb-2 rounded">
                    <p><b>Question:</b> {{ $i->question }}</p>
                    <p><b>Score:</b> {{ $i->score }}/100</p>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>