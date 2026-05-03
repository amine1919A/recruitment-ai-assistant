<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Header Section -->
            <div class="mb-12">
                <center><h1 class="text-4xl font-bold text-gray-900 mb-2">Analyse CV AI  </h1></center>
                <center><p class="text-gray-600 text-lg">Obtenez une analyse professionnelle de votre CV en quelques secondes</p></center>
            </div>

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg shadow-sm mb-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-red-800 font-semibold">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg shadow-sm mb-8 animate-pulse">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Upload Form -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    Uploader un nouveau CV
                </h3>
                
                <form method="POST" action="{{ route('cv.upload') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3">
                            Sélectionnez votre CV (PDF uniquement)
                        </label>
                        <input type="file"
                               name="cv"
                               accept=".pdf"
                               class="w-full border-2 border-gray-200 rounded-xl px-6 py-4 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition"
                               required>
                        @error('cv')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror>
                    </div>

                    <button type="submit"
                            class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-10 py-4 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition font-bold text-lg flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Analyser avec l'IA
                    </button>
                </form>
            </div>

            <!-- CV List -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Mes CV Analysés
                </h3>
                
                @forelse($cvs as $cv)
                    <div class="border-b border-gray-100 py-6 last:border-0 message-bubble">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 text-lg mb-2">{{ basename($cv->file_path) }}</h4>
                                        <p class="text-sm text-gray-500 mb-3">Analysé {{ $cv->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <div class="bg-blue-50 rounded-xl p-4 mb-3 border border-blue-100">
                                    <p class="text-sm text-gray-700 line-clamp-3">
                                        {{ Str::limit(strip_tags($cv->analysis), 200) }}
                                    </p>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('cv.show', $cv->id) }}" 
                                       class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition text-sm font-semibold flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Voir
                                    </a>
                                    <form method="POST" action="{{ route('cv.destroy', $cv->id) }}" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette analyse ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition text-sm font-semibold flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg mb-2">Aucun CV analysé pour le moment</p>
                        <p class="text-gray-600">Uploadez votre premier CV ci-dessus pour commencer !</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>