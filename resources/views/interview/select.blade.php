<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <h2 class="text-3xl font-bold text-gray-800 mb-2">🎤 Démarrer une Interview</h2>
        <p class="text-gray-600 mb-8">Sélectionnez le CV sur lequel vous souhaitez être interrogé</p>

        <div class="bg-white rounded-lg shadow-md p-8">
            @forelse($cvs as $cv)
                <a href="/interview/start?cv_id={{ $cv->id }}" 
                   class="block border-2 border-gray-200 rounded-lg p-6 mb-4 hover:border-green-500 hover:bg-green-50 transition">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-4xl mr-4">📄</span>
                            <div>
                                <p class="font-bold text-gray-800">{{ basename($cv->file_path) }}</p>
                                <p class="text-sm text-gray-600">Analysé {{ $cv->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="text-green-600 font-semibold">Sélectionner →</span>
                    </div>
                </a>
            @empty
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">Aucun CV disponible</p>
                    <a href="/cv" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition font-semibold">
                        Analyser un CV
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>