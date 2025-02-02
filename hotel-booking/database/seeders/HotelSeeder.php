<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hotel::create(['name' => 'LuxeVista Hotel']);
        Hotel::create(['name' => 'Aura Luxe']);
        Hotel::create(['name' => 'Elevate Grand Hotel']);
        Hotel::create(['name' => 'Zenith Retreat']);
    }
}
