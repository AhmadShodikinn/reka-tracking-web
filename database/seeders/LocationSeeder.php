<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $track = Track::first();


        $latlngs = [
            [-7.61617286255246, 111.52143728913316],
            [-7.61524762341969, 111.5217265343041],
            [-7.6144613857528025, 111.52198510197752],
            [-7.614491792740578, 111.52222175712987],
            [-7.612150446847182, 111.52305881513165],
            [-7.61200707979889, 111.52457940370928],
            [-7.612416188261747, 111.52675737515504],                          
            [-7.556593487103644, 111.55387144620585],
            [-7.556549905989811, 111.58315140744158],
        ];

        foreach ($latlngs as $latlng) {
            Location::create([
                'track_id' => $track->id,
                'latitude' => $latlng[0],
                'longitude' => $latlng[1],
                'time_stamp' => now(),
            ]);
        }
    }
}
