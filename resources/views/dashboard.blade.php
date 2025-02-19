<x-app-layout>
    <div class="max-w-4xl p-6 mx-auto mt-10 bg-white shadow-lg rounded-2xl">
        <!-- Mensaje de bienvenida -->
        <h1 class="text-4xl font-extrabold text-blue-600">Bienvenido, {{ Auth::user()->name }} 👋</h1>
        @if (Auth::user()->role == 'user')
            <p class="mt-2 text-lg text-gray-600">Aquí puedes gestionar tus citas y datos personales.</p>
        @elseif (Auth::user()->role == 'admin')
            <p class="mt-2 text-lg text-gray-600">Aquí puedes gestionar las citas y datos de tus clientes.</p>
        @endif

        <!-- Mensajes de éxito/error -->
        @if (session('success'))
            <div class="p-3 mt-4 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-3 mt-4 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabla de citas -->
        <div class="mt-8">
            @if (Auth::user()->role == 'user')
                <h2 class="text-2xl font-semibold text-gray-700">📅 Tus citas actuales</h2>
            @elseif (Auth::user()->role == 'admin')
                <h2 class="text-2xl font-semibold text-gray-700">📅 Citas programadas</h2>
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
                                <td class="px-6 py-4 text-right">
                                    @if (Auth::user()->role == 'user')
                                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas anular esta cita?');">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="px-4 py-2 text-sm">
                                                {{ __('Anular') }}
                                            </x-danger-button>
                                        </form>
                                    @elseif (Auth::user()->role == 'admin')
                                        <div class="flex">
                                            <form action="{{ route('admin.citas.edit', $cita->id) }}" method="GET">
                                                <x-primary-button class="px-4 py-2 text-sm">
                                                    {{ __('Asignar graduación') }}
                                                </x-primary-button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No tienes citas
                                    programadas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Versión Móvil (Acordeón) -->
            <div class="mt-4 space-y-2 md:hidden" x-data="{ open: null }">
                @forelse($citas as $cita)
                    <div class="overflow-hidden transition-all bg-white border rounded-lg shadow-sm">
                        <button
                            @click="open === {{ $loop->index }} ? open = null : open = {{ $loop->index }}"
                            class="flex items-center justify-between w-full p-4 text-left bg-gray-50 hover:bg-gray-100"
                        >
                            <div>
                                <span class="font-medium">{{ \Carbon\Carbon::parse($cita->fecha)->format('d-m-Y') }}</span>
                                <span class="ml-2 text-gray-600">{{ $cita->hora }}</span>
                            </div>
                            <svg class="w-5 h-5 transition-transform transform" :class="{ 'rotate-180': open === {{ $loop->index }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open === {{ $loop->index }}" x-cloak class="p-4 border-t">
                            <div class="grid gap-2">
                                @if (Auth::user()->role == 'admin')
                                    <div>
                                        <span class="font-medium">Cliente:</span>
                                        <span class="ml-2">{{ $cita->user->name . ' ' . $cita->user->surname }}</span>
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
                                        <x-danger-button class="w-full px-4 py-2 text-sm">
                                            {{ __('Anular') }}
                                        </x-danger-button>
                                    </form>
                                @elseif (Auth::user()->role == 'admin')
                                    <form action="{{ route('admin.citas.edit', $cita->id) }}" method="GET">
                                        <x-primary-button class="w-full px-4 py-2 text-sm">
                                            {{ __('Asignar graduación') }}
                                        </x-primary-button>
                                    </form>
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
