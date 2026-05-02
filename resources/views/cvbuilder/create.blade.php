<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <h2 class="text-3xl font-bold text-gray-800 mb-2">✨ Créer un CV Optimisé</h2>
        <p class="text-gray-600 mb-8">Notre IA va adapter votre CV pour matcher parfaitement avec l'offre d'emploi</p>

        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="/cvbuilder/generate" method="POST">
                @csrf

                <!-- SÉLECTION CV -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        📄 Sélectionnez votre CV source
                    </label>
                    <select name="cv_id" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
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
                        💼 Description du poste cible
                    </label>
                    <textarea 
                        name="job_description" 
                        rows="12" 
                        required 
                        placeholder="Collez ici la description complète du poste (minimum 50 caractères)..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                    ></textarea>
                    @error('job_description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SUBMIT -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition font-bold text-lg">
                        ✨ Générer CV Optimisé
                    </button>
                    <a href="/cvbuilder" class="px-6 py-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition font-semibold text-gray-700">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

        @if($cvs->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-6">
                <p class="text-yellow-800 font-semibold mb-2">⚠️ Aucun CV source disponible</p>
                <p class="text-yellow-700">
                    Vous devez d'abord analyser un CV. 
                    <a href="/cv" class="text-orange-600 hover:text-orange-800 font-bold underline">
                        Analysez un CV maintenant
                    </a>
                </p>
            </div>
        @endif

    </div>
</x-app-layout>