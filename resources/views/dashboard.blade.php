<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-4 bg-white shadow-lg rounded-2xl">
        <!-- Tabla de citas -->
        <div class="">
            @if (auth()->user()->role === "admin" && auth()->user()->unreadNotifications->count() > 0)
                <div class="p-4 bg-yellow-100 rounded-lg">
                    <h2 class="text-lg font-bold">Notificaciones</h2>
                    <ul>
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <li class="p-2 border-b">
                                {{ $notification->data['message'] }} para {{ $notification->data['usuario'] }} el día
                                {{ $notification->data['fecha'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
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

            @livewire('citas-programadas')
        </div>
    </div>
</x-app-layout>
