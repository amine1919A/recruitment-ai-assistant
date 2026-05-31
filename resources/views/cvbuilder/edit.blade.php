<x-app-layout>
<div class="min-h-screen bg-slate-50 py-10">

<div class="max-w-5xl mx-auto px-4">

    <h1 class="text-3xl font-bold mb-8 text-gray-900">✏️ Modifier CV Optimisé</h1>

    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">

        <form action="/cvbuilder/{{ $optimizedCV->id }}" method="POST">
            @csrf
            @method('PUT')

            <textarea name="optimized_content"
                      rows="25"
                      class="w-full border rounded-xl px-4 py-3 font-mono text-sm focus:ring-2 focus:ring-green-400">{{ $optimizedCV->optimized_content }}</textarea>

            <div class="flex gap-4 mt-6">

                <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl font-bold">
                    💾 Sauvegarder
                </button>

                <a href="/cvbuilder"
                   class="px-6 py-3 bg-gray-100 rounded-xl hover:bg-gray-200">
                    Annuler
                </a>

            </div>

        </form>

    </div>

</div>

</div>
</x-app-layout>