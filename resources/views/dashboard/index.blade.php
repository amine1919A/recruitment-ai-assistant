<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Header Section -->
            <div class="mb-12">
                 <center><h1  class="text-4xl font-bold text-gray-900 mb-2">Dashboard Recrutement AI</h1></center>
                <center><p class="text-gray-600 text-lg">Gérez votre parcours professionnel avec l'intelligence artificielle</p></center>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-12">
                <a href="/cv" class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100 text-center group">
                    <div class="bg-blue-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 group-hover:scale-110 transition">
                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">Analyser CV</p>
                </a>

                <a href="/interview" class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100 text-center group">
                    <div class="bg-green-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 group-hover:scale-110 transition">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">Interview AI</p>
                </a>

                <a href="/match" class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100 text-center group">
                    <div class="bg-purple-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 group-hover:scale-110 transition">
                        <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">Job Match</p>
                </a>

                <a href="/cvbuilder" class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100 text-center group">
                    <div class="bg-orange-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 group-hover:scale-110 transition">
                        <svg class="w-12 h-12 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">CV Builder</p>
                </a>

                <a href="/admin" class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100 text-center group">
                    <div class="bg-gray-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 group-hover:scale-110 transition">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <p class="font-semibold text-gray-900">Admin</p>
                </a>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">CV Analysés</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $cvs->count() }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Entretiens</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $interviews->count() }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Job Matches</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $matches->count() }}</p>
                        </div>
                        <div class="bg-purple-100 rounded-full p-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 card-hover border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">CV Optimisés</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $optimizedCVs->count() }}</p>
                        </div>
                        <div class="bg-orange-100 rounded-full p-4">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performance Chart -->
            <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100 mb-12">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Performance Moyenne
                </h3>
                <div class="flex items-center">
                    <div class="flex-grow">
                        <div class="w-full bg-gray-200 h-8 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-r from-green-400 to-green-600 h-8 rounded-full flex items-center justify-end pr-4"
                                 style="width: {{ $avgScore ?? 0 }}%">
                                <span class="text-white text-sm font-bold">{{ round($avgScore ?? 0, 1) }}%</span>
                            </div>
                        </div>
                    </div>
                    <span class="ml-6 text-3xl font-bold text-gray-900">{{ round($avgScore ?? 0, 1) }}/10</span>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- CV List -->
                <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Derniers CV
                    </h3>
                    
                    @forelse($cvs->take(5) as $cv)
                        <div class="border-b border-gray-100 py-4 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ basename($cv->file_path) }}</p>
                                    <p class="text-sm text-gray-500">{{ $cv->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Aucun CV analysé</p>
                    @endforelse

                    @if($cvs->count() > 5)
                        <a href="/cv" class="block text-center text-blue-600 hover:text-blue-800 font-semibold mt-6">
                            Voir tous les CV →
                        </a>
                    @endif
                </div>

                <!-- Interviews List -->
                <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Derniers Entretiens
                    </h3>
                    
                    @forelse($interviews->take(5) as $i)
                        <div class="border-b border-gray-100 py-4 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900 line-clamp-1">{{ Str::limit($i->question, 50) }}</p>
                                    <p class="text-sm text-gray-500">{{ $i->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-bold
                                    {{ $i->score >= 7 ? 'bg-green-100 text-green-800' : ($i->score >= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $i->score }}/10
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">Aucun entretien</p>
                    @endforelse

                    @if($interviews->count() > 5)
                        <a href="/interview" class="block text-center text-green-600 hover:text-green-800 font-semibold mt-6">
                            Voir tous les entretiens →
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>