<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">🔍 Job Matching AI</h2>
        </div>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORMULAIRE DE MATCHING -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">📝 Analyser la compatibilité</h3>
            
            <form method="POST" action="{{ route('match.analyze') }}">
                @csrf

                <!-- SÉLECTION CV -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        📄 Sélectionnez votre CV
                    </label>
                    <select name="cv_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">-- Choisir un CV --</option>
                        @foreach($cvs as $cv)
                            <option value="{{ $cv->id }}">
                                {{ basename($cv->file_path) }} ({{ $cv->created_at->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('cv_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- JOB DESCRIPTION -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        💼 Description du poste
                    </label>
                    <textarea 
                        name="job_description" 
                        rows="12" 
                        required 
                        placeholder="Collez ici la description complète du poste (minimum 50 caractères)..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    ></textarea>
                    @error('job_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-8 py-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition font-bold text-lg">
                    🔍 Analyser la Compatibilité
                </button>
            </form>
        </div>

        <!-- HISTORIQUE DES MATCHS -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">📋 Historique des Analyses</h3>
            
            @forelse($matches as $match)
                <div class="border-b border-gray-200 py-4 last:border-0">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">CV: {{ basename($match->cv->file_path) }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($match->job_description, 100) }}</p>
                            <p class="text-xs text-gray-500 mt-2">Analysé {{ $match->created_at->diffForHumans() }}</p>
                        </div>
                        <a href="{{ route('match.index') }}#match-{{ $match->id }}" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition text-sm ml-4">
                            👁️ Voir
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">
                    Aucune analyse effectuée. 
                    @if($cvs->isEmpty())
                        <a href="/cv" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Uploadez d'abord un CV
                        </a>
                    @endif
                </p>
            @endforelse
        </div>

        @if($cvs->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-6">
                <p class="text-yellow-800 font-semibold mb-2">⚠️ Aucun CV disponible</p>
                <p class="text-yellow-700">
                    Vous devez d'abord analyser un CV. 
                    <a href="/cv" class="text-purple-600 hover:text-purple-800 font-bold underline">
                        Analysez un CV maintenant
                    </a>
                </p>
            </div>
        @endif

    </div>
</x-app-layout>