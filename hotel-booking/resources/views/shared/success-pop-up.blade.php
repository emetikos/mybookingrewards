<div class="w-full flex justify-end pr-4">
    <div x-data="{ show: false }"
        x-cloak
        x-show="show"
        x-transition.duration.500ms
        @success.window="show = true; setTimeout(() => show = false, 3000)"
        class="w-1/10 flex rounded border shadow-lg p-6 mt-4 absolute justify-center bg-green-100 text-green-500 font-bold">
    Booking Created
</div>
</div>
