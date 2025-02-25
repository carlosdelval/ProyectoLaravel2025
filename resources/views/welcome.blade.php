<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a OptiClick</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://animatedicons.co/scripts/embed-animated-icons.js"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="max-w-md p-10 text-center bg-white shadow-xl rounded-2xl">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <a href="{{ route('dashboard') }}"><x-application-logo
                    class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" /></a>
        </div>
        <div class="mb-4 text-center">
            <h1 class="text-2xl font-bold leading-none tracking-tight text-gray-700 underline md:text-5xl lg:text-6xl dark:text-white underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">OptiClick</h1>
            <p class="mt-2 text-gray-600">Tu sistema de gestión de citas ópticas</p>
        </div>
        <a href="{{ route('login') }}" <x-primary-button class="w-full mt-10 bg-blue-600 hover:bg-blue-700">
            Iniciar sesión
            </x-primary-button>
        </a>
        <p class="mt-4 text-sm text-gray-500">¿No tienes cuenta? <a href="{{ route('register') }}"
                class="font-bold text-blue-500 hover:underline">Regístrate aquí</a></p>
    </div>
</body>

</html>
