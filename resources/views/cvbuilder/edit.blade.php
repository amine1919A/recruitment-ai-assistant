<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
 
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-bold text-gray-900">✏️ Modifier le CV</h1>
                    <a href="/cvbuilder" class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour
                    </a>
                </div>
            </div>
 
            <!-- Edit Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 mb-8">
                <form action="/cvbuilder/{{ $optimizedCV->id }}" method="POST">
                    @csrf
                    @method('PUT')
 
                    <div class="mb-8">
                        <label class="block text-gray-900 font-bold text-lg mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Contenu du CV
                        </label>
                        <textarea 
                            name="optimized_content" 
                            rows="25" 
                            required 
                            class="w-full border-2 border-gray-200 rounded-xl px-6 py-4 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition font-mono text-sm"
                        >{{ old('optimized_content', $optimizedCV->optimized_content) }}</textarea>
                        @error('optimized_content')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
 
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-5 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition font-bold text-lg flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            Sauvegarder
                        </button>
                        <a href="/cvbuilder" class="px-8 py-5 border-2 border-gray-200 rounded-xl hover:bg-gray-50 transition font-semibold text-gray-700 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
 
            <!-- Tips -->
            <div class="bg-green-50 rounded-2xl p-6 border border-green-100">
                <h3 class="font-bold text-green-900 mb-3 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    Conseils d'édition
                </h3>
                <ul class="space-y-2 text-green-800">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Vérifiez l'orthographe et la grammaire</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Adaptez les dates et les noms d'entreprises si nécessaire</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Maintenez la cohérence avec votre CV original</span>
                    </li>
                </ul>
            </div>
 
        </div>
    </div>
</x-app-layout>