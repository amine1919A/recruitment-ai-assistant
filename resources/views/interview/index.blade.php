<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            
            <!-- Header Section -->
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">🎤 Interview AI</h1>
                        <p class="text-gray-600 text-lg">Entraînez-vous avec notre système d'interview intelligent</p>
                    </div>
                    @if($cvs->count() > 0)
                        <a href="/interview/start" class="btn-primary text-white px-8 py-4 rounded-xl font-semibold shadow-lg flex items-center gap-3 hover:shadow-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Démarrer Interview</span>
                        </a>
                    @endif
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg shadow-sm mb-6 animate-pulse">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium mb-1">Total Interviews</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalInterviews }}</p>
                            </div>
                            <div class="bg-blue-100 rounded-full p-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium mb-1">Score Moyen</p>
                                <p class="text-3xl font-bold text-gray-900">{{ number_format($avgScore, 1) }}<span class="text-lg text-gray-500">/10</span></p>
                            </div>
                            <div class="bg-green-100 rounded-full p-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm font-medium mb-1">Meilleur Score</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $bestScore }}<span class="text-lg text-gray-500">/10</span></p>
                            </div>
                            <div class="bg-yellow-100 rounded-full p-4">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interviews List -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Historique des Interviews
                </h2>
                
                @forelse($interviews as $interview)
                    <div class="border-b border-gray-100 py-6 last:border-0 message-bubble">
                        <div class="flex gap-4">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                    AI
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-lg mb-2">{{ $interview->question }}</p>
                                        <div class="flex items-center gap-3 text-sm text-gray-500 mb-3">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $interview->created_at->diffForHumans() }}
                                            </span>
                                            @if($interview->cv)
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    {{ basename($interview->cv->file_path) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex-shrink-0 ml-4">
                                        <div class="px-4 py-2 rounded-full font-bold text-sm shadow-sm
                                            {{ $interview->score >= 7 ? 'bg-green-100 text-green-800' : ($interview->score >= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $interview->score }}/10
                                        </div>
                                    </div>
                                </div>

                                <!-- Your Answer -->
                                <div class="bg-blue-50 rounded-xl p-4 mb-3 border border-blue-100">
                                    <p class="text-sm font-semibold text-blue-900 mb-1">Votre réponse :</p>
                                    <p class="text-gray-700">{{ $interview->answer }}</p>
                                </div>

                                <!-- Feedback -->
                                @if($interview->feedback)
                                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                        <p class="text-sm font-semibold text-gray-900 mb-2 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                            </svg>
                                            Feedback de l'IA
                                        </p>
                                        <div class="text-sm text-gray-700 whitespace-pre-line">{{ $interview->feedback }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg mb-6">Aucun entretien réalisé pour le moment</p>
                        @if($cvs->count() > 0)
                            <a href="/interview/start" class="inline-flex items-center gap-2 btn-primary text-white px-8 py-3 rounded-xl font-semibold shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                </svg>
                                Démarrer ma première interview
                            </a>
                        @else
                            <a href="/cv" class="inline-flex items-center gap-2 bg-blue-600 text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                Uploader un CV d'abord
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            @if($cvs->isEmpty())
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg shadow-sm mt-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="text-yellow-800 font-semibold">Aucun CV disponible</p>
                            <p class="text-yellow-700 mt-1">
                                Vous devez d'abord analyser un CV pour démarrer une interview. 
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