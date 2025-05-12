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

    // pada db masing menggunakan track id untuk bagian ini
    public function sendLocation(Request $request)
    {
        $request->validate([
            'travel_document_id' => 'required|array',
            'travel_document_id.*' => 'exists:travel_document,id',
            'latitude' => 'required',
            'longitude' => 'required',
            'driver_id' => 'required',
        ]);

        $responses = [];

        foreach ($request->travel_document_id as $documentId) {
            $track = Track::where('driver_id', $request->driver_id)
                ->whereHas('trackingSystems', function ($query) use ($documentId) {
                    $query->where('travel_document_id', $documentId);
                })->latest()->first();

            // Jika track tidak ada, buat baru dan set status menjadi aktif
            if (!$track) {
                $track = Track::create([
                    'driver_id' => $request->driver_id,
                    'time_stamp' => now(),
                    'status' => 'active',
                ]);

                // Buat Tracking System baru
                TrackingSystem::create([
                    'track_id' => $track->id,
                    'travel_document_id' => $documentId,
                    'time_stamp' => now(),
                    'status' => 'active',
                ]);
            } else {
                // Update status jika sudah ada
                TrackingSystem::updateOrCreate(
                    [
                        'track_id' => $track->id,
                        'travel_document_id' => $documentId,
                    ],
                    [
                        'time_stamp' => now(),
                        'status' => 'active',
                    ]
                );
            }

            // Simpan lokasi
            Location::create([
                'track_id' => $track->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'time_stamp' => now(),
            ]);

            $responses[] = [
                'track_id' => $track->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => 'active',
            ];
        }

        return response()->json([
            'message' => 'Lokasi berhasil dikirim kepada sistem untuk semua dokumen!',
            'data' => $responses,
        ], 201);
    }


    // Update status tracking system untuk banyak dokumen
    public function updateStatusSendSJN(Request $request)
    {
        $request->validate([
            'travel_document_id' => 'required|array',
            'travel_document_id.*' => 'exists:travel_document,id',
        ]);

        $responses = [];

        foreach ($request->travel_document_id as $documentId) {
            // Ambil tracking system terbaru berdasarkan travel_document_id
            $trackingSystem = TrackingSystem::where('travel_document_id', $documentId)
                ->orderBy('time_stamp', 'desc')
                ->first();

            if (!$trackingSystem) {
                $responses[] = [
                    'travel_document_id' => $documentId,
                    'message' => 'Tracking system tidak ditemukan.',
                    'status' => 'error',
                ];
            }

            if ($trackingSystem->status === 'non-active') {
                $responses[] = [
                    'travel_document_id' => $documentId,
                    'message' => 'Status sudah non-active.',
                    'status' => 'warning',
                ];
            }

            // Update status menjadi non-active
            $trackingSystem->update([
                'status' => 'non-active',
                'time_stamp' => now(),
            ]);

            // // Opsional: juga nonaktifkan track terkait jika ingin menghentikan pelacakan
            // if ($trackingSystem->track && $trackingSystem->track->status !== 'non-active') {
            //     $trackingSystem->track->update([
            //         'status' => 'non-active',
            //     ]);
            // }

            $responses[] = [
                'travel_document_id' => $documentId,
                'message' => 'Status berhasil diubah menjadi non-active.',
                'status' => 'success',
            ];
        }

        return response()->json([
            'message' => 'Permintaan update status selesai diproses.',
            'results' => $responses,
        ]);
    }





}
