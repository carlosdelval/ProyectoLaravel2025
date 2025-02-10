<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-10 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-2xl font-semibold text-gray-700">Gestión de Clientes</h2>

        <form method="GET" action="{{ route('admin.clientes') }}" class="mb-4">
            <div class="flex flex-wrap items-center gap-4">
                <x-text-input type="text" name="search" placeholder="Buscar por nombre, apellidos, teléfono o DNI"
                    class="w-full px-4 py-2 border rounded-lg md:w-96" value="{{ request('search') }}" />

                <x-primary-button type="submit" class="px-4 py-2">
                    {{ __('Buscar') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Versión Escritorio (Tabla) -->
        <div class="hidden mt-4 overflow-x-auto rounded-lg shadow-md bg-gray-50 md:block">
            <table class="w-full border-collapse min-w-[600px]">
                <thead>
                    <tr class="text-gray-700 bg-blue-100">
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Apellidos</th>
                        <th class="px-6 py-3 text-left">Teléfono</th>
                        <th class="px-6 py-3 text-left">DNI</th>
                        <th class="px-6 py-3 text-left"></th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($users as $user)
                        <tr class="transition-all hover:bg-gray-100">
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->surname }}</td>
                            <td class="px-6 py-4">{{ $user->tlf }}</td>
                            <td class="px-6 py-4">{{ $user->dni }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <a href="{{ route('admin.usuarios.editar', $user->id) }}">
                                        <x-primary-button class="px-3 py-2 text-xs">
                                            {{ __('Editar') }}
                                        </x-primary-button>
                                    </a>
                                    <a href="{{ route('admin.usuarios.historial', $user->id) }}">
                                        <x-secondary-button class="px-3 py-2 text-xs">
                                            {{ __('Ver Historial') }}
                                        </x-secondary-button>
                                    </a>
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
            @forelse($users as $user)
                <div class="overflow-hidden transition-all bg-white border rounded-lg shadow-sm">
                    <button
                        @click="open === {{ $loop->index }} ? open = null : open = {{ $loop->index }}"
                        class="flex items-center justify-between w-full p-4 text-left bg-gray-50 hover:bg-gray-100"
                    >
                        <div>
                            <span class="font-medium">{{ $user->name }} {{ $user->surname }}</span>
                        </div>
                        <svg class="w-5 h-5 transition-transform transform" :class="{ 'rotate-180': open === {{ $loop->index }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <a href="{{ route('admin.usuarios.editar', $user->id) }}" class="w-full">
                                <x-primary-button class="w-full px-3 py-2 text-xs">
                                    {{ __('Editar') }}
                                </x-primary-button>
                            </a>
                            <a href="{{ route('admin.usuarios.historial', $user->id) }}" class="w-full">
                                <x-secondary-button class="w-full px-3 py-2 text-xs">
                                    {{ __('Ver Historial') }}
                                </x-secondary-button>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-600 bg-white rounded-lg">
                    No se encontraron clientes.
                </div>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
