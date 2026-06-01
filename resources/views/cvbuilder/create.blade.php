<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 py-12">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- HEADER -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-10 border border-gray-100">
                <h1 class="text-3xl font-bold text-gray-900">✨ Créer CV Optimisé</h1>
                <p class="text-gray-600 mt-2">
                    L’IA adapte votre CV pour maximiser vos chances
                </p>
            </div>

            <!-- FORM CARD -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                <form action="/cvbuilder/generate" method="POST">
                    @csrf

                    <!-- CV SOURCE -->
                    <div class="mb-6">
                        <label class="flex items-center gap-2 font-semibold text-gray-800 mb-2">
                            📄 CV source
                        </label>

                        <select name="cv_id"
                                class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition">

                            <option value="">Choisir un CV</option>

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
                    <div class="mb-8">
                        <label class="flex items-center gap-2 font-semibold text-gray-800 mb-2">
                            💼 Description poste
                        </label>

                        <textarea name="job_description"
                                  rows="10"
                                  class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-100 focus:border-orange-500 transition text-gray-800"
                                  placeholder="Collez la description du poste..."></textarea>

                        @error('job_description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-4 rounded-xl font-bold shadow-lg hover:shadow-2xl hover:-translate-y-1 transition flex items-center justify-center gap-2">

                        ✨ Générer CV Optimisé
                    </button>

                </form>

            </div>

        </div>

    </div>
</x-app-layout>