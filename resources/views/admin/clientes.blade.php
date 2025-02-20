<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-10 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-2xl font-semibold text-gray-700">Gestión de Clientes</h2>
        @if (session('success'))
            <div class="p-3 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @livewire('cliente-list')
    </div>
</x-app-layout>
