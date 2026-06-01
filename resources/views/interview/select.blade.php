<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- HEADER -->
            <div class="bg-white/80 backdrop-blur-xl border border-gray-100 rounded-3xl shadow-xl p-6 mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">🎤 Démarrer une Interview</h2>
                <p class="text-gray-600">
                    Sélectionnez le CV sur lequel vous souhaitez être interrogé
                </p>
            </div>

            <!-- CARD LIST -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">

                @forelse($cvs as $cv)

                    <a href="/interview/start?cv_id={{ $cv->id }}"
                       class="group block mb-5 last:mb-0">

                        <div class="flex items-center justify-between p-6 rounded-2xl border border-gray-200
                                    hover:border-purple-400 hover:shadow-lg hover:-translate-y-1 transition-all duration-300
                                    bg-white group-hover:bg-gradient-to-r group-hover:from-indigo-50 group-hover:to-purple-50">

                            <div class="flex items-center gap-4">

                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600
                                            flex items-center justify-center text-white text-2xl shadow-lg">
                                    📄
                                </div>

                                <div>
                                    <p class="font-bold text-gray-900">
                                        {{ basename($cv->file_path) }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Analysé {{ $cv->created_at->diffForHumans() }}
                                    </p>
                                </div>

                            </div>

                            <div class="text-sm font-bold text-purple-600 group-hover:text-purple-700">
                                Sélectionner →
                            </div>

                        </div>

                    </a>

                @empty

                    <div class="text-center py-12">

                        <div class="text-6xl mb-4">📄</div>

                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                            Aucun CV disponible
                        </h3>

                        <p class="text-gray-500 mb-6">
                            Vous devez analyser un CV avant de commencer une interview.
                        </p>

                        <a href="/cv"
                           class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600
                                  text-white font-bold shadow-lg hover:shadow-xl transition">
                            Analyser un CV
                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>
</x-app-layout>