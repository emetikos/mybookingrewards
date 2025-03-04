<div>

    @include('shared.success-pop-up')

    <div class="flex flex-wrap justify-center mt-10 px-10 gap-2">

        <div class="w-2/3 outline-1 outline-gray-300 rounded p-4">
            <form wire:submit.prevent="submit">

                <div class="w-full flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Hotel Name*</label>
                        <select wire:model.live="hotelId" class=" w-full rounded-md bg-white outline-1 outline-gray-300  py-1.5 pr-8 pl-3 text-gray-900">
                            <option value="0">Select a Hotel </option>
                            @foreach($this->getHotels as $hotel)
                                <option value="{{ $hotel->id }}">{{$hotel->name}}</option>
                            @endforeach
                            @error('hotelId') <span class="text-red-500">{{ $message }}</span> @enderror

                        </select>
                    </div>

                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Room Type*</label>
                        <select wire:model.live="roomId" class=" w-full rounded-md bg-white outline-1 outline-gray-300  py-1.5 pr-8 pl-3 text-gray-900">
                            <option value="">Select room type </option>
                            @foreach($this->roomTypes as $rooms)
                                <option value="{{ $rooms->id }}">{{$rooms->name}}</option>
                            @endforeach
                            @error('roomId') <span class="text-red-500">{{ $message }}</span> @enderror
                        </select>
                    </div>
                </div>

                <div class="w-full flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Dates*</label>
                        @include('shared.datepicker')
                    </div>

                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Number of nights*</label>
                        <input type="number"
                               wire:model.live="nights"
                               @if(! $nights)
                                   readonly
                               @endif
                               class="w-full rounded-md bg-white outline-1 outline-gray-300 py-1.5 pl-3 pr-1 text-gray-900">
                        @error('nights') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="w-full flex gap-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Number of rooms*</label>
                        <input type="number"
                               wire:model.lazy="rooms"
                               class="w-full rounded-md bg-white outline-1 outline-gray-300 py-1.5 pl-3 pr-1 text-gray-900">
                        @error('rooms') <span class="text-red-500">{{ $message }}</span> @enderror

                    </div>

                    <div class="w-1/2">
                        <label class="block text-sm/6 font-medium text-gray-900">Number of Pax*</label>
                        <input type="number"
                               wire:model.lazy="pax"
                               class="w-full rounded-md bg-white outline-1 outline-gray-300 py-1.5 pl-3 pr-1 text-gray-900">
                        @error('pax') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="w-full grin grin-cols-1 gap-4 mb-4">

                    <label class="block text-sm/6 font-medium text-gray-900">@if($pax > 1 )Notes* @else Notes @endif</label>
                    <textarea class=" w-full rounded-md bg-white outline-1 outline-gray-300  py-1.5 pr-8 pl-3 text-gray-900"
                              wire:model.lazy="notes"
                              placeholder="Notes, e.g. additional guest names, age of children, flexible dates, room upgrade request, bedding requests, special requests, etc."
                              rows="5"></textarea>
                    @error('notes') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

            </form>

        </div>

        @if($reservation)
            <div class="w-1/3 outline-1 outline-gray-300 rounded p-4 mt-4">
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
                <p class="flex justify-center text-[#1d294f] font-bold text-2xl">Total Cost: {{$total}}USD</p>

                <button wire:click="submit" wire:loading.attr="disabled" class="bg-green-500 rounded p-2 text-white hover hover:bg-green-600 cursor-pointer">Save Booking</button>
            </div>
        @endif

        <div class="w-full outline-1 outline-gray-300 rounded p-4 mt-4">
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Hotel</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Room Type</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Check in</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Check out</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Nights</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Rooms</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Guests</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">Total</th>
                    <th class="py-2 px-4 border-b border-gray-200 text-center">View Booking</th>
                </tr>
                </thead>
                <tbody>
                @foreach($showBookings as $row)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['hotel_name']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['room_type']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['check_in']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['check_out']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['nights']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['rooms']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">{{$row['pax']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">£{{$row['total']}}</td>
                        <td class="py-2 px-4 border-b border-gray-200 text-center">
                            <button>
                                <livewire:booking-record-item :record="$row" :key="$row->id"/>
                            </button>
                        </td>

                    </tr>
                @endforeach
                </tbody>


            </table>
        </div>
    </div>


</div>
