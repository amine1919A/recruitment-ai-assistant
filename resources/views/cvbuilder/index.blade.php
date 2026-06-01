<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-12">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HEADER -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-10 border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">✨ CV Builder AI</h1>
                        <p class="text-gray-600 mt-1">Gérez et optimisez vos CV intelligemment</p>
                    </div>

                    <a href="/cvbuilder/create"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition font-semibold">
                        + Créer CV
                    </a>

                </div>
            </div>

            <!-- CV OPTIMISÉS -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8 border border-gray-100">

                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold shadow">
                        AI
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">CV Optimisés</h2>
                </div>

                <div class="divide-y divide-gray-100">

                    @forelse($optimizedCVs as $opt)

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between py-4 gap-3 hover:bg-gray-50 rounded-xl px-3 transition">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold">
                                    CV
                                </div>

                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ basename($opt->cv->file_path) }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $opt->created_at->diffForHumans() }}
                                    </p>
                                </div>

                            </div>

                            <a href="/cvbuilder/{{ $opt->id }}/edit"
                               class="inline-flex items-center justify-center px-5 py-2 rounded-xl bg-blue-500 text-white font-semibold hover:bg-blue-600 shadow hover:shadow-lg transition">
                                Modifier
                            </a>

                        </div>

                    @empty

                        <div class="text-center py-10 text-gray-400">
                            Aucun CV optimisé
                        </div>

                    @endforelse

                </div>

            </div>

            <!-- CV SOURCES -->
            <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">

                <div class="flex items-center gap-2 mb-5">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold shadow">
                        📄
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">CV Sources</h2>
                </div>

                <div class="divide-y divide-gray-100">

                    @forelse($cvs as $cv)

                        <div class="flex items-center justify-between py-4 px-3 hover:bg-gray-50 rounded-xl transition">

                            <div class="flex items-center gap-3">

                                <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-bold">
                                    PDF
                                </div>

                                <div>
                                    <p class="font-medium text-gray-900">
                                        {{ basename($cv->file_path) }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $cv->created_at->diffForHumans() }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-10 text-gray-400">
                            Aucun CV source
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>
</x-app-layout>