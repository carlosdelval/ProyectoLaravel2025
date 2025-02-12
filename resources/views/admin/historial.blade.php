<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-10 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-2xl font-semibold text-gray-700">
            Historial de graduaciones de {{ $user->name }} {{ $user->surname }}
        </h2>

        <!-- Mensajes de sesión -->
        @if (session('success'))
            <div class="p-2 mb-4 text-green-700 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-2 mb-4 text-red-700 bg-red-100 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Versión Escritorio (Tabla) -->
        <div class="hidden mt-4 overflow-hidden rounded-lg shadow-md bg-gray-50 md:block">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-gray-700 bg-blue-100">
                        <th class="px-6 py-3 text-left">Eje</th>
                        <th class="px-6 py-3 text-left">Cilindro</th>
                        <th class="px-6 py-3 text-left">Esfera</th>
                        <th class="px-6 py-3 text-left">Fecha Graduación</th>
                        <th class="px-6 py-3 text-left"></th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($historial as $registro)
                        <tr class="transition-all hover:bg-gray-100">
                            <td class="px-6 py-4">{{ $registro->eje }}</td>
                            <td class="px-6 py-4">{{ $registro->cilindro ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $registro->esfera ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($registro->Cita->fecha)->format('d-m-y') }}</td>
                            <td class="flex px-6 py-4 space-x-2 text-right">
                                <!-- Botón para editar historial -->
                                <a href="{{ route('admin.historial.edit', $registro->id) }}">
                                    <x-primary-button class="px-4 py-2 text-sm">
                                        {{ __('Editar') }}
                                    </x-primary-button>
                                </a>

                                <!-- Botón para eliminar historial -->
                                <form action="{{ route('admin.historial.destroy', $registro->id) }}" method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este historial?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="px-4 py-2 text-sm">
                                        {{ __('Eliminar') }}
                                    </x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-600">
                                No hay historial de graduaciones registrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Versión Móvil (Acordeón) -->
        <div class="mt-4 space-y-2 md:hidden" x-data="{ open: null }">
            @forelse($historial as $registro)
                <div class="overflow-hidden transition-all bg-white border rounded-lg shadow-sm">
                    <button
                        @click="open === {{ $loop->index }} ? open = null : open = {{ $loop->index }}"
                        class="flex items-center justify-between w-full p-4 text-left bg-gray-50 hover:bg-gray-100"
                    >
                        <div>
                            <span class="font-medium">Fecha: {{ \Carbon\Carbon::parse($registro->Cita->fecha)->format('d-m-y') }}</span>
                        </div>
                        <svg class="w-5 h-5 transition-transform transform" :class="{ 'rotate-180': open === {{ $loop->index }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open === {{ $loop->index }}" x-cloak class="p-4 border-t">
                        <div class="grid gap-2">
                            <div>
                                <span class="font-medium">Eje:</span>
                                <span class="ml-2">{{ $registro->eje }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Cilindro:</span>
                                <span class="ml-2">{{ $registro->cilindro ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Esfera:</span>
                                <span class="ml-2">{{ $registro->esfera ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap justify-end gap-2 mt-4">
                            <a href="{{ route('admin.historial.edit', $registro->id) }}" class="w-full">
                                <x-primary-button class="w-full px-4 py-2 text-sm">
                                    {{ __('Editar') }}
                                </x-primary-button>
                            </a>
                            <form action="{{ route('admin.historial.destroy', $registro->id) }}" method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este historial?');" class="w-full">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="w-full px-4 py-2 text-sm">
                                    {{ __('Eliminar') }}
                                </x-danger-button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-600 bg-white rounded-lg">
                    No hay historial de graduaciones registrado.
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $historial->links() }}
        </div>
    </div>
</x-app-layout>
