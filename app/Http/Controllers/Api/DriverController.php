<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Track;
use App\Models\TrackingSystem;
use App\Models\TravelDocument;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    // public function __construct()
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum');
    // }
    
    // Driver handling logic send SJN 
    public function showDataTravelDocument($id) {
        $suratJalan = TravelDocument::where('id', $id)->with(['items'])->first();

        // Jika tidak ditemukan, kembalikan respons error
        if (!$suratJalan) {
            return response()->json([
                'message' => 'Surat jalan tidak ditemukan.',
            ], 404);
        }

        // Jika ditemukan, kembalikan data surat jalan
        return response()->json([
            'data' => $suratJalan,
        ]);
    }

    // Driver handling logic send location
    public function sendLocation(Request $request) {
        $request->validate([
            'travel_document_id' => 'required|exists:travel_document,id',
            'latitude' => 'required',
            'longitude' => 'required',
            'driver_id' => 'required',
        ]);

        $track = Track::create([
            'driver_id' => $request->driver_id,
            'time_stamp' => now(),
            'status' => 'active',
        ]);

        $location = Location::create([
            'track_id' => $track->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'time_stamp' => now(),
        ]);

        $trackingSystem = TrackingSystem::create([
            'track_id' => $track->id,
            'travel_document_id' => $request->travel_document_id,
            'time_stamp' => now(),
            'status' => 'active',
        ]);

        // Kembalikan respons sukses
        return response()->json([
            'message' => 'Lokasi berhasil dikirim kepada sistem!.',
            'tracking_system' => $trackingSystem,
            'location' => $location,
        ], 201);
    }
}
