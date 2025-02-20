<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-10 bg-white shadow-lg rounded-2xl">
        <!-- Tabla de citas -->
        <div class="">
            @if (Auth::user()->role == 'user')
                <h2 class="text-2xl font-semibold text-gray-700">📅 Tus citas actuales</h2>
            @elseif (Auth::user()->role == 'admin')
                <h2 class="text-2xl font-semibold text-gray-700">📅 Citas programadas</h2>
            @endif

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

            <!-- Versión Escritorio (Tabla) -->
            <div class="hidden mt-4 overflow-x-auto rounded-lg shadow-md bg-gray-50 md:block">
                <table class="w-full border-collapse min-w-[600px]">
                    <thead>
                        <tr class="text-gray-700 bg-blue-100">
                            <th class="px-6 py-3 text-left">Fecha</th>
                            <th class="px-6 py-3 text-left">Hora</th>
                            @if (Auth::user()->role == 'admin')
                                <th class="px-6 py-3 text-left">Cliente</th>
                                <th class="px-6 py-3 text-left">Tlf</th>
                            @endif
                            <th class="px-6 py-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($citas as $cita)
                            <tr class="transition-all hover:bg-gray-100">
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cita->fecha)->format('d-m-Y') }}</td>
                                <td class="px-6 py-4">{{ $cita->hora }}</td>
                                @if (Auth::user()->role == 'admin')
                                    <td class="px-6 py-4">{{ $cita->user->name . ' ' . $cita->user->surname }}</td>
                                    <td class="px-6 py-4">{{ $cita->user->tlf }}</td>
                                @endif
                                <td class="justify-end px-6 py-4 text-right">
                                    @if (Auth::user()->role == 'user')
                                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas anular esta cita?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="px-4 py-2 text-sm">
                                                <div class="flex items-center gap-2">
                                                    Anular<svg class="w-4 h-4 text-white-800 dark:text-gray"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </x-danger-button>
                                        </form>
                                    @elseif (Auth::user()->role == 'admin')
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('admin.citas.edit', $cita->id) }}" method="GET">
                                                <x-primary-button class="px-4 py-2 text-sm">
                                                    <div class="flex items-center gap-2">
                                                        Graduar<svg class="w-4 h-4 text-white-800 dark:text-dark"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-width="2"
                                                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                            <path stroke="currentColor" stroke-width="2"
                                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        </svg>
                                                    </div>
                                                </x-primary-button>
                                            </form>
                                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST"
                                                onsubmit="return confirm('¿Está seguro de que desea anular esta cita? El cliente será notificado en su perfil.');">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button class="px-4 py-2 text-sm">
                                                    <div class="flex items-center gap-2">
                                                        Anular<svg class="w-4 h-4 text-white-800 dark:text-gray"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </x-danger-button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No tienes citas
                                    programadas para esta semana.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Versión Móvil (Acordeón) -->
            <div class="mt-4 space-y-2 md:hidden" x-data="{ open: null }">
                @forelse($citas as $cita)
                    <div class="overflow-hidden transition-all bg-white border rounded-lg shadow-sm">
                        <button @click="open === {{ $loop->index }} ? open = null : open = {{ $loop->index }}"
                            class="flex items-center justify-between w-full p-4 text-left bg-gray-50 hover:bg-gray-100">
                            <div>
                                <span
                                    class="font-medium">{{ \Carbon\Carbon::parse($cita->fecha)->format('d-m-Y') }}</span>
                                <span class="ml-2 text-gray-600">{{ $cita->hora }}</span>
                            </div>
                            <svg class="w-5 h-5 transition-transform transform"
                                :class="{ 'rotate-180': open === {{ $loop->index }} }" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open === {{ $loop->index }}" x-cloak class="p-4 border-t">
                            <div class="grid gap-2">
                                @if (Auth::user()->role == 'admin')
                                    <div>
                                        <span class="font-medium">Cliente:</span>
                                        <span
                                            class="ml-2">{{ $cita->user->name . ' ' . $cita->user->surname }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium">Teléfono:</span>
                                        <span class="ml-2">{{ $cita->user->tlf }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                @if (Auth::user()->role == 'user')
                                    <form action="{{ route('citas.destroy', $cita->id) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas anular esta cita?');">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button class="px-4 py-2 text-sm">
                                            <div class="flex items-center gap-2">
                                                Anular<svg class="w-4 h-4 text-white-800 dark:text-gray"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                    height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </x-danger-button>
                                    </form>
                                @elseif (Auth::user()->role == 'admin')
                                    <div class="flex justify-center gap-2">
                                        <form action="{{ route('admin.citas.edit', $cita->id) }}" method="GET">
                                            <x-primary-button class="px-4 py-2 text-sm">
                                                <div class="flex items-center gap-2">
                                                    Graduar<svg class="w-4 h-4 text-white-800 dark:text-dark"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-width="2"
                                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                                        <path stroke="currentColor" stroke-width="2"
                                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </div>
                                            </x-primary-button>
                                        </form>
                                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST"
                                            onsubmit="return confirm('¿Está seguro de que desea anular esta cita? El cliente será notificado en su perfil.');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="px-4 py-2 text-sm">
                                                <div class="flex items-center gap-2">
                                                    Anular<svg class="w-4 h-4 text-white-800 dark:text-gray"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </x-danger-button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500 bg-white rounded-lg">
                        No tienes citas programadas.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
