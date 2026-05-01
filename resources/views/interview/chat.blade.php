<x-app-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Simulation Entretien 🤖</h2>

        <p class="mb-4 bg-gray-100 p-3 rounded">
            {{ $question }}
        </p>

        <form method="POST" action="/interview/submit">
            @csrf

            <input type="hidden" name="question" value="{{ $question }}">

            <textarea name="answer"
                      class="w-full border p-2 mb-4"
                      placeholder="Votre réponse..."></textarea>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Envoyer réponse
            </button>

        </form>

    </div>
</x-app-layout>