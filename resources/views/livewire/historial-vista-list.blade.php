<div>
    <input type="text" wire:model.live="search" class="w-full px-4 py-2 border rounded-lg md:w-96"
        placeholder="Buscar por fecha (Formato: yy-mm-dd)" />
    @if (session('error'))
        <div class="p-3 my-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    <div class="hidden mt-4 overflow-x-auto rounded-lg shadow-md bg-gray-50 md:block">
        <table class="w-full border-collapse min-w-[600px]">
            <thead>
                <tr class="text-gray-700 bg-blue-100">
                    <th scope="col" class="px-6 py-3 text-left">
                        <div class="flex items-center">Fecha<a wire:click="ordenar()" href="#"><svg
                                    class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                </svg>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">Eje</th>
                    <th scope="col" class="px-6 py-3 text-left">Cilindro</th>
                    <th scope="col" class="px-6 py-3 text-left scope="col" class="px-6 py-3 text-left"">Esfera</th>
                    <th scope="col" class="px-6 py-3 text-left"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($historial as $registro)
                    <tr class="transition-all hover:bg-gray-100">
                        <td class="px-6 py-4" class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($registro->Cita->fecha)->format('d-m-y') }}
                        </td>
                        <td class="px-6 py-4">{{ $registro->eje }}</td>
                        <td class="px-6 py-4">{{ $registro->cilindro ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $registro->esfera ?? 'N/A' }}</td>
                        <td>
                            <div class="flex flex-wrap justify-end gap-2">
                                <a href="{{ route('historial.descargar', $registro->id) }}">
                                    <x-secondary-button class="px-3 py-2 my-2 text-xs">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                            </svg>
                                        </div>
                                    </x-secondary-button>
                                </a>
                                @if (Auth::user()->role === 'admin')
                                    <form action="{{ route('historial.destroy', $registro->id) }}" method="POST"
                                        onsubmit="return confirm('¿Está seguro de que desea eliminar este registro?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="px-4 py-2 text-sm">
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </div>
                                        </x-danger-button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-600">No se encontró historial.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $historial->links() }}
    </div>

    <!-- Versión Móvil (Acordeón) -->
    <div class="mt-4 space-y-2 md:hidden" x-data="{ open: null }">
        @forelse($historial as $registro)
            <div class="overflow-hidden transition-all bg-white border rounded-lg shadow-sm">
                <button @click="open === {{ $loop->index }} ? open = null : open = {{ $loop->index }}"
                    class="flex items-center justify-between w-full p-4 text-left bg-gray-50 hover:bg-gray-100">
                    <div>
                        <span
                            class="font-medium">{{ \Carbon\Carbon::parse($registro->Cita->fecha)->format('d-m-y') }}</span>
                    </div>
                    <svg class="w-5 h-5 transition-transform transform"
                        :class="{ 'rotate-180': open === {{ $loop->index }} }" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
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
                            <span class="ml-2">{{ $registro->cilindro }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Esfera:</span>
                            <span class="ml-2">{{ $registro->esfera }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <a href="{{ route('historial.descargar', $registro->id) }}">
                            <x-primary-button class="px-3 py-2 my-2 text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </x-primary-button>
                        </a>
                        @if (Auth::user()->role === 'admin')
                            <form action="{{ route('historial.destroy', $registro->id) }}" method="POST"
                                onsubmit="return confirm('¿Está seguro de que desea eliminar este registro?');">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="px-4 py-2 text-sm">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </div>
                                </x-danger-button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-gray-600 bg-white rounded-lg">
                No se encontró historial.
            </div>
        @endforelse
    </div>
    @if ($historial->hasPages())
        <div class="mt-4">
            {{ $historial->links() }}
        </div>
    @endif
</div>
