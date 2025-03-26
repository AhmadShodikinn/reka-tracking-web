<?php

namespace App\Http\Controllers;

use App\Models\TravelDocument;
use Illuminate\Http\Request;

class AdminWebController extends Controller
{
    // Admin handling management SJN
    public function shippingsIndex() {
        $listTravelDocument = TravelDocument::all();

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

        return view('General.shippings.edit', compact('travelDocument')); //set view
    }

    public function shippingsDelete($id) {
        $travelDocument = TravelDocument::findOrFail($id);
        $travelDocument->items()->delete();
        $travelDocument->delete();

        //ntah hal baik atau buruk

        return redirect()->route('shippings.index');
    }


    // Detail SJN and list item by SJN ID
    public function showDetail($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);

        return view('detail', compact('travelDocument')); //set view
    }

    // Create SJN
    public function shippingsAddTravelDocument(Request $request) {
        // dd($request->all());
        // dd($request->input('itemCode[]'));

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
    }

    // Print SJN
    public function printShippings($id){
        $travelDocument = TravelDocument::findOrFail($id);

        return view('General.shippings-print', compact('travelDocument'));
    }




}
