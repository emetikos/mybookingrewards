<div class="flex flex-wrap justify-center mt-10">

        <div class="w-2/3 outline-1 outline-gray-300 rounded p-4">
            <form wire:submit.prevent="submit">

                <div class="w-full flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Hotel Name*</label>
                            <select wire:model.live="hotelId" class=" w-full rounded-md bg-white outline-1 outline-gray-300  py-1.5 pr-8 pl-3 text-gray-900">
                                <option value="">Select a Hotel </option>
                                @foreach($this->hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{$hotel->name}}</option>
                                @endforeach
                                @error('hotelId') <span class="text-red-500">{{ $message }}</span> @enderror

                            </select>
                    </div>

                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Room Type*</label>
                            <select wire:model="roomId" class=" w-full rounded-md bg-white outline-1 outline-gray-300  py-1.5 pr-8 pl-3 text-gray-900">
                                <option value="">Select room type </option>
                                @foreach($this->roomTypes() as $rooms)
                                    <option value="{{ $rooms->id }}">{{$rooms->name}}</option>
                                @endforeach
                                @error('roomId') <span class="text-red-500">{{ $message }}</span> @enderror
                            </select>
                    </div>
                </div>

                <div class="w-full flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Dates*</label>
                        @include('picker')
                        @error('nights') <span class="text-red-500">Please select a date range</span> @enderror
                    </div>

                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Number of nights*</label>
                        <input type="number"
                               value="{{$this->nights}}"
                               readonly
                               class="w-full rounded-md bg-white outline-1 outline-gray-300 py-1.5 pl-3 pr-1 text-gray-900">
                        @error('nights') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="w-full flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Number of rooms*</label>
                        <input type="number"
{{--                               min="1"--}}
{{--                               max="2"--}}
                               wire:model="rooms"
                               class="w-full rounded-md bg-white outline-1 outline-gray-300 py-1.5 pl-3 pr-1 text-gray-900">
                        @error('rooms') <span class="text-red-500">{{ $message }}</span> @enderror

                    </div>

                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Number of Pax*</label>
                        <input type="number"
{{--                               min="1"--}}
{{--                               max="5"--}}
                               wire:model="pax"
                               class="w-full rounded-md bg-white outline-1 outline-gray-300 py-1.5 pl-3 pr-1 text-gray-900">
                        @error('pax') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>


                    <div class="w-full grin grin-cols-1 gap-4 mb-4">

                        <label class="block text-sm/6 font-medium text-gray-900">@if($pax > 1 )Notes* @else Notes @endif</label>
                        <textarea wire:model="notes" class=" w-full rounded-md bg-white outline-1 outline-gray-300  py-1.5 pr-8 pl-3 text-gray-900" rows="5"></textarea>
                        @error('notes') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>


                <button wire:click="submit" wire:loading.attr="disabled" class="bg-green-500 rounded p-2 text-white hover hover:bg-green-600 cursor-pointer">Save Booking</button>
            </form>
        </div>


@if($this->booking)
        <div class="w-2/3 outline-1 outline-gray-300 rounded p-4 mt-4">
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Date</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Details</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Daily Total</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($reservation as $row)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['Date']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['Details']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['Daily Total']}}</td>
                    </tr>
                    @endforeach
                </tbody>


            </table>
            <p class="flex justify-center text-[#1d294f] font-bold text-2xl">Total Cost: {{$this->total}}</p>
        </div>
    @endif



</div>

{{--<div>--}}
{{--    <p>Received Value: {{ $this->chosenDate }}</p>--}}
{{--    <button wire:click="save" class="bg-green-500 rounded p-2 text-white hover hover:bg-green-600 cursor-pointer">Save Booking</button>--}}
{{--    <script>--}}
{{--        --}}
{{--        document.addEventListener('livewire:init', () => {--}}
{{--            Livewire.dispatch('handleValue');--}}

{{--            console.log({ value: "value" })--}}
{{--        });--}}
{{--    </script>--}}
{{--</div>--}}
