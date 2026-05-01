<x-app-layout>
    <div class="max-w-6xl mx-auto mt-10">

        <h2 class="text-2xl font-bold mb-6">Dashboard Recrutement AI 📊</h2>

        <!-- STATS -->
        <div class="grid grid-cols-3 gap-4 mb-6">

            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-500">CV Analysés</h3>
                <p class="text-2xl font-bold">{{ $cvs->count() }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-500">Entretiens</h3>
                <p class="text-2xl font-bold">{{ $interviews->count() }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-500">Score Moyen</h3>
                <p class="text-2xl font-bold">
                    {{ round($avgScore, 1) ?? 0 }}/100
                </p>
            </div>

        </div>

        <!-- CV LIST -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <h3 class="font-bold mb-3">Derniers CV</h3>

            @foreach($cvs as $cv)
                <div class="border-b py-2">
                    📄 {{ $cv->file_path }}
                </div>
            @endforeach
        </div>

        <!-- INTERVIEW LIST -->
        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-bold mb-3">Entretiens récents</h3>

            @foreach($interviews as $i)
                <div class="border-b py-2">
                    🎤 {{ $i->question }} — Score: {{ $i->score }}/100
                </div>
            @endforeach
        </div>
        <div class="bg-white p-4 rounded shadow mt-6">
                <h3 class="font-bold mb-3">Performance</h3>

                <div class="w-full bg-gray-200 h-4 rounded">
                    <div class="bg-green-500 h-4 rounded"
                    style="width: {{ $avgScore ?? 0 }}%"></div>
                </div>
        </div>

    </div>
    
</x-app-layout>