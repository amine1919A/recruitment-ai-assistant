<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- HEADER -->
            <div class="bg-white/80 backdrop-blur-xl border border-gray-100 rounded-3xl shadow-xl p-6 mb-10">
                <div class="flex items-center justify-between flex-wrap gap-4">

                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">🔍 Job Matching AI</h2>
                        <p class="text-gray-600 mt-1">
                            Analyse intelligente de compatibilité entre CV et poste
                        </p>
                    </div>

                </div>
            </div>

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- FORM -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-10">

                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    📝 Nouvelle analyse
                </h3>

                <form method="POST" action="{{ route('match.analyze') }}">
                    @csrf

                    <!-- CV SELECT -->
                    <div class="mb-6">
                        <label class="block text-gray-800 font-semibold mb-2">
                            📄 CV
                        </label>

                        <select name="cv_id" required
                                class="w-full rounded-2xl border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 px-4 py-3">

                            <option value="">-- Choisir un CV --</option>

                            @foreach($cvs as $cv)
                                <option value="{{ $cv->id }}">
                                    {{ basename($cv->file_path) }}
                                </option>
                            @endforeach

                        </select>

                        @error('cv_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- JOB DESCRIPTION -->
                    <div class="mb-6">
                        <label class="block text-gray-800 font-semibold mb-2">
                            💼 Description du poste
                        </label>

                        <textarea name="job_description" rows="10" required
                                  class="w-full rounded-2xl border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 px-4 py-3"
                                  placeholder="Collez ici la description du poste..."></textarea>

                        @error('job_description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full md:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold shadow-lg hover:shadow-xl transition">
                        🔍 Analyser la compatibilité
                    </button>

                </form>
            </div>

            <!-- HISTORY -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">

                <h3 class="text-xl font-bold text-gray-900 mb-6">
                    📋 Historique
                </h3>

                @forelse($matches as $match)

                    <div class="p-5 mb-5 rounded-2xl border border-gray-200 hover:shadow-lg transition">

                        <div class="flex justify-between items-start gap-4">

                            <div class="flex-1">

                                <p class="font-bold text-gray-900">
                                    📄 {{ basename($match->cv->file_path) }}
                                </p>

                                <p class="text-sm text-gray-600 mt-2">
                                    {{ \Illuminate\Support\Str::limit($match->job_description, 120) }}
                                </p>

                                <p class="text-xs text-gray-400 mt-2">
                                    {{ $match->created_at->diffForHumans() }}
                                </p>

                            </div>

                            <a href="{{ route('match.index') }}#match-{{ $match->id }}"
                               class="px-4 py-2 rounded-xl bg-purple-100 text-purple-700 font-semibold hover:bg-purple-200 transition">
                                Voir
                            </a>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-12">

                        <div class="text-6xl mb-4">🔍</div>

                        <p class="text-gray-600 font-semibold">
                            Aucun matching effectué
                        </p>

                        @if($cvs->isEmpty())
                            <a href="/cv"
                               class="inline-flex mt-4 px-6 py-3 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold shadow-lg">
                                Uploader un CV
                            </a>
                        @endif

                    </div>

                @endforelse

            </div>

            @if($cvs->isEmpty())
                <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-3xl p-6">
                    <p class="font-bold text-yellow-800">⚠️ Aucun CV disponible</p>
                    <p class="text-yellow-700 mt-1">
                        <a href="/cv" class="font-bold underline">Analysez un CV maintenant</a>
                    </p>
                </div>
            @endif

        </div>

    </div>
</x-app-layout>