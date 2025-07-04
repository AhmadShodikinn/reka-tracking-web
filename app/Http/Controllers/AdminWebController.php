<?php

namespace App\Http\Controllers;

use App\Models\TrackingSystem;
use App\Models\TravelDocument;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminWebController extends Controller
{
    // Admin handling management SJN
    public function shippingsIndex() {
        $listTravelDocument = TravelDocument::paginate(10);

        return view('General.shippings', compact('listTravelDocument')); 
    }


    public function searchDocument(Request $request){
    $query = $request->query('search');

    $results = TravelDocument::where('no_travel_document', 'like', "%$query%")
        ->orWhere('send_to', 'like', "%$query%")
        ->orWhere('status', 'like', "%$query%")
        ->orWhere('project', 'like', "%$query%")
        ->orderBy('id', 'desc')
        ->get(); 

        return response()->json(['results' => $results]);
    }


    public function shippingsDetail($id) {
        $travelDocument = TravelDocument::with(['items.unit'])->findOrFail($id);
        return view('General.shippings-detail', compact('travelDocument'));
    }

    public function shippingsAdd() {
        $units = Unit::all();
        return view('General.shippings-add', compact('units'));
    }

    public function shippingsEdit($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);
        $units = Unit::all();

        return view('General.shippings-edit', compact('travelDocument', 'units'));
    }

    public function shippingsUpdate(Request $request, $id){
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

        $travelDocument = TravelDocument::findOrFail($id);

        $travelDocument->update([
            'no_travel_document' => $validated['numberSJN'],
            'send_to' => $validated['sendTo'],
            'reference_number' => $validated['numberRef'],
            'po_number' => $validated['poNumber'],
            'project' => $validated['projectName'],
            'status' => 'belum terkirim',
        ]);

        $travelDocument->items()->delete();

        $items = [];
        foreach ($validated['itemCode'] as $key => $itemCode) {
            $items[] = [
                'travel_document_id' => $travelDocument->id,
                'item_code' => $itemCode,
                'item_name' => $validated['itemName'][$key],
                'qty_send' => $validated['quantitySend'][$key],
                'total_send' => $validated['totalSend'][$key],
                'qty_po' => $validated['qtyPreOrder'][$key],
                'unit_id' => $validated['unitType'][$key],
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


    public function showDetail($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);

        return view('detail', compact('travelDocument')); 
    }

    public function shippingsAddTravelDocument(Request $request) {
        $attributes = [];

        foreach ($request->input('itemCode', []) as $key => $value) {
            $attributes["itemCode.$key"] = 'Kode barang baris ' . ($key + 1);
        }
        foreach ($request->input('itemName', []) as $key => $value) {
            $attributes["itemName.$key"] = 'Nama barang baris ' . ($key + 1);
        }
        foreach ($request->input('quantitySend', []) as $key => $value) {
            $attributes["quantitySend.$key"] = 'Jumlah kirim baris ' . ($key + 1);
        }
        foreach ($request->input('totalSend', []) as $key => $value) {
            $attributes["totalSend.$key"] = 'Total kirim baris ' . ($key + 1);
        }
        foreach ($request->input('qtyPreOrder', []) as $key => $value) {
            $attributes["qtyPreOrder.$key"] = 'Qty PO baris ' . ($key + 1);
        }
        foreach ($request->input('unitType', []) as $key => $value) {
            $attributes["unitType.$key"] = 'Satuan baris ' . ($key + 1);
        }
        foreach ($request->input('description', []) as $key => $value) {
            $attributes["description.$key"] = 'Deskripsi baris ' . ($key + 1);
        }
        foreach ($request->input('information', []) as $key => $value) {
            $attributes["information.$key"] = 'Informasi baris ' . ($key + 1);
        }

        $messages = [
            'sendTo.required' => 'Tujuan pengiriman harus diisi.',
            'numberSJN.required' => 'Nomor SJN harus diisi.',
            'numberRef.required' => 'Nomor referensi harus diisi.',
            'projectName.required' => 'Nama proyek harus diisi.',
            'poNumber.required' => 'Nomor PO harus diisi.',

            'itemCode.*.required' => ':attribute harus diisi.',
            'itemName.*.required' => ':attribute harus diisi.',
            'quantitySend.*.required' => ':attribute harus diisi.',
            'totalSend.*.required' => ':attribute harus diisi.',
            'qtyPreOrder.*.required' => ':attribute harus diisi.',
            'unitType.*.required' => ':attribute harus diisi.',
            'description.*.required' => ':attribute harus diisi.',
            // 'information.*.required' => ':attribute harus diisi.',
        ];

        $rules = [
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
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();


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
                'unit_id' => $validated['unitType'][$key],
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

        $qrString = "SJNID:" . $id;
        $qrCode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($qrString));
        $pdf = PDF::loadView('General.shippings-print', compact('travelDocument', 'qrCode'));

        return $pdf->stream();

        return view('General.shippings-print', compact('travelDocument', 'qrCode'));
    }

    public function showTracker($track_id)
    {
        $trackingSystem = TrackingSystem::with('track') 
            ->where('track_id', $track_id)
            ->firstOrFail();

        $locations = TrackingSystem::where('track_id', $track_id)
            ->get(['latitude', 'longitude']);

        $initialLocation = $locations->isNotEmpty() ? [$locations[0]->latitude, $locations[0]->longitude] : [0, 0];

        return view('General.tracker', compact('trackingSystem', 'locations', 'initialLocation'));
    }


  public function search(Request $request)
    {
        $noTravelDocument = $request->query('no_travel_document');

        $travelDocument = TravelDocument::where('no_travel_document', $noTravelDocument)
            ->with(['trackingSystems.track.locations'])
            ->first();

        if (!$travelDocument) {
            return redirect()->back()->with('error', 'Travel Document tidak ditemukan');
        }

        $locations = [];

        foreach ($travelDocument->trackingSystems as $trackingSystem) {
            foreach ($trackingSystem->track->locations as $location) {
                $locations[] = [
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude,
                ];
            }
        }

        if (empty($locations)) {
            return redirect()->back()->with('error', 'Lokasi tidak ditemukan');
        }

        // Jika berhasil dan ada lokasi
        return response()->json([
            'success' => true,
            'locations' => $locations,
        ]);
    }


    public function track(Request $request){
        if ($request->has(['status', 'message'])) {
            session()->flash($request->status, $request->message);
        }

        return view('General.tracker'); 
    }




}
