<nav x-data="{ open: false }"
    class="relative z-10 bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <flux:brand href="{{ route('dashboard') }}"
                        logo="https://static.vecteezy.com/system/resources/thumbnails/029/198/768/small/eye-icon-design-free-png.png"
                        name="OptiClick" class="dark:hidden" />
                    <flux:brand href="{{ route('dashboard') }}"
                        logo="https://static.vecteezy.com/system/resources/thumbnails/029/198/768/small/eye-icon-design-free-png.png"
                        name="OptiClick" class="max-lg:hidden! hidden dark:flex" />
                </div>

                <flux:navbar class="space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <flux:navbar.item :href="route('dashboard')" class="max-lg:hidden" current>
                        <div class="flex gap-2">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                            </svg>Inicio
                        </div>
                    </flux:navbar.item>
                    @if (Auth::user()->role == 'user')
                        <flux:navbar.item :href="route('users.show', ['user' => Auth::user()-> id])"
                            class="max-sm:hidden">
                            <div class="flex gap-2">
                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                                </svg>
                                Mis datos
                            </div>
                        </flux:navbar.item>
                        <flux:navbar.item :href="route('user.reserva')" class="max-sm:hidden">
                            <div class="flex gap-2">
                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 8v4l3 3M3.22302 14C4.13247 18.008 7.71683 21 12 21c4.9706 0 9-4.0294 9-9 0-4.97056-4.0294-9-9-9-3.72916 0-6.92858 2.26806-8.29409 5.5M7 9H3V5" />
                                </svg>
                                Reservar cita
                            </div>
                        </flux:navbar.item>
                    @else
                        <flux:navbar.item :href="route('admin.clientes')" :current="request()-> is('/')"
                            class="max-sm:hidden">
                            <div class="flex gap-2">
                                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                                </svg>
                                Listado clientes
                            </div>
                        </flux:navbar.item>
                    @endif
                </flux:navbar>
            </div>

            @auth
                @php
                    $notificaciones = auth()->user()->unreadNotifications;
                @endphp
                @if ($notificaciones->isNotEmpty())
                    <div class="relative sm:-my-px sm:ms-10 max-sm:hidden sm:flex" x-data="{ open: false }">
                        <button @click="open = !open" class="relative">
                            <animated-icons
                                src="https://animatedicons.co/get-icon?name=notification&style=minimalistic&token=2a8c285f-a7a0-4f4d-b2c3-acccc136c454"
                                trigger="hover"
                                attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                                height="30" width="30">
                            </animated-icons>
                            <span
                                class="absolute -top-0 -right-1 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                {{ $notificaciones->count() }}
                            </span>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute left-0 z-20 w-64 mt-2 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
                            <div
                                class="p-2 text-sm font-bold text-gray-800 border-b dark:text-gray-200 dark:border-gray-700">
                                Notificaciones
                            </div>
                            <ul class="overflow-y-auto max-h-60">
                                @forelse ($notificaciones as $notificacion)
                                    <li
                                        class="flex justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        @if (Auth()->user()->role === 'user')
                                            <span>{{ $notificacion->data['mensaje'] }}</span>
                                            <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}"
                                                class="text-xs text-blue-500">
                                                Ver
                                            </a>
                                        @else
                                            <span>{{ $notificacion->data['message'] }} para
                                                {{ $notificacion->data['usuario'] }}
                                                el día {{ $notificacion->data['fecha'] }}</span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        No tienes notificaciones.
                                    </li>
                                @endforelse
                            </ul>
                            <div class="p-2 text-center border-t dark:border-gray-700">
                                <button wire:click="marcarNotificacionesLeidas" class="text-xs text-blue-500">
                                    Marcar todas como leídas
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <flux:dropdown position="top" align="start">
                    <flux:menu.item icon="user-circle">{{ Auth::user()->name }}
                    </flux:menu.item>

                    <flux:menu>
                        <flux:menu.item :href="route('profile.edit')" icon="pencil-square">Mi perfil
                        </flux:menu.item>

                        <flux:menu.separator></flux:menu.separator>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <flux:menu.item icon="arrow-right-start-on-rectangle" :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                Cerrar sesión</flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
        </div>
        @if (Auth::user()->role == 'user')
            <div class="pt-2 pb-3 space-y-11">
                <x-responsive-nav-link :href="route('users.show', ['user' => Auth::user()->id])" :active="request()->routeIs('users.show')">
                    {{ __('Mis datos') }}
                </x-responsive-nav-link>
            </div>
            <div class="pt-2 pb-3 space-y-11">
                <x-responsive-nav-link :href="route('user.reserva')" :active="request()->routeIs('user.reserva')">
                    {{ __('Reservar cita') }}
                </x-responsive-nav-link>
            </div>
        @elseif (Auth::user()->role == 'admin')
            <div class="pt-2 pb-3 space-y-11">
                <x-responsive-nav-link :href="route('admin.clientes')" :active="request()->routeIs('admin.clientes.show')" :active="request()->routeIs('admin.clientes')">
                    {{ __('Listado Clientes') }}
                </x-responsive-nav-link>
            </div>
        @endif

        <!-- Notificaciones Responsivas -->
        <div class="px-4 pt-4 border-t border-gray-200 dark:border-gray-600" x-data="{ open: false }">
            <button @click="open = !open"
                class="flex items-center justify-between w-full text-gray-700 dark:text-gray-300">
                <div class="flex items-center gap-2">
                    <animated-icons
                        src="https://animatedicons.co/get-icon?name=notification&style=minimalistic&token=2a8c285f-a7a0-4f4d-b2c3-acccc136c454"
                        trigger="hover"
                        attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                        height="30" width="30">
                    </animated-icons>
                    <span>Notificaciones</span>
                </div>
                <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                    {{ $notificaciones->count() }}
                </span>
            </button>

            <!-- Dropdown de notificaciones -->
            <div x-show="open" @click.away="open = false"
                class="mt-2 overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
                <ul class="overflow-y-auto text-sm max-h-60">
                    @forelse ($notificaciones as $notificacion)
                        <li
                            class="flex justify-between px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            @if (Auth()->user()->role === 'user')
                                <span>{{ $notificacion->data['mensaje'] }}</span>
                                <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}"
                                    class="text-xs text-blue-500">
                                    Ver
                                </a>
                            @else
                                <span>{{ $notificacion->data['message'] }} para
                                    {{ $notificacion->data['usuario'] }}
                                    el día {{ $notificacion->data['fecha'] }}</span>
                            @endif
                        </li>
                    @empty
                        <li class="px-4 py-2 text-gray-500 dark:text-gray-400">
                            No tienes notificaciones.
                        </li>
                    @endforelse
                </ul>
                <div class="p-2 text-center border-t dark:border-gray-700">
                    <button wire:click="marcarNotificacionesLeidas" class="text-xs text-blue-500">
                        Marcar todas como leídas
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

    @fluxScripts
</nav>
