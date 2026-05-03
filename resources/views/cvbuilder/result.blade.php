<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
 
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                            ✨
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Votre CV Optimisé</h1>
                            <p class="text-gray-600">Généré il y a quelques instants</p>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <a href="/cvbuilder/{{ $optimizedCV->id }}/edit" class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Modifier
                        </a>
                        <a href="/cvbuilder" class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Retour
                        </a>
                    </div>
                </div>
            </div>
 
            <!-- CV Content -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-orange-500">
                <div class="prose max-w-none">
                    <div class="bg-gray-50 p-6 rounded-lg border text-gray-800 leading-relaxed whitespace-pre-wrap">
                        {!! nl2br(e($optimizedContent)) !!}
                    </div>
                </div>
            </div>
 
            <!-- Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <p class="text-gray-700 font-medium">
                        <svg class="w-5 h-5 inline mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Conseil : Relisez et personnalisez ce CV avant de l'envoyer
                    </p>
                    <button onclick="copyToClipboard()" 
                            class="bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        Copier le texte
                    </button>
                </div>
            </div>
 
        </div>
    </div>
 
    <script>
        function copyToClipboard() {
            const text = document.querySelector('.whitespace-pre-wrap').innerText;
            navigator.clipboard.writeText(text).then(() => {
                const btn = event.target.closest('button');
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Copié !';
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            });
        }
    </script>
</x-app-layout>