<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <!-- HEADER -->
            <div class="bg-white/80 backdrop-blur-xl border border-gray-100 rounded-3xl shadow-xl p-6 mb-8">
                <div class="flex items-center justify-between flex-wrap gap-4">

                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                            AI
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Interview en direct</h1>
                            <p class="text-gray-600">CV: {{ basename($cv->file_path) }}</p>

                            @if(isset($questionNumber))
                                <p class="text-sm font-semibold text-purple-600">
                                    Question {{ $questionNumber }}/10
                                </p>
                            @endif
                        </div>
                    </div>

                    <a href="/interview"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Quitter
                    </a>

                </div>
            </div>

            <!-- PROGRESS -->
            @if(isset($questionNumber))
                <div class="mb-8">
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Progression</span>
                        <span class="font-semibold text-purple-600">{{ $questionNumber }}/10</span>
                    </div>

                    <div class="w-full h-3 bg-gray-200 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-600 transition-all duration-500"
                             style="width: {{ ($questionNumber / 10) * 100 }}%"></div>
                    </div>
                </div>
            @endif

            <!-- QUESTION -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 mb-8">
                <div class="flex gap-4">

                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white flex items-center justify-center font-bold shadow-lg">
                        AI
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-purple-600 mb-2">Recruteur IA</p>
                        <p class="text-gray-900 text-lg leading-relaxed font-medium">
                            {{ $question }}
                        </p>
                    </div>

                </div>
            </div>

            <!-- HISTORY -->
            @if(isset($history) && count($history) > 0)
                <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Historique</h3>

                    <div class="space-y-4">
                        @foreach($history as $index => $item)
                            <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100">
                                <div class="flex items-center justify-between mb-2">

                                    <span class="px-3 py-1 text-xs font-bold bg-gray-200 rounded-full">
                                        Q{{ $index + 1 }}
                                    </span>

                                    <span class="px-3 py-1 text-xs font-bold rounded-full
                                        {{ $item['score'] >= 7 ? 'bg-green-100 text-green-700' :
                                           ($item['score'] >= 5 ? 'bg-yellow-100 text-yellow-700' :
                                           'bg-red-100 text-red-700') }}">
                                        {{ $item['score'] }}/10
                                    </span>

                                </div>

                                <p class="text-sm text-gray-600">
                                    {{ $item['question'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- FORM -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">

                <form action="/interview/submit" method="POST" id="answerForm">
                    @csrf

                    <input type="hidden" name="question" value="{{ $question }}">

                    <label class="block text-lg font-bold text-gray-900 mb-4">
                        Votre réponse
                    </label>

                    <textarea
                        name="answer"
                        id="answerText"
                        rows="8"
                        required
                        minlength="20"
                        class="w-full rounded-2xl border border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 p-5 text-gray-900"
                        placeholder="Écrivez votre réponse ici..."></textarea>

                    <div class="flex justify-between text-sm text-gray-500 mt-2">
                        <span>Minimum 20 caractères</span>
                        <span id="charCount">0</span>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">

                        <button type="submit" name="finish" value="1"
                                class="w-full py-4 rounded-2xl bg-gradient-to-r from-green-500 to-green-600 text-white font-bold shadow-lg hover:shadow-xl transition">
                            Terminer
                        </button>

                        <button type="submit" name="continue" value="1"
                                class="w-full py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold shadow-lg hover:shadow-xl transition">
                            Question suivante
                        </button>

                    </div>

                </form>

            </div>

            <!-- TIPS -->
            <div class="mt-8 bg-indigo-50 border border-indigo-100 rounded-3xl p-6">
                <h3 class="font-bold text-indigo-900 mb-3">Conseils</h3>

                <ul class="space-y-2 text-indigo-800 text-sm">
                    <li>✔ Utilisez la méthode STAR</li>
                    <li>✔ Donnez des exemples concrets</li>
                    <li>✔ Soyez clair et structuré</li>
                </ul>
            </div>

        </div>
    </div>

    <script>
        const textarea = document.getElementById('answerText');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', () => {
            const count = textarea.value.length;
            charCount.textContent = count;

            localStorage.setItem('answer', textarea.value);
        });

        window.addEventListener('load', () => {
            const saved = localStorage.getItem('answer');
            if (saved) {
                textarea.value = saved;
                charCount.textContent = saved.length;
            }
        });

        document.getElementById('answerForm').addEventListener('submit', () => {
            localStorage.removeItem('answer');
        });
    </script>

</x-app-layout>