<?php

namespace Database\Seeders;

use App\Models\TimeZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $timeZones = [
            ['name' => 'Madrid', 'offset' => '+01:00'],
            ['name' => 'Mexico City', 'offset' => '-06:00'],
            ['name' => 'United Kingdom', 'offset' => '+00:00'],
            // Add more time zones as needed
        ];

        foreach ($timeZones as $timeZone) {
            TimeZone::create([
                'name' => $timeZone['name'],
                'offset' => $timeZone['offset'],
            ]);
        }
    }
}
