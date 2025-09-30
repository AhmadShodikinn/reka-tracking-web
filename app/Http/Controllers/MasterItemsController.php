<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use Illuminate\Http\Request;

class MasterItemsController extends Controller
{
    public function index()
    {
        $masterItems = MasterItem::paginate(10);
        return view('General.items', compact('masterItems'));
    }

    public function create()
    {
        return view('General.items-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code' => 'required|unique:master_items,item_code',
            'item_name' => 'required',
            'description' => 'nullable',
        ]);

        MasterItem::create([
            'item_code' => $validated['item_code'],
            'item_name' => $validated['item_name'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan.');
    }

    public function edit(MasterItem $masterItem)
    {
        return view('General.items-edit', compact('masterItem'));
    }

    public function update(Request $request, MasterItem $masterItem)
    {
        $validated = $request->validate([
            'item_code' => 'required|unique:master_items,item_code,' . $masterItem->id,
            'item_name' => 'required',
            'description' => 'nullable',
        ]);

        $masterItem->update($validated);

        return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui.');
    }

    public function destroy(MasterItem $masterItem)
    {
        $masterItem->delete();

        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus.');
    }

}
