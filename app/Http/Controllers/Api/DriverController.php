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

        if (!$suratJalan) {
            return response()->json([
                'message' => 'Surat jalan tidak ditemukan.',
            ], 404);
        }

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

        $track = Track::where('driver_id', $request->driver_id)->whereHas('trackingSystems', function ($query) use ($request) {
            $query->where('travel_document_id', $request->travel_document_id);
        })->latest()->first();

        if (!$track) {
            $track = Track::create([
                'driver_id' => $request->driver_id,
                'time_stamp' => now(),
                'status' => 'active',
            ]);

            $trackingSystem = TrackingSystem::create([
                'track_id' => $track->id,
                'travel_document_id' => $request->travel_document_id,
                'time_stamp' => now(),
                'status' => 'on the way',
            ]);
        } else {
            $trackingSystem = TrackingSystem::firstOrCreate([
                'track_id' => $track->id,
                'travel_document_id' => $request->travel_document_id,
            ], [
                'time_stamp' => now(),
                'status' => 'on the way',
            ]);
        }

        $location = Location::create([
            'track_id' => $track->id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'time_stamp' => now(),
        ]);

        // Kembalikan respons sukses
        return response()->json([
            'message' => 'Lokasi berhasil dikirim kepada sistem!.',
            'tracking_system' => $trackingSystem,
            'location' => $location,
        ], 201);
    }

    //update status send SJN
    public function updateStatusSendSJN(Request $request) {
        $request->validate([
            'id' => 'required|exists:travel_document,id',
            'status' => 'required|in:active',
        ]);

        $trackingSystem = TrackingSystem::where('travel_document_id', $request->id)->latest()->first();

        if (!$trackingSystem) {
            return response()->json([
                'message' => 'Tracking system tidak ditemukan.',
            ], 404);
        }

        if ($request->status === 'active') {
            if ($trackingSystem->status === 'non-active') {
                $trackingSystem->update([
                    'status' => 'active',
                ]);
    
                return response()->json([
                    'message' => 'Status tracking system berhasil diubah menjadi active.',
                    'tracking_system' => $trackingSystem,
                ]);
            } else {
                return response()->json([
                    'message' => 'Status tracking system sudah dalam kondisi active.',
                ], 400);
            }
        }

        if ($request->status === 'non-active') {
            if ($trackingSystem->status === 'active') {
                $trackingSystem->update([
                    'status' => 'non-active',
                ]);
    
                return response()->json([
                    'message' => 'Status tracking system berhasil diubah menjadi non-active.',
                    'tracking_system' => $trackingSystem,
                ]);
            } else {
                return response()->json([
                    'message' => 'Status tracking system sudah dalam kondisi non-active.',
                ], 400);
            }
        }

        return response()->json([
            'message' => 'Status tidak valid.',
        ], 400);
    }
}
