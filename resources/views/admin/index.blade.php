<x-app-layout>
<div class="max-w-6xl mx-auto mt-10">

    <h2 class="text-2xl font-bold mb-6">Admin Panel RH 👔</h2>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-bold">Users</h3>
        @foreach($users as $u)
            <p>{{ $u->name }} - {{ $u->email }}</p>
        @endforeach
    </div>

</div>
</x-app-layout>