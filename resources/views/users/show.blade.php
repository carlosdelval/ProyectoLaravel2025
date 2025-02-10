<x-app-layout>
    <div class="max-w-4xl p-6 mx-auto mt-10 bg-white shadow-lg rounded-2xl">
        <h2 class="mb-4 text-3xl font-extrabold text-blue-600">Tus datos, {{ Auth::user()->name }} 👓</h2>
        <p class="text-gray-600">Consulta el registro de tus graduaciones anteriores.</p>

        <div class="mt-6 overflow-hidden rounded-lg shadow-md bg-gray-50">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-gray-700 bg-blue-100">
                        <th class="px-6 py-3 text-left">Fecha Graduación</th>
                        <th class="px-6 py-3 text-left">Eje</th>
                        <th class="px-6 py-3 text-left">Cilindro</th>
                        <th class="px-6 py-3 text-left">Esfera</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($user->historialVista as $historial)
                        <tr class="transition-all hover:bg-gray-100">
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($historial->cita->fecha)->format('d/m/y') }}</td>
                            <td class="px-6 py-4">{{ $historial->eje }}</td>
                            <td class="px-6 py-4">{{ $historial->cilindro ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $historial->esfera ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No tienes historial de graduaciones.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
