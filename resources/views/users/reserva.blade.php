<x-app-layout>
    <div class="max-w-lg p-6 mx-auto mt-10 bg-white shadow-lg rounded-2xl">
        <h2 class="mb-4 text-3xl font-extrabold text-blue-600">📅 Reservar Cita</h2>
        <p class="text-gray-600">Selecciona la fecha y hora para su próxima graduación.</p>

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

        <form method="POST" action="{{ route('user.reserva.store') }}" class="mt-6">
            @csrf

            <!-- Fecha -->
            <div>
                <x-input-label for="fecha_reserva" :value="__('📆 Fecha de la cita')" />
                <x-text-input id="fecha_reserva" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm"
                    type="date" name="fecha_reserva" value="{{ old('fecha_reserva') }}" required />
                <x-input-error :messages="$errors->get('fecha_reserva')" class="mt-2" />
            </div>

            <!-- Ópticas -->
            <div class="mt-4">
                <x-input-label for="optica" :value="__('👓 Centro')" />
                <select id="optica" name="optica" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
                    <option value="" disabled {{ old('optica') ? '' : 'selected' }}>Seleccione una óptica</option>
                    @foreach ($opticas as $optica)
                        <option value="{{ $optica->id }}" {{ old('optica') == $optica->id ? 'selected' : '' }}>
                            {{ $optica->nombre }} -- {{ $optica->direccion }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('optica')" class="mt-2" />
            </div>

            <!-- Periodo -->
            <div class="mt-4">
                <x-input-label for="periodo" :value="__('⏰ Periodo de la cita')" />
                <select id="periodo" name="periodo" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm" required>
                    <option value="" disabled {{ old('periodo') ? '' : 'selected' }}>Seleccione un periodo</option>
                    <option value="mañana" {{ old('periodo') == 'mañana' ? 'selected' : '' }}>Mañana</option>
                    <option value="tarde" {{ old('periodo') == 'tarde' ? 'selected' : '' }}>Tarde</option>
                </select>
                <x-input-error :messages="$errors->get('periodo')" class="mt-2" />
            </div>

            <!-- Hora Mañana -->
            <div class="mt-4" id="hora_mañana" style="display: none;">
                <x-input-label for="hora_mañana" :value="__('⏰ Hora de la cita (Mañana)')" />
                <select id="hora_mañana_select" name="hora_mañana" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    @for ($i = 10; $i <= 13; $i++)
                        @for ($j = 0; $j < 60; $j += 20)
                            <option value="{{ sprintf('%02d:%02d', $i, $j) }}" {{ old('hora_mañana') == sprintf('%02d:%02d', $i, $j) ? 'selected' : '' }}>
                                {{ sprintf('%02d:%02d', $i, $j) }}
                            </option>
                        @endfor
                    @endfor
                </select>
                <x-input-error :messages="$errors->get('hora_mañana')" class="mt-2" />
            </div>

            <!-- Hora Tarde -->
            <div class="mt-4" id="hora_tarde" style="display: none;">
                <x-input-label for="hora_tarde" :value="__('⏰ Hora de la cita (Tarde)')" />
                <select id="hora_tarde_select" name="hora_tarde" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm">
                    @for ($i = 17; $i <= 20; $i++)
                        @for ($j = 0; $j < 60; $j += 20)
                            <option value="{{ sprintf('%02d:%02d', $i, $j) }}" {{ old('hora_tarde') == sprintf('%02d:%02d', $i, $j) ? 'selected' : '' }}>
                                {{ sprintf('%02d:%02d', $i, $j) }}
                            </option>
                        @endfor
                    @endfor
                </select>
                <x-input-error :messages="$errors->get('hora_tarde')" class="mt-2" />
            </div>

            <!-- Script para mostrar la hora según el periodo -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    let periodo = document.getElementById('periodo');
                    let horaMañana = document.getElementById('hora_mañana');
                    let horaTarde = document.getElementById('hora_tarde');

                    function toggleHoras() {
                        let selected = periodo.value;
                        horaMañana.style.display = (selected === 'mañana') ? 'block' : 'none';
                        horaTarde.style.display = (selected === 'tarde') ? 'block' : 'none';
                    }

                    periodo.addEventListener('change', toggleHoras);
                    toggleHoras(); // Mantener selección si hay errores de validación
                });
            </script>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="px-6 py-3 text-lg">
                    {{ __('Reservar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
