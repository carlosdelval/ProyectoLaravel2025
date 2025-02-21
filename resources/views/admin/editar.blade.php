<x-app-layout>
    <div class="max-w-4xl p-6 mx-auto mt-4 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-2xl font-bold text-gray-800">Editar Usuario</h2>

        @if (session('success'))
            <div class="p-3 mb-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.usuarios.update', ['user'=>$user->id]) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror">
                    @error('name')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Apellido -->
                <div>
                    <label for="surname" class="block text-sm font-medium text-gray-700">Apellido</label>
                    <input type="text" id="surname" name="surname" value="{{ old('surname', $user->surname) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 @error('surname') border-red-500 @enderror">
                    @error('surname')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Correo -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror">
                    @error('email')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="tlf" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" id="tlf" name="tlf" value="{{ old('tlf', $user->tlf) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 @error('tlf') border-red-500 @enderror">
                    @error('tlf')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- DNI -->
                <div class="md:col-span-2">
                    <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" id="dni" name="dni" value="{{ old('dni', $user->dni) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 @error('dni') border-red-500 @enderror">
                    @error('dni')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.clientes') }}">
                    <x-secondary-button>
                        Cancelar
                    </x-secondary-button>
                </a>
                <x-primary-button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Guardar Cambios
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
