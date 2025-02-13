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
                <x-input-label for="periodo" :value="__('⏰ Periodo de la cita')" />
                <select id="periodo" name="periodo" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
                    <option value="" selected disabled>Seleccione un periodo</option>
                    <option value="mañana">Mañana</option>""
                    <option value="tarde">Tarde</option>
                </select>
                <x-input-error :messages="$errors->get('periodo')" class="mt-2" />
            </div>

            <div class="mt-4" id="hora_mañana" style="display: none;">
                <x-input-label for="hora_mañana" :value="__('⏰ Hora de la cita (Mañana)')" />
                <select id="hora_mañana_select" name="hora_mañana" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    @for ($i = 10; $i <= 13; $i++)
                        @for ($j = 0; $j < 60; $j += 20)
                            <option value="{{ sprintf('%02d:%02d', $i, $j) }}">{{ sprintf('%02d:%02d', $i, $j) }}</option>
                        @endfor
                    @endfor
                </select>
                <x-input-error :messages="$errors->get('hora_mañana')" class="mt-2" />
            </div>

            <div class="mt-4" id="hora_tarde" style="display: none;">
                <x-input-label for="hora_tarde" :value="__('⏰ Hora de la cita (Tarde)')" />
                <select id="hora_tarde_select" name="hora_tarde" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    @for ($i = 17; $i <= 20; $i++)
                        @for ($j = 0; $j < 60; $j += 20)
                            <option value="{{ sprintf('%02d:%02d', $i, $j) }}">{{ sprintf('%02d:%02d', $i, $j) }}</option>
                        @endfor
                    @endfor
                </select>
                <x-input-error :messages="$errors->get('hora_tarde')" class="mt-2" />
            </div>

            <script>
                document.getElementById('periodo').addEventListener('change', function() {
                    var periodo = this.value;
                    document.getElementById('hora_mañana').style.display = (periodo === 'mañana') ? 'block' : 'none';
                    document.getElementById('hora_tarde').style.display = (periodo === 'tarde') ? 'block' : 'none';
                });
            </script>
            {{-- <div class="mt-4">
                <x-input-label for="hora_reserva" :value="__('⏰ Hora de la cita')" />
                <x-text-input id="hora_reserva" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" type="time" name="hora_reserva" required />
                <x-input-error :messages="$errors->get('hora_reserva')" class="mt-2" />
            </div> --}}

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="px-6 py-3 text-lg">
                    {{ __('Reservar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
