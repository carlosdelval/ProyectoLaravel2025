<x-guest-layout>
    <!-- Estado de la sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <!-- Background Div with z-index -->
    <div
        class="absolute inset-0 h-full w-full bg-white bg-[linear-gradient(to_right,#f0f0f0_1px,transparent_1px),linear-gradient(to_bottom,#f0f0f0_1px,transparent_1px)] bg-[size:6rem_4rem] z-0">
        <div
            class="absolute bottom-0 left-0 right-0 top-0 bg-[radial-gradient(circle_800px_at_100%_200px,#d5c5ff,transparent)]">
        </div>
    </div>
    <div class="relative z-10 max-w-md p-10 bg-white shadow-xl rounded-2xl">
        <div class="flex gap-2 mb-2">
            <animated-icons
                src="https://animatedicons.co/get-icon?name=login&style=minimalistic&token=e611dfb8-fad8-4fd7-80da-af68bebdafb8"
                trigger="hover"
                attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                height="60" width="60"></animated-icons>
            <h2 class="mt-4 text-2xl font-semibold text-gray-700 ">Inicio de sesión
            </h2>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Dirección de correo electrónico -->
            <div>
                <x-input-label for="email" :value="__('Correo electrónico')" />
                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Recuérdame -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="text-indigo-600 border-gray-300 rounded shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Recuérdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3 mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
                <x-primary-button>
                    {{ __('Login') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
