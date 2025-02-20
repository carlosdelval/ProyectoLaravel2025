<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-10 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-2xl font-semibold text-gray-700">Historial de citas de {{ $user->name }} {{ $user->surname }}</h2>
        @livewire('historial-vista-list', ['id' => $user->id])
    </div>
</x-app-layout>
