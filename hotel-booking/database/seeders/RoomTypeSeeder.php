<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hotel #1
        RoomType::create([
            'hotel_id' => 1,
            'name' => 'Single',
            'room_night_cost' => 100.00,
        ]);
        RoomType::create([
            'hotel_id' => 1,
            'name' => 'Standard',
            'room_night_cost' => 150.00,
        ]);
        RoomType::create([
            'hotel_id' => 1,
            'name' => 'Double',
            'room_night_cost' => 220.00,
        ]);

        // Hotel #2
        RoomType::create([
            'hotel_id' => 2,
            'name' => 'Double',
            'room_night_cost' => 220.00,
        ]);
        RoomType::create([
            'hotel_id' => 2,
            'name' => 'Deluxe',
            'room_night_cost' => 220.00,
        ]);

        // Hotel #3
        RoomType::create([
            'hotel_id' => 3,
            'name' => 'Single',
            'room_night_cost' => 50.00,
        ]);
        RoomType::create([
            'hotel_id' => 3,
            'name' => 'Standard',
            'room_night_cost' => 110.00,
        ]);
        RoomType::create([
            'hotel_id' => 3,
            'name' => 'Double',
            'room_night_cost' => 200.00,
        ]);
        RoomType::create([
            'hotel_id' => 3,
            'name' => 'Deluxe',
            'room_night_cost' => 250.00,
        ]);

        // Hotel #4
        RoomType::create([
            'hotel_id' => 4,
            'name' => 'Suite',
            'room_night_cost' => 500.00,
        ]);
        RoomType::create([
            'hotel_id' => 4,
            'name' => 'Presidential Suite',
            'room_night_cost' => 1000.00,
        ]);
    }
}
