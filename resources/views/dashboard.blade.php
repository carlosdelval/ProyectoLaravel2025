<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-4 bg-white shadow-lg rounded-2xl">
        <!-- Tabla de citas -->
        <div class="">
            <!-- Mensajes de éxito/error -->
            @if (session('success'))
                <div class="p-3 mt-2 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-3 mt-2 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            @livewire('citas-programadas')
        </div>
    </div>
</x-app-layout>
