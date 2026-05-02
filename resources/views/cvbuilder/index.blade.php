<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">✨ CV Builder AI</h2>
            <a href="/cvbuilder/create" class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition font-semibold">
                + Créer CV Optimisé
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- CV OPTIMISÉS -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">📋 Mes CV Optimisés</h3>
            
            @forelse($optimizedCVs as $opt)
                <div class="border-b border-gray-200 py-4 last:border-0">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800">CV basé sur: {{ basename($opt->cv->file_path) }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($opt->job_description, 100) }}</p>
                            <p class="text-xs text-gray-500 mt-2">Créé {{ $opt->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <a href="/cvbuilder/{{ $opt->id }}/edit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition text-sm">
                                ✏️ Modifier
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">
                    Aucun CV optimisé créé. 
                    <a href="/cvbuilder/create" class="text-orange-600 hover:text-orange-800 font-semibold">
                        Créez-en un maintenant !
                    </a>
                </p>
            @endforelse
        </div>

        <!-- MES CV SOURCES -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">📄 Mes CV Sources</h3>
            
            @forelse($cvs as $cv)
                <div class="border-b border-gray-200 py-3 last:border-0">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-2xl mr-3">📄</span>
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ basename($cv->file_path) }}</p>
                                <p class="text-xs text-gray-500">Analysé {{ $cv->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">
                    Aucun CV source. 
                    <a href="/cv" class="text-blue-600 hover:text-blue-800 font-semibold">
                        Uploadez un CV d'abord
                    </a>
                </p>
            @endforelse
        </div>

    </div>
</x-app-layout>