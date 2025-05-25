<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Track;
use App\Models\TrackingSystem;
use App\Models\TravelDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function showTravelDocuments(){
        $suratJalanList = TravelDocument::with('items')->get();

        return response()->json([
            'data' => $suratJalanList,
        ]);
    }
    
    public function showDetailTravelDocument($id) {
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
        ]);

        $user = Auth::user();
        $driverId = $user->id;

        $responses = [];

        foreach ($request->travel_document_id as $documentId) {
            $track = Track::where('driver_id', $driverId)
                ->whereHas('trackingSystems', function ($query) use ($documentId) {
                    $query->where('travel_document_id', $documentId);
                })->latest()->first();

            // Jika track tidak ada, buat baru dan set status menjadi aktif
            if (!$track) {
                $track = Track::create([
                    'driver_id' => $driverId,
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

                if ($track->status !== 'active') {
                    $track->update(['status' => 'active']);
                }
            }

            // Simpan lokasi
            Location::create([
                'track_id' => $track->id,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'time_stamp' => now(),
            ]);

            TravelDocument::where('id', $documentId)->update([
                'status' => 'sedang_dikirim',
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
    public function updateStatusSendSJN(Request $request) {
        $request->validate([
            'travel_document_id' => 'required|array',
            'travel_document_id.*' => 'exists:travel_document,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $responses = [];

        foreach ($request->travel_document_id as $documentId) {
            // Ambil TrackingSystem terbaru
            $trackingSystem = TrackingSystem::where('travel_document_id', $documentId)
                ->orderBy('time_stamp', 'desc')
                ->first();

            if (!$trackingSystem) {
                $responses[] = [
                    'travel_document_id' => $documentId,
                    'message' => 'Tracking system tidak ditemukan.',
                    'status' => 'error',
                ];
                continue;
            }

            if ($trackingSystem->status === 'non-active') {
                $responses[] = [
                    'travel_document_id' => $documentId,
                    'message' => 'Status sudah non-active.',
                    'status' => 'non-active',
                ];
                continue;
            }

            // Update status TrackingSystem
            $trackingSystem->update([
                'status' => 'non-active',
                'time_stamp' => now(),
            ]);

            // Simpan lokasi terakhir ke table Location (jika track tersedia)
            if ($trackingSystem->track) {
                $track = $trackingSystem->track;

                Location::create([
                    'track_id' => $trackingSystem->track->id,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'time_stamp' => now(),
                ]);

                $allNonActive = $track->trackingSystems()->where('status', '!=', 'non-active')->count() === 0;

                if ($allNonActive && $track->status !== 'non-active') {
                    $track->update(['status' => 'non-active']);
                }
            }

            $responses[] = [
                'travel_document_id' => $documentId,
                'message' => 'Status berhasil diubah menjadi non-active dan lokasi disimpan.',
                'status' => 'success',
            ];
            
        }

        return response()->json([
            'message' => 'Permintaan update status selesai diproses.',
            'results' => $responses,
        ]);
    }

    public function completeDelivery(Request $request){
        $request->validate([
            'travel_document_id' => 'required|array',
            'travel_document_id.*' => 'exists:travel_document,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $responses = [];

        foreach ($request->travel_document_id as $travelDocumentId) {
            $tracking = Track::whereHas('trackingSystems', function ($query) use ($travelDocumentId) {
                $query->where('travel_document_id', $travelDocumentId);
            })->latest()->first();

            if (!$tracking) {
                $responses[] = [
                    'travel_document_id' => $travelDocumentId,
                    'message' => 'Tracking tidak ditemukan',
                ];
                continue;
            }

            $tracking->update(['status' => 'non-active']);

            $travelDocument = TravelDocument::find($travelDocumentId);
            $travelDocument->update(['status' => 'terkirim']);

            $responses[] = [
                'travel_document_id' => $travelDocumentId,
                'tracking_status' => $tracking->status,
                'travel_document_status' => $travelDocument->status,
                'message' => 'Berhasil',
            ];
        }

        return response()->json([
            'message' => 'Proses penyelesaian pengiriman selesai.',
            'data' => $responses,
        ]);
    }






}
