<x-app-layout>
    <div class="max-w-2xl p-6 mx-auto mt-10 bg-white shadow-lg rounded-2xl">
        <h2 class="mb-4 text-3xl font-extrabold text-blue-600">✏️ Editar Cita</h2>
        <p class="text-gray-600">Modifica los datos de la graduación vinculada a esta cita.</p>

        @if(session('success'))
            <div class="p-3 my-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="p-3 my-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.citas.update', $cita->id) }}" class="mt-6">
            @csrf
            @method('PUT')

            <!-- Eje -->
            <div>
                <x-input-label for="eje" :value="__('📏 Eje')" />
                <x-text-input id="eje" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" type="number" step="0.01" name="eje" value="{{ $cita->HistorialVista->eje }}" required />
                <x-input-error :messages="$errors->get('eje')" class="mt-2" />
            </div>

            <!-- Cilindro -->
            <div class="mt-4">
                <x-input-label for="cilindro" :value="__('🔵 Cilindro')" />
                <x-text-input id="cilindro" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" type="number" step="0.01" name="cilindro" value="{{ $cita->HistorialVista->cilindro }}" />
                <x-input-error :messages="$errors->get('cilindro')" class="mt-2" />
            </div>

            <!-- Esfera -->
            <div class="mt-4">
                <x-input-label for="esfera" :value="__('⚫ Esfera')" />
                <x-text-input id="esfera" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" type="number" step="0.01" name="esfera" value="{{ $cita->HistorialVista->esfera }}" />
                <x-input-error :messages="$errors->get('esfera')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6 space-x-4">
                <x-primary-button>
                    {{ __('Guardar Cambios') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
