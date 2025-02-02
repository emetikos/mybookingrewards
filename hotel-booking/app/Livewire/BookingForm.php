<?php

namespace App\Livewire;

use App\Models\Hotel;
use App\Models\RoomType;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Livewire\Component;

class BookingForm extends Component
{
    public $hotels;
    public $hotelId;

    public $roomId;
    public $nights;

    public $pax;

    public int $rooms;
    public $notes;
    public $reservation;
    public int|float $total;

    public $booking = false;

    public $datesToPrint = [];

    protected $listeners = ['updateDate'];

    public function boot()
    {
        $this->hotels = Hotel::all();
        $this->total = 0;
    }

    public function updateDate($data)
    {
        $dates = explode(' to ', $data);

        $this->nights = Carbon::parse($dates[0])->diffInDays(Carbon::parse($dates[1]));

        $range = CarbonPeriod::create(Carbon::parse($dates[0])->format('d M Y'), Carbon::parse($dates[1])->subDay()->format('d M Y'));

        $this->datesToPrint = [];

        foreach ($range as $date) {
            $this->datesToPrint[] = $date->format('d M Y');
        }
    }

    public function roomTypes()
    {
        return RoomType::where('hotel_id', $this->hotelId)->get();
    }

    public function submit()
    {
        $rules = [
            'hotelId' => 'required',
            'roomId' => 'required',
            'nights' => 'required|max:7',
            'rooms' => 'required|min:1|max:2',
            'pax' => 'required|min:1|max:5',
        ];

        if ($this->pax > 1) {
            $rules['notes'] = 'required';
        }

        $this->validate($rules);

        $roomType = RoomType::where('id', $this->roomId)->first();

        if ($roomType){
            $this->reservation = [];

            for ($i = 0; $i < $this->nights; $i++) {
                $this->reservation[] = [
                    'Date' => $this->datesToPrint[$i],
                    'Details' => $this->rooms . (($this->rooms > 1) ? ' rooms' : ' room') . ' * ' . $roomType->room_night_cost . ' USD',
                    'Daily Total' => $this->rooms * $roomType->room_night_cost. ' USD'
                ];
            }

            $this->total = $this->rooms * $roomType->room_night_cost * $this->nights;
            $this->booking = true;
        }
    }
    public function render()
    {
        return view('livewire.booking-form');
    }
}
