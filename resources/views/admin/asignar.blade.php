<x-app-layout>
    <div class="max-w-2xl p-6 mx-auto mt-4 bg-white shadow-lg rounded-2xl">
        <div class="flex gap-2 mb-2">
            <animated-icons
                src="https://animatedicons.co/get-icon?name=Eye&style=minimalistic&token=3363947a-d29a-4adb-ac74-dd049eef3379"
                trigger="hover"
                attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                height="60" width="60"></animated-icons>
            <h2 class="mt-3 text-2xl font-semibold text-gray-700">Asignar graduación</h2>
        </div>
        <p class="text-gray-600">Modifica los datos de la graduación vinculada a esta cita.</p>
        <div class="p-4 my-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <div>
                <span class="font-medium">{{ $cita->user->name }} {{ $cita->user->surname }}
            </div>
            <div class="mt-2">
                <span class="font-medium">{{ $cita->optica->nombre }}</span>
            </div>
            <div class="mt-2">
                <span class="font-medium">Fecha: {{ \Carbon\Carbon::parse($cita->fecha)->format('d-m-Y') }}
            </div>
            <div class="mt-2">
                <span class="font-medium">Hora: {{ $cita->hora }}
            </div>
        </div>

        @if (session('success'))
            <div class="p-3 my-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-3 my-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.citas.update', $cita->id) }}" enctype="multipart/form-data"
            class="mt-6">
            @csrf
            @method('PUT')

            @foreach (['eje' => '📏 Eje', 'cilindro' => '🔵 Cilindro', 'esfera' => '⚫ Esfera'] as $field => $label)
                <x-input-label for="{{ $field }}" :value="$label" class="mt-4" />
                <x-text-input id="{{ $field }}" type="number" step="0.01" name="{{ $field }}"
                    class="block w-full mt-1" value="{{ old($field, $cita->historialVista->$field ?? '') }}"
                    required />
                <x-input-error :messages="$errors->get($field)" class="mt-2" />
            @endforeach

            <!-- Subida de PDF -->
            <x-input-label for="revision_pdf" class="mt-4">
                <div class="flex gap-1">
                    <animated-icons
                        src="https://animatedicons.co/get-icon?name=Pdf&style=minimalistic&token=d5afb04f-d10f-4540-bf0a-27e0b4e06ce8"
                        trigger="hover"
                        attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                        height="30" width="30"></animated-icons>
                    <p class="mt-1">Subir Informe PDF (Opcional, PDFs existentes se mantendrán)</p>
                </div>
            </x-input-label>
            <x-text-input id="revision_pdf" type="file" name="revision_pdf" accept="application/pdf"
                class="block w-full mt-1" />
            <x-input-error :messages="$errors->get('revision_pdf')" class="mt-2" />

            <div class="flex items-center justify-end mt-6 space-x-4">
                <x-primary-button>
                    Guardar Cambios
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
