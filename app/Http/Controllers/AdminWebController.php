<?php

namespace App\Http\Controllers;

use App\Models\TrackingSystem;
use App\Models\TravelDocument;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminWebController extends Controller
{
    // Admin handling management SJN
    public function shippingsIndex() {
        $listTravelDocument = TravelDocument::paginate(10);

        return view('General.shippings', compact('listTravelDocument')); //set view
    }

    public function shippingsDetail($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);

        return view('General.shippings-detail', compact('travelDocument')); //set view
    }

    public function shippingsAdd() {
        return view('General.shippings-add'); //set view
    }

    public function shippingsEdit($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);

        return view('General.shippings-edit', compact('travelDocument')); //set view
    }

    public function shippingsUpdate(Request $request, $id){

        // dd($request->all());

        $validated = $request->validate([
            'sendTo' => 'required',
            'numberSJN' => 'required',
            'numberRef' => 'required',
            'projectName' => 'required',
            'poNumber' => 'required',

            'itemCode.*' => 'required',
            'itemName.*' => 'required',
            'quantitySend.*' => 'required',
            'totalSend.*' => 'required',
            'qtyPreOrder.*' => 'required',
            'unitType.*' => 'required',
            'description.*' => 'required',
            'information.*' => 'nullable',
        ]);

        // dd($validated);

        $travelDocument = TravelDocument::findOrFail($id);

        $travelDocument->update([
            'no_travel_document' => $validated['numberSJN'],
            'send_to' => $validated['sendTo'],
            'reference_number' => $validated['numberRef'],
            'po_number' => $validated['poNumber'],
            'project' => $validated['projectName'],
            'status' => 'belum terkirim',
        ]);

        // Hapus semua item lama
        $travelDocument->items()->delete();

        // Tambah ulang item dari form
        $items = [];
        foreach ($validated['itemCode'] as $key => $itemCode) {
            $items[] = [
                'travel_document_id' => $travelDocument->id,
                'item_code' => $itemCode,
                'item_name' => $validated['itemName'][$key],
                'qty_send' => $validated['quantitySend'][$key],
                'total_send' => $validated['totalSend'][$key],
                'qty_po' => $validated['qtyPreOrder'][$key],
                'unit' => $validated['unitType'][$key],
                'description' => $validated['description'][$key],
                'information' => $validated['information'][$key],
            ];
        }

        $travelDocument->items()->createMany($items);

        return redirect()->route('shippings.index')->with('success', 'Data pengiriman berhasil diperbarui.');
    }

    public function shippingsDelete($id) {
        $travelDocument = TravelDocument::findOrFail($id);

        foreach ($travelDocument->items as $item) {
            $item->delete();
        }
        $travelDocument->delete();

        return redirect()->route('shippings.index')->with('success', 'Data berhasil dihapus.');
    }


    // Detail SJN and list item by SJN ID
    public function showDetail($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);

        return view('detail', compact('travelDocument')); //set view
    }

    // Create SJN
    public function shippingsAddTravelDocument(Request $request) {
        $validated = $request->validate([
            'sendTo' => 'required',
            'numberSJN' => 'required',
            'numberRef' => 'required',
            'projectName' => 'required',
            'poNumber' => 'required',

            'itemCode.*' => 'required',
            'itemName.*' => 'required',
            'quantitySend.*' => 'required',
            'totalSend.*' => 'required',
            'qtyPreOrder.*' => 'required',
            'unitType.*' => 'required',
            'description.*' => 'required',
            'information.*' => 'required',
        ]);

        $travelDocument = TravelDocument::create([
            'no_travel_document' => $validated['numberSJN'],
            'date_no_travel_document' => now(),
            'send_to' => $validated['sendTo'],
            'reference_number' => $validated['numberRef'],
            'po_number' => $validated['poNumber'],
            'project' => $validated['projectName'],
            'status' => 'belum terkirim',
        ]);

        $items = [];
        foreach ($validated['itemCode'] as $key => $itemCode) {
            $items[] = [
                'travel_document_id' => $travelDocument->id,
                'item_code' => $itemCode,
                'item_name' => $validated['itemName'][$key],
                'qty_send' => $validated['quantitySend'][$key],
                'total_send' => $validated['totalSend'][$key],
                'qty_po' => $validated['qtyPreOrder'][$key],
                'unit' => $validated['unitType'][$key],
                'description' => $validated['description'][$key],
                'information' => $validated['information'][$key],
            ];
        }

        $travelDocument->items()->createMany($items);

        return redirect()->route('shippings.index')->with('success', 'Data pengiriman berhasil ditambahkan.');
    }

    // Print SJN
    public function printShippings($id){
        $travelDocument = TravelDocument::with('items')->findOrFail($id);
        // $qrCode = QrCode::format('svg')->size(200)->generate($id);

        $qrCode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($id));

        // dd($qrCode);

        $pdf = PDF::loadView('General.shippings-print', compact('travelDocument', 'qrCode'));
        // $pdf->setOptions([
        //     'isHtml5ParserEnabled' => true,
        //     'isRemoteEnabled' => true,
        // ]);
    
        // $pdf->setPaper('A4', 'portrait');
    
        return $pdf->stream();

        // return $pdf->download('shipping_'.$id.'.pdf');
        return view('General.shippings-print', compact('travelDocument', 'qrCode'));
    }

    public function showTracker($track_id)
    {
        // Ambil data TrackingSystem berdasarkan track_id
        $trackingSystem = TrackingSystem::with('track') // Mengambil relasi Track
            ->where('track_id', $track_id)
            ->firstOrFail();

        // Ambil data lokasi dari TrackingSystem yang terkait dengan track_id
        $locations = TrackingSystem::where('track_id', $track_id)
            ->get(['latitude', 'longitude']); // Ambil hanya kolom latitude dan longitude

        // Ambil koordinat awal peta berdasarkan lokasi pertama
        $initialLocation = $locations->isNotEmpty() ? [$locations[0]->latitude, $locations[0]->longitude] : [0, 0];

        return view('General.tracker', compact('trackingSystem', 'locations', 'initialLocation'));
    }


    public function search(Request $request)
    {
        // dd($request->all());
        $noTravelDocument = $request->query('no_travel_document');

        // Mencari TravelDocument berdasarkan nomor surat jalan
        $travelDocument = TravelDocument::where('no_travel_document', $noTravelDocument)
            ->with(['trackingSystems.track.locations'])
            ->first();

        if ($travelDocument) {
            // Ambil lokasi dari tracking system
            $locations = [];
            foreach ($travelDocument->trackingSystems as $trackingSystem) {
                foreach ($trackingSystem->track->locations as $location) {
                    $locations[] = [
                        'latitude' => $location->latitude,
                        'longitude' => $location->longitude,
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'locations' => $locations,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Travel Document tidak ditemukan',
        ]);
    }




}
