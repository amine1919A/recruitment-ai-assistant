<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800">
                    📄 Analyse CV avec IA
                </h1>
                <p class="text-gray-500 mt-2">
                    Téléchargez votre CV et recevez une analyse détaillée générée par l'intelligence artificielle.
                </p>
            </div>

            <!-- Alerts -->
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl shadow-sm mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl shadow-sm mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Upload Section -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-10">

                <div class="flex items-center mb-6">
                    <div class="text-5xl mr-4">🤖</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">
                            Télécharger un nouveau CV
                        </h2>
                        <p class="text-gray-500">
                            Formats acceptés : PDF uniquement
                        </p>
                    </div>
                </div>

                <form method="POST"
                      action="{{ route('cv.upload') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="border-2 border-dashed border-blue-300 rounded-2xl p-8 text-center bg-blue-50">

                        <div class="text-6xl mb-4">📤</div>

                        <label class="block text-lg font-semibold text-gray-700 mb-4">
                            Sélectionnez votre CV
                        </label>

                        <input
                            type="file"
                            name="cv"
                            accept=".pdf"
                            required
                            class="block w-full text-gray-700 border border-gray-300 rounded-xl px-4 py-3 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >

                        @error('cv')
                            <p class="text-red-500 mt-3">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="w-full md:w-auto bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                            🚀 Analyser avec l'IA
                        </button>
                    </div>

                </form>

            </div>

            <!-- CV List -->
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        📋 Mes CV Analysés
                    </h2>

                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full font-semibold">
                        {{ $cvs->count() }} CV
                    </span>
                </div>

                @forelse($cvs as $cv)

                    <div class="border border-gray-200 rounded-2xl p-5 mb-5 hover:shadow-lg transition">

                        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-start">

                            <div class="flex-1">

                                <div class="flex items-center mb-4">
                                    <div class="text-4xl mr-4">📄</div>

                                    <div>
                                        <h3 class="font-bold text-gray-800 text-lg">
                                            {{ basename($cv->file_path) }}
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            Analysé {{ $cv->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-4">
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ Str::limit(strip_tags($cv->analysis), 250) }}
                                    </p>
                                </div>

                            </div>

                            <div class="flex gap-3 mt-5 lg:mt-0 lg:ml-6">

                                <a href="{{ route('cv.show', $cv->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold transition">
                                    👁️ Voir
                                </a>

                                <form method="POST"
                                      action="{{ route('cv.destroy', $cv->id) }}"
                                      onsubmit="return confirm('Supprimer cette analyse ?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl font-semibold transition">
                                        🗑️
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="text-center py-12">

                        <div class="text-7xl mb-4">📄</div>

                        <h3 class="text-xl font-bold text-gray-700 mb-2">
                            Aucun CV analysé
                        </h3>

                        <p class="text-gray-500">
                            Téléchargez votre premier CV pour commencer.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>