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

    // Detail SJN and list item by SJN ID
    public function showDetail($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);

        return view('detail', compact('travelDocument')); //set view
    }

    // Create SJN
    public function store(Request $request) {
        $validatedData = $request->validate([
            'no_travel_document' => 'required|string|unique:travel_document',
            'date_no_travel_document' => 'required|date',
            'send_to' => 'required|string',
            'po_number' => 'required|string',
            'reference_number' => 'required|string',
            'project' => 'required|string',
            'status' => 'required|string',
            'items' => 'required|array|max:10',  //MAX ITEMS CARRIED BY SJN IS 10
            'items.*.item_code' => 'required|string',
            'items.*.item_name' => 'required|string',
            'items.*.qty_send' => 'required|integer',
            'items.*.total_send' => 'required|integer',
            'items.*.qty_po' => 'required|integer',
            'items.*.description' => 'nullable|string',
        ]);

        $travelDocument = TravelDocument::create([
            'no_travel_document' => $validatedData['no_travel_document'],
            'date_no_travel_document' => $validatedData['date_no_travel_document'],
            'send_to' => $validatedData['send_to'],
            'po_number' => $validatedData['po_number'],
            'reference_number' => $validatedData['reference_number'],
            'project' => $validatedData['project'],
            'status' => $validatedData['status'],
        ]);

        foreach ($validatedData['items'] as $itemList) {
            $travelDocument->items()->create([
                'item_code' => $itemList['item_code'],
                'item_name' => $itemList['item_name'],
                'qty_send' => $itemList['qty_send'],
                'total_send' => $itemList['total_send'],
                'qty_po' => $itemList['qty_po'],
                'description' => $itemList['description'],
            ]);
        }

        return redirect()->route('dashboard'); //set view
    }

}
