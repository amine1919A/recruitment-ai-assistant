<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-6">Upload CV 🤖</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/cv/upload" enctype="multipart/form-data">
            @csrf

            <input type="file"
                   name="cv"
                   class="border p-2 w-full mb-4"
                   required>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Analyse CV
            </button>
        </form>

    </div>
</x-app-layout>