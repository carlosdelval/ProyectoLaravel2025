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
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </x-secondary-button>
                                </a>
                                @if (Auth::user()->role === 'admin')
                                    <x-danger-button class="px-3 py-2 my-2 text-xs"
                                        wire:click="deleteHistorial({{ $registro->id }})"
                                        wire:confirm="¿Estás seguro de que deseas eliminar el registro?">
                                        <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                                d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                                        </svg>
                                    </x-danger-button>
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
                                <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                </svg>
                            </x-primary-button>
                        </a>
                        <x-danger-button class="px-3 py-2 my-2 text-xs"
                            wire:click="deleteHistorial({{ $registro->id }})"
                            wire:confirm="¿Estás seguro de que deseas eliminar el registro?">
                            <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                    d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                            </svg>
                        </x-danger-button>
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
