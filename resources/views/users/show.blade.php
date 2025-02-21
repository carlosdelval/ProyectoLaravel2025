<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-10 bg-white shadow-lg rounded-2xl">
        <h2 class="mb-6 text-2xl font-semibold text-gray-700">📖 Tu historial de citas, {{ Auth::user()->name }}</h2>
        @livewire('historial-vista-list')
    </div>
</x-app-layout>
