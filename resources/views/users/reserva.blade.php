<x-app-layout>
    <div class="max-w-lg p-6 mx-auto mt-10 bg-white shadow-lg rounded-2xl">
        <h2 class="mb-4 text-3xl font-extrabold text-blue-600">📅 Reservar Cita</h2>
        <p class="text-gray-600">Selecciona la fecha y hora para su próxima graduación.</p>

        @if(session('success'))
            <div class="p-3 my-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.reserva.store') }}" class="mt-6">
            @csrf

            <!-- Fecha -->
            <div>
                <x-input-label for="fecha_reserva" :value="__('📆 Fecha de la cita')" />
                <x-text-input id="fecha_reserva" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" type="date" name="fecha_reserva" required />
                <x-input-error :messages="$errors->get('fecha_reserva')" class="mt-2" />
            </div>

            <!-- Hora -->
            <div class="mt-4">
                <x-input-label for="hora_reserva" :value="__('⏰ Hora de la cita')" />
                <x-text-input id="hora_reserva" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" type="time" name="hora_reserva" required />
                <x-input-error :messages="$errors->get('hora_reserva')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="px-6 py-3 text-lg">
                    {{ __('Reservar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
