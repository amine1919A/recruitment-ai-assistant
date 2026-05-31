<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50 to-white py-10">

<div class="max-w-7xl mx-auto px-4">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">✨ CV Builder AI</h1>
            <p class="text-gray-500">Gérez et optimisez vos CV intelligemment</p>
        </div>

        <a href="/cvbuilder/create"
           class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl shadow-lg transition">
            + Créer CV
        </a>
    </div>

    <!-- CV OPTIMISÉS -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6 border border-gray-100">
        <h2 class="font-bold text-gray-800 mb-4">📋 CV Optimisés</h2>

        @forelse($optimizedCVs as $opt)
            <div class="flex justify-between items-center py-3 border-b last:border-0">
                <div>
                    <p class="font-semibold text-gray-800">
                        {{ basename($opt->cv->file_path) }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $opt->created_at->diffForHumans() }}
                    </p>
                </div>

                <a href="/cvbuilder/{{ $opt->id }}/edit"
                   class="text-blue-600 hover:underline text-sm">
                    Modifier
                </a>
            </div>
        @empty
            <p class="text-gray-400 text-center py-6">Aucun CV optimisé</p>
        @endforelse
    </div>

    <!-- CV SOURCES -->
    <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
        <h2 class="font-bold text-gray-800 mb-4">📄 CV Sources</h2>

        @forelse($cvs as $cv)
            <div class="flex items-center justify-between py-3 border-b last:border-0">
                <div>
                    <p class="text-gray-800 font-medium">
                        {{ basename($cv->file_path) }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $cv->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-center py-6">Aucun CV source</p>
        @endforelse
    </div>

</div>
</div>
</x-app-layout>