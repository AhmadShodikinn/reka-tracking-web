<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelDocument;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    // Driver handling logic send SJN 
    public function showDataTravelDocument($id) {
        $suratJalan = TravelDocument::where('id', $id)->where('driver_id', auth()->id)->first();

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
}
