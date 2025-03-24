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


    // Detail SJN and list item by SJN ID
    public function showDetail($id) {
        $travelDocument = TravelDocument::with('items')->findOrFail($id);

        return view('detail', compact('travelDocument')); //set view
    }

    // Create SJN
    public function shippingsAddTravelDocument(Request $request) {
        dd($request->all());
        // dd($request->input('itemCode[]'));

       
    }


}
