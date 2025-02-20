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

        <form method="POST" action="{{ route('admin.citas.update', $cita->id) }}" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            @foreach(['eje' => '📏 Eje', 'cilindro' => '🔵 Cilindro', 'esfera' => '⚫ Esfera'] as $field => $label)
                <x-input-label for="{{ $field }}" :value="$label" class="mt-4" />
                <x-text-input id="{{ $field }}" type="number" step="0.01" name="{{ $field }}" class="block w-full mt-1" value="{{ old($field, $cita->historialVista->$field ?? '') }}" required />
                <x-input-error :messages="$errors->get($field)" class="mt-2" />
            @endforeach

            <!-- Subida de PDF -->
            <x-input-label for="revision_pdf" value="📂 Subir Informe PDF (Opcional, PDFs existentes se mantendrán)" class="mt-4" />
            <x-text-input id="revision_pdf" type="file" name="revision_pdf" accept="application/pdf" class="block w-full mt-1" />
            <x-input-error :messages="$errors->get('revision_pdf')" class="mt-2" />

            <div class="flex items-center justify-end mt-6 space-x-4">
                <x-primary-button>
                    Guardar Cambios
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
