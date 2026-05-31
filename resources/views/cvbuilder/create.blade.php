<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-slate-50 py-10">

<div class="max-w-4xl mx-auto px-4">

    <h1 class="text-3xl font-bold text-gray-900 mb-2">✨ Créer CV Optimisé</h1>
    <p class="text-gray-500 mb-8">L’IA adapte votre CV pour maximiser vos chances</p>

    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">

        <form action="/cvbuilder/generate" method="POST">
            @csrf

            <div class="mb-6">
                <label class="font-semibold text-gray-700">📄 CV source</label>
                <select name="cv_id" class="w-full mt-2 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-400">
                    <option value="">Choisir un CV</option>
                    @foreach($cvs as $cv)
                        <option value="{{ $cv->id }}">
                            {{ basename($cv->file_path) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="font-semibold text-gray-700">💼 Description poste</label>
                <textarea name="job_description"
                          rows="10"
                          class="w-full mt-2 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-400"
                          placeholder="Collez la description du poste..."></textarea>
            </div>

            <button class="w-full bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-xl font-bold shadow-lg transition">
                ✨ Générer CV Optimisé
            </button>

        </form>

    </div>

</div>
</div>
</x-app-layout>