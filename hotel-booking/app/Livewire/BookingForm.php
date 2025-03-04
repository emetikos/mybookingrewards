<?php

namespace App\Livewire;

use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\RoomType;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BookingForm extends Component
{
    public $hotelId;

    public $roomId;

    public $dates;

    public $nights;

    public $rooms;

    public $pax;

    public $notes;

    private static function getDateRange(array $reservationDates): array
    {
        $datesToPrint = [];
        $range = self::getReservationNightsRange($reservationDates);

        foreach ($range as $date) {
            $datesToPrint[] = $date->format('d M Y');
        }

        return $datesToPrint;
    }

    private function getReservationDates(): array
    {
        if (strpos($this->dates, 'to')) {
            $dateArr = explode(' to ', $this->dates);

            return [
                'checkIn' => Carbon::parse($dateArr[0]),
                'checkOut' => Carbon::parse($dateArr[1]),
            ];
        }

        return [];
    }

    private function getReservationData($roomType, $datesToPrint): array
    {
        $dataArr = [];
        for ($i = 0; $i < $this->nights; $i++) {
            $dataArr[] = [
                'Date' => $datesToPrint[$i] ?? null,
                'Details' => $this->rooms.(($this->rooms > 1) ? ' rooms' : ' room').' * '.$roomType->room_night_cost.' USD',
                'Daily Total' => $this->rooms * $roomType->room_night_cost.' USD',
            ];
        }

        return $dataArr;
    }

    private static function getReservationNightsRange($reservationDates): CarbonPeriod
    {
        return CarbonPeriod::create($reservationDates['checkIn'], $reservationDates['checkOut']->subDay());
    }

    private static function getReservationNights($reservationDates): int
    {
        return $reservationDates['checkIn']->diffInDays($reservationDates['checkOut']);
    }

    protected function rules(): array
    {
        return [
            'hotelId' => 'required|exists:hotels,id',
            'roomId' => 'required|string',
            'nights' => 'required|integer|min:1|max:7',
            'rooms' => 'required|integer|min:1|max:2',
            'pax' => 'required|integer|min:1|max:5',
        ];
    }

    #[Computed]
    public function getHotels()
    {
        return Hotel::all();
    }

    #[Computed]
    public function roomTypes()
    {
        if ($this->hotelId) {
            return RoomType::where('hotel_id', $this->hotelId)->get();
        }

        return [];
    }

    public function submit()
    {
        $this->validate();
        $hotel = Hotel::where('id', $this->hotelId)->first();
        $roomType = $hotel->types->where('id', $this->roomId)->first();
        $reservationDates = self::getReservationDates();

        Reservation::create([
            'hotel_name' => $hotel->name,
            'room_type' => $roomType->name,
            'check_in' => $reservationDates['checkIn'],
            'check_out' => $reservationDates['checkOut'],
            'nights' => $this->nights,
            'rooms' => $this->rooms,
            'pax' => $this->pax,
            'total' => $this->rooms * $roomType->room_night_cost * $this->nights,
        ]);

        $this->reset();
        $this->dispatch('success');
    }

    public function render()
    {
        $reservation = [];
        $datesToPrint = [];
        $bookingSummery = null;

        $reservationDates = self::getReservationDates();

        if ($reservationDates) {
            $this->nights = self::getReservationNights($reservationDates);

            $datesToPrint = self::getDateRange($reservationDates);
        }

        $roomType = RoomType::where('id', $this->roomId)->first();

        if ($roomType) {
            $reservation = self::getReservationData($roomType, $datesToPrint);
            $bookingSummery = $this->rooms * $roomType->room_night_cost * $this->nights;
        }

        return view('livewire.booking-form')->with([
            'reservation' => $reservation,
            'bookingSummery' => $bookingSummery,
            'showBookings' => Reservation::all(),
        ]);
    }
}
