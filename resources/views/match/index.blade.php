<x-app-layout>
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Job Matching AI</h2>

    <form method="POST" action="/match">
        @csrf

        <textarea name="cv" placeholder="CV text" class="w-full border p-2 mb-3"></textarea>

        <textarea name="job" placeholder="Job description" class="w-full border p-2 mb-3"></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Analyser
        </button>
    </form>

</div>
</x-app-layout>