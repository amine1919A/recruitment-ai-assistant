<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <h2 class="text-3xl font-bold text-gray-800 mb-8">✏️ Modifier le CV Optimisé</h2>

        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="/cvbuilder/{{ $optimizedCV->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Contenu du CV
                    </label>
                    <textarea 
                        name="optimized_content" 
                        rows="25" 
                        required 
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-transparent font-mono text-sm"
                    >{{ old('optimized_content', $optimizedCV->optimized_content) }}</textarea>
                    @error('optimized_content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition font-bold">
                        💾 Sauvegarder
                    </button>
                    <a href="/cvbuilder" class="px-8 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition font-semibold text-gray-700">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>