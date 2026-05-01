<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Upload CV</h2>

        @if(session('success'))
            <div class="bg-green-100 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('cv.upload') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="cv" class="mb-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Upload
            </button>
        </form>
    </div>
</x-app-layout>