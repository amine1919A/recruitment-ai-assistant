<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">✨ Créer un CV Optimisé</h1>
                    <p class="text-gray-600 text-lg">Adaptez votre CV pour matcher l'offre d'emploi parfaitement</p>
                </div>
                <a href="/cvbuilder" class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <form action="{{ route('cvbuilder.generate') }}" method="POST">
                    @csrf

                    <!-- CV Selection -->
                    <div class="mb-8">
                        <label class="block text-gray-900 font-bold text-lg mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Sélectionnez votre CV source
                        </label>
                        <select name="cv_id" required class="w-full border-2 border-gray-200 rounded-xl px-6 py-4 focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition">
                            <option value="">-- Choisir un CV --</option>
                            @foreach($cvs as $cv)
                                <option value="{{ $cv->id }}">
                                    {{ basename($cv->file_path) }} ({{ $cv->created_at->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('cv_id')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Job Description -->
                    <div class="mb-8">
                        <label class="block text-gray-900 font-bold text-lg mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4m0 0L4 16m0 0l12-6" />
                            </svg>
                            Description du poste cible
                        </label>
                        <textarea 
                            name="job_description" 
                            rows="14" 
                            required 
                            minlength="50"
                            placeholder="Collez ici la description complète du poste (minimum 50 caractères)..."
                            class="w-full border-2 border-gray-200 rounded-xl px-6 py-4 focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition text-gray-900 text-lg leading-relaxed"
                        ></textarea>
                        @error('job_description')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-8 py-5 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition font-bold text-lg flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Générer CV Optimisé
                        </button>
                        <a href="/cvbuilder" class="px-8 py-5 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition font-semibold text-gray-700 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Annuler
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="bg-blue-50 rounded-2xl p-6 mt-8 border border-blue-100">
                <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Comment cela fonctionne
                </h3>
                <ul class="space-y-2 text-blue-800">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Notre IA analyse votre CV et l'offre d'emploi</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Elle optimise votre CV en incluant les mots-clés de l'offre</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Vous recevez un CV personnalisé prêt à envoyer</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Vous pouvez éditer et affiner le résultat avant d'envoyer</span>
                    </li>
                </ul>
            </div>

            @if($cvs->isEmpty())
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg shadow-sm mt-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="text-yellow-800 font-semibold">Aucun CV source disponible</p>
                            <p class="text-yellow-700 mt-1">
                                Vous devez d'abord analyser un CV. 
                                <a href="/cv" class="font-bold underline hover:text-yellow-900">
                                    Analysez un CV maintenant →
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>