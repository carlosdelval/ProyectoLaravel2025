<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-4 bg-white shadow-lg rounded-2xl">
        @if (session('success'))
            <div class="p-3 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @livewire('cliente-list')
    </div>
</x-app-layout>
