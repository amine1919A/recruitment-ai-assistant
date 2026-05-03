<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full gradient-bg flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                            AI
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Analyse de votre CV</h1>
                            <p class="text-gray-600">{{ basename($cv->file_path) }}</p>
                        </div>
                    </div>
                    <a href="{{ route('cv.index') }}" class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour
                    </a>
                </div>
            </div>

            <!-- Analysis Content -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-blue-500">
                <div class="prose max-w-none">
                    <div class="bg-gray-50 p-6 rounded-lg border text-gray-800 leading-relaxed whitespace-pre-wrap">
                        {!! nl2br(e($analysis)) !!}
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <p class="text-gray-700 font-medium">
                        <svg class="w-5 h-5 inline mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Analysé le {{ $cv->created_at->format('d/m/Y à H:i') }}
                    </p>
                    <div class="flex gap-3">
                        <button onclick="copyToClipboard()" 
                                class="bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Copier
                        </button>
                        <a href="/interview/start?cv_id={{ $cv->id }}" 
                           class="btn-primary text-white px-6 py-3 rounded-xl transition font-semibold flex items-center gap-2 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Interview
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function copyToClipboard() {
            const text = document.querySelector('.whitespace-pre-wrap').innerText;
            navigator.clipboard.writeText(text).then(() => {
                // Show success message
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