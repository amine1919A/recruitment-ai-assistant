<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Header Section - Centré et élégant -->
            <div class="mb-16">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 text-white mb-6 shadow-lg">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">Job Matching AI</h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        Analysez la compatibilité entre votre CV et une offre d'emploi grâce à notre intelligence artificielle
                    </p>
                </div>

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg shadow-sm mb-8 max-w-2xl mx-auto">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-800 font-semibold">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg shadow-sm mb-8 max-w-2xl mx-auto animate-pulse">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Analysis Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 mb-12 max-w-3xl mx-auto">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center justify-center gap-3">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Analyser la compatibilité
                </h3>
                
                <form method="POST" action="{{ route('match.analyze') }}">
                    @csrf

                    <!-- CV Selection -->
                    <div class="mb-8">
                        <label class="block text-gray-900 font-bold text-lg mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Sélectionnez votre CV
                        </label>
                        <select name="cv_id" required class="w-full border-2 border-gray-200 rounded-xl px-6 py-4 focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-gray-900">
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
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4m0 0L4 16m0 0l12-6" />
                            </svg>
                            Description du poste
                        </label>
                        <textarea 
                            name="job_description" 
                            rows="12" 
                            required 
                            minlength="50"
                            placeholder="Collez ici la description complète du poste (minimum 50 caractères)..."
                            class="w-full border-2 border-gray-200 rounded-xl px-6 py-4 focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-gray-900 text-lg leading-relaxed"
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

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white px-10 py-4 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition font-bold text-lg flex items-center justify-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Analyser la Compatibilité
                    </button>
                </form>
            </div>

            <!-- History Section -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Historique des Analyses
                </h3>
                
                @forelse($matches as $match)
                    <div class="border-b border-gray-100 py-6 last:border-0 message-bubble">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    AI
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-lg mb-2">CV: {{ basename($match->cv->file_path) }}</h4>
                                        <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $match->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-purple-50 rounded-xl p-4 mb-3 border border-purple-100">
                                    <p class="text-sm font-semibold text-purple-900 mb-1">Description du poste :</p>
                                    <p class="text-sm text-gray-700 line-clamp-2">
                                        {{ Str::limit($match->job_description, 200) }}
                                    </p>
                                </div>

                                <a href="{{ route('match.show', $match->id) }}" class="inline-flex items-center gap-2 bg-purple-500 text-white px-6 py-2 rounded-lg hover:bg-purple-600 transition text-sm font-semibold shadow-md hover:shadow-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Voir l'analyse
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg mb-2">Aucune analyse effectuée pour le moment</p>
                        <p class="text-gray-600">
                            @if($cvs->isEmpty())
                                <a href="/cv" class="text-blue-600 hover:text-blue-800 font-semibold">
                                    Uploadez d'abord un CV
                                </a>
                            @else
                                Complétez le formulaire ci-dessus pour commencer
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>

            @if($cvs->isEmpty())
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg shadow-sm mt-8 max-w-3xl mx-auto">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="text-yellow-800 font-semibold">Aucun CV disponible</p>
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