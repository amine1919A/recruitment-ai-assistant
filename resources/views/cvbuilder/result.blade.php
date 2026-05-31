<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50 to-white py-10">

<div class="max-w-5xl mx-auto px-4">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">✨ CV Optimisé</h1>
            <p class="text-gray-500">Résultat généré par l’IA</p>
        </div>

        <div class="flex gap-3">
            <a href="/cvbuilder/{{ $optimizedCV->id }}/edit"
               class="bg-blue-500 text-white px-5 py-2 rounded-xl">
                Modifier
            </a>

            <a href="/cvbuilder"
               class="bg-gray-500 text-white px-5 py-2 rounded-xl">
                Retour
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100">
        <div class="whitespace-pre-wrap text-gray-800 leading-relaxed">
            {!! nl2br(e($optimizedContent)) !!}
        </div>
    </div>

    <div class="mt-6 bg-white rounded-2xl p-6 shadow-md flex justify-between items-center">

        <p class="text-gray-600">
            Conseil: personnalisez avant envoi
        </p>

        <button onclick="copyText()"
                class="bg-green-500 text-white px-5 py-2 rounded-xl">
            Copier
        </button>

    </div>

</div>

</div>

<script>
function copyText() {
    navigator.clipboard.writeText(document.querySelector('.whitespace-pre-wrap').innerText);
    alert('Copié !');
}
</script>

</x-app-layout>