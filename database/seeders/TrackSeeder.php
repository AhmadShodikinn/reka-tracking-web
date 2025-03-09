<?php

namespace Database\Seeders;

use App\Models\Track;
use App\Models\user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $driver = user::where('nip', '3')->first();

        Track::create([
            'driver_id' => $driver->id,
            'time_stamp' => now(),
            'status' => 'active',
        ]);
    }
}
