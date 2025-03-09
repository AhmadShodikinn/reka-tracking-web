<?php

namespace Database\Seeders;

use App\Models\Track;
use App\Models\TrackingSystem;
use App\Models\TravelDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackingSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $track = Track::first();
        $travelDocument = TravelDocument::first();

        // Menambahkan Tracking System
        TrackingSystem::create([
            'track_id' => $track->id,
            'travel_document_id' => $travelDocument->id,
            'time_stamp' => now(),
            'status' => 'active',
        ]);
    }
}
