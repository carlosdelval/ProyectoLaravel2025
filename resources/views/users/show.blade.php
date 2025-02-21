<x-app-layout>
    <div class="max-w-6xl p-6 mx-auto mt-4 bg-white shadow-lg rounded-2xl">
        <div class="flex gap-2 mb-2">
            <animated-icons
                src="https://animatedicons.co/get-icon?name=history&style=minimalistic&token=f99ba912-a519-42fd-95a5-dc03169ceeb4"
                trigger="hover"
                attributes='{"variationThumbColour":"#536DFE","variationName":"Two Tone","variationNumber":2,"numberOfGroups":2,"backgroundIsGroup":false,"strokeWidth":1,"defaultColours":{"group-1":"#000000","group-2":"#536DFE","background":"#FFFFFF"}}'
                height="60" width="60"></animated-icons>
            <h2 class="mt-4 text-2xl font-semibold text-gray-700">Tu historial de graduaciones, {{ Auth::user()->name }}</h2>
        </div>
        @livewire('historial-vista-list')
    </div>
</x-app-layout>
