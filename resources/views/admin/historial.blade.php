<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-4 bg-white rounded-lg shadow-md">
        <div class="flex gap-2 mb-2">
            <animated-icons
                src="https://animatedicons.co/get-icon?name=history&style=minimalistic&token=f99ba912-a519-42fd-95a5-dc03169ceeb4"
                trigger="hover"
                attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                height="60" width="60"></animated-icons>
            <h2 class="mt-4 text-2xl font-semibold text-gray-700">Historial de citas de {{ $user->name }}
                {{ $user->surname }}</h2>
        </div>
        <!-- Mensajes de éxito/error -->
        @if (session('success'))
            <div class="p-3 my-4 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-3 my-4 text-red-800 bg-red-100 border-l-4 border-red-500 rounded-md">
                {{ session('error') }}
            </div>
        @endif
        @livewire('historial-vista-list', ['id' => $user->id])
    </div>
</x-app-layout>
