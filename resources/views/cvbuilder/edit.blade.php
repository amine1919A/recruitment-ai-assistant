<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-12">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HEADER -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-10 border border-gray-100">
                <h1 class="text-3xl font-bold text-gray-900">✏️ Modifier CV Optimisé</h1>
                <p class="text-gray-600 mt-2">
                    Personnalisez et améliorez votre CV généré par l’IA
                </p>
            </div>

            <!-- FORM CARD -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                <form action="/cvbuilder/{{ $optimizedCV->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- TEXTAREA -->
                    <div class="mb-6">
                        <label class="flex items-center gap-2 font-semibold text-gray-800 mb-3">
                            📝 Contenu du CV optimisé
                        </label>

                        <textarea name="optimized_content"
                                  rows="25"
                                  class="w-full border-2 border-gray-200 rounded-xl px-4 py-4 font-mono text-sm text-gray-800 focus:ring-4 focus:ring-green-100 focus:border-green-500 transition leading-relaxed">{{ $optimizedCV->optimized_content }}</textarea>

                        @error('optimized_content')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex flex-col md:flex-row gap-4">

                        <button type="submit"
                                class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-2xl hover:-translate-y-1 transition flex items-center justify-center gap-2">
                            💾 Sauvegarder
                        </button>

                        <a href="/cvbuilder"
                           class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-semibold transition">
                            Annuler
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>