<div>
    <div class="flex flex-col md:flex-row">
        <div class="flex gap-2 mb-2">
            <animated-icons
                src="https://animatedicons.co/get-icon?name=user%20profile&style=minimalistic&token=d085a379-5ce3-4078-bcef-6b3a19fa1d4f"
                trigger="hover"
                attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                height="60" width="60"></animated-icons>
            <h2 class="mt-4 text-2xl font-semibold text-gray-700">
                Gestión de clientes
            </h2>
        </div>
        <!-- Barra de búsqueda liveware por Nombre,Apellido,Tlf o DNI  -->
        <div class="mt-3 md:ml-auto">
            <input type="text" wire:model.live="search" class="w-full px-4 py-2 border rounded-lg md:w-96"
                placeholder="Buscar por nombre, apellidos, teléfono o DNI" />
        </div>
    </div>
    <div class="hidden mt-4 overflow-x-auto rounded-lg shadow-md bg-gray-50 md:block">
        <table class="w-full border-collapse min-w-[600px]">
            <thead>
                <tr class="text-gray-700 bg-blue-100">
                    <th scope="col" class="px-6 py-3 text-left">
                        <div class="flex items-center">Nombre<a wire:click="ordenarNombre()" href="#"><svg
                                    class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        <div class="flex items-center">Apellidos<a wire:click="ordenarApellido()" href="#"><svg
                                    class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        <div class="flex items-center">Teléfono<a wire:click="ordenarTlf()" href="#"><svg
                                    class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left">
                        <div class="flex items-center">DNI<a wire:click="ordenarDni()" href="#"><svg
                                    class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($clientes as $user)
                    <tr class="transition-all hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->surname }}</td>
                        <td class="px-6 py-4">{{ $user->tlf }}</td>
                        <td class="px-6 py-4">{{ $user->dni }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap justify-end gap-2">
                                <a href="{{ route('admin.usuarios.editar', $user->id) }}">
                                    <x-secondary-button class="px-3 py-2 text-xs">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-white-800 dark:text-dark" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                            </svg>
                                        </div>
                                    </x-secondary-button>
                                </a>
                                <a href="{{ route('admin.usuarios.historial', $user->id) }}">
                                    <x-primary-button class="px-3 py-2 text-xs">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-white-800 dark:text-dark" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                                            </svg>
                                        </div>
                                    </x-primary-button>
                                </a>
                                <form action="{{ route('usuario.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('¿Está seguro de que desea eliminar este usuario?');">
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
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-600">No se encontraron clientes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Versión Móvil (Acordeón) -->
    <div class="mt-4 space-y-2 md:hidden" x-data="{ open: null }">
        @forelse($clientes as $user)
            <div class="overflow-hidden transition-all bg-white border rounded-lg shadow-sm">
                <button @click="open === {{ $loop->index }} ? open = null : open = {{ $loop->index }}"
                    class="flex items-center justify-between w-full p-4 text-left bg-gray-50 hover:bg-gray-100">
                    <div>
                        <span class="font-medium">{{ $user->name }} {{ $user->surname }}</span>
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
                            <span class="font-medium">Teléfono:</span>
                            <span class="ml-2">{{ $user->tlf }}</span>
                        </div>
                        <div>
                            <span class="font-medium">DNI:</span>
                            <span class="ml-2">{{ $user->dni }}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4">
                        <div class="flex flex-wrap justify-end gap-2">
                            <a href="{{ route('admin.usuarios.editar', $user->id) }}">
                                <x-secondary-button class="px-3 py-2 text-xs">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-white-800 dark:text-dark" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                        </svg>
                                    </div>
                                </x-secondary-button>
                            </a>
                            <a href="{{ route('admin.usuarios.historial', $user->id) }}">
                                <x-primary-button class="px-3 py-2 text-xs">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-white-800 dark:text-dark" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                                        </svg>

                                    </div>
                                </x-primary-button>
                            </a>
                            <form action="{{ route('usuario.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('¿Está seguro de que desea eliminar este usuario?');">
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
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-4 text-center text-gray-600 bg-white rounded-lg">
                No se encontraron clientes.
            </div>
        @endforelse
    </div>
    @if ($clientes->hasPages())
        <div class="mt-4">
            {{ $clientes->links() }}
        </div>
    @endif
</div>
