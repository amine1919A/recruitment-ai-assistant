<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">📄 Analyse CV AI</h2>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- UPLOAD FORM -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">📤 Uploader un nouveau CV</h3>
            
            <form method="POST" action="{{ route('cv.upload') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Sélectionnez votre CV (PDF uniquement)
                    </label>
                    <input type="file"
                           name="cv"
                           accept=".pdf"
                           class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('cv')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-8 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition font-bold">
                    🤖 Analyser avec l'IA
                </button>
            </form>
        </div>

        <!-- LISTE DES CV ANALYSÉS -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">📋 Mes CV Analysés</h3>
            
            @forelse($cvs as $cv)
                <div class="border-b border-gray-200 py-4 last:border-0">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span class="text-2xl mr-3">📄</span>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ basename($cv->file_path) }}</h4>
                                    <p class="text-xs text-gray-500">Analysé {{ $cv->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            <!-- APERÇU DE L'ANALYSE -->
                            <div class="bg-gray-50 rounded-lg p-3 mt-2">
                                <p class="text-sm text-gray-700 line-clamp-3">
                                    {{ Str::limit(strip_tags($cv->analysis), 200) }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex gap-2 ml-4">
                            <a href="{{ route('cv.show', $cv->id) }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition text-sm font-semibold">
                                👁️ Voir
                            </a>
                            <form method="POST" action="{{ route('cv.destroy', $cv->id) }}" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette analyse ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm font-semibold">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">
                    Aucun CV analysé pour le moment. 
                    <span class="font-semibold">Uploadez votre premier CV ci-dessus !</span>
                </p>
            @endforelse
        </div>

    </div>
</x-app-layout>