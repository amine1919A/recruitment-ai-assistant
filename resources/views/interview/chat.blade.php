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
                            <h1 class="text-2xl font-bold text-gray-900">Interview en direct</h1>
                            <p class="text-gray-600">CV: {{ basename($cv->file_path) }}</p>
                            @if(isset($questionNumber))
                                <p class="text-sm text-purple-600 font-semibold">Question {{ $questionNumber }}/10</p>
                            @endif
                        </div>
                    </div>
                    <a href="/interview" class="text-gray-600 hover:text-gray-900 font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Quitter
                    </a>
                </div>
            </div>

            <!-- Progress Bar -->
            @if(isset($questionNumber))
                <div class="mb-8">
                    <div class="flex justify-between text-sm text-gray-600 mb-2">
                        <span>Progression</span>
                        <span>{{ $questionNumber }}/10 questions</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        <div class="gradient-bg h-3 rounded-full transition-all duration-500" style="width: {{ ($questionNumber / 10) * 100 }}%"></div>
                    </div>
                </div>
            @endif

            <!-- Question Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8 border-l-4 border-purple-500 message-bubble">
                <div class="flex gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg flex-shrink-0">
                        AI
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-purple-600 mb-2">Recruteur IA</p>
                        <p class="text-gray-900 text-lg leading-relaxed font-medium">{{ $question }}</p>
                    </div>
                </div>
            </div>

            <!-- History -->
            @if(isset($history) && count($history) > 0)
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                    <h3 class="font-bold text-lg mb-4 text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Historique de cette session
                    </h3>
                    <div class="space-y-4">
                        @foreach($history as $index => $item)
                            <div class="border-l-4 border-gray-200 pl-4 py-2">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">Q{{ $index + 1 }}</span>
                                    <span class="px-3 py-1 rounded-full text-sm font-bold
                                        {{ $item['score'] >= 7 ? 'bg-green-100 text-green-800' : ($item['score'] >= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $item['score'] }}/10
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $item['question'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Answer Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <form action="/interview/submit" method="POST" id="answerForm">
                    @csrf
                    
                    <input type="hidden" name="question" value="{{ $question }}">

                    <div class="mb-6">
                        <label class="block text-gray-900 font-bold text-lg mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Votre réponse
                        </label>
                        <textarea 
                            name="answer" 
                            id="answerText"
                            rows="8" 
                            required 
                            minlength="20"
                            placeholder="Prenez votre temps pour répondre de manière complète et structurée..."
                            class="w-full border-2 border-gray-200 rounded-xl px-6 py-4 focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition text-gray-900 text-lg leading-relaxed"
                        ></textarea>
                        <div class="flex justify-between items-center mt-2">
                            <p class="text-sm text-gray-500">Minimum 20 caractères</p>
                            <p class="text-sm text-gray-500" id="charCount">0 caractères</p>
                        </div>
                        @error('answer')
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Terminer l'interview
                        </button>
                        <button type="submit" name="continue" value="1" class="flex-1 btn-primary text-white px-8 py-5 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition font-bold text-lg flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                            Question suivante
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tips Card -->
            <div class="bg-blue-50 rounded-2xl p-6 mt-8 border border-blue-100">
                <h3 class="font-bold text-blue-900 mb-3 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    Conseils pour réussir
                </h3>
                <ul class="space-y-2 text-blue-800">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Structurez votre réponse avec des exemples concrets</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Utilisez la méthode STAR (Situation, Tâche, Action, Résultat)</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Quantifiez vos résultats quand c'est possible</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <script>
        // Character counter
        const textarea = document.getElementById('answerText');
        const charCount = document.getElementById('charCount');
        
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count + ' caractères';
            
            if (count >= 20) {
                charCount.classList.remove('text-gray-500');
                charCount.classList.add('text-green-600', 'font-semibold');
            } else {
                charCount.classList.remove('text-green-600', 'font-semibold');
                charCount.classList.add('text-gray-500');
            }
        });

        // Auto-save to localStorage
        textarea.addEventListener('input', function() {
            localStorage.setItem('currentAnswer', this.value);
        });

        // Restore from localStorage
        window.addEventListener('load', function() {
            const saved = localStorage.getItem('currentAnswer');
            if (saved) {
                textarea.value = saved;
                textarea.dispatchEvent(new Event('input'));
            }
        });

        // Clear on submit
        document.getElementById('answerForm').addEventListener('submit', function() {
            localStorage.removeItem('currentAnswer');
        });
    </script>
</x-app-layout>