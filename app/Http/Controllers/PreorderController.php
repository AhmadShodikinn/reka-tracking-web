<?php

namespace App\Http\Controllers;

use App\Models\MasterItem;
use App\Models\Partner;
use App\Models\Preorder;
use App\Models\Projects;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreorderController extends Controller
{
    public function index()
    {
        $preorders = Preorder::with(['partner','project'])->paginate(10);
        return view('General.preorders', compact('preorders'));
    }

    public function create()
    {
        $partners = Partner::all();
        $projects = Projects::all();
        $units = Unit::all();
        $masterItems = MasterItem::all();

        return view('General.preorders-add', compact('partners', 'projects', 'units', 'masterItems'));
    }

    public function store(Request $request)
    {
        $attributes = [];

        foreach ($request->input('master_item_id', []) as $key => $value) {
            $attributes["master_item_id.$key"] = 'Kode Barang baris' . ($key + 1);
        }
        foreach (['unit_id' => 'Satuan', 'qty_po' => 'Qty PO', 'information' => 'Informasi'] as $field => $label) {
            foreach ($request->input($field, []) as $key => $value) {
                $attributes["$field.$key"] = "$label baris " . ($key + 1);
            }
        }

        $messages = [
            'partner_id.required' => 'Partner harus diisi.',
            'project_id.required' => 'Proyek harus diisi.',
            'po_number.required' => 'Nomor PO harus diisi.',
            'po_number.unique' => 'Nomor PO sudah digunakan.',

            'master_item_id.*.required' => ':attribute harus diisi.',
            'unit_id.*.required' => ':attribute harus diisi.',
            'qty_po.*.required' => ':attribute harus diisi.',
        ];

        $rules = [
            'partner_id' => 'required|exists:partners,id',
            'project_id' => 'required|exists:projects,id',
            'po_number' => 'required|unique:preorders,po_number',

            'master_item_id.*' => 'required|exists:master_items,id',
            'unit_id.*' => 'required|exists:units,id',
            'qty_po.*' => 'required|numeric|min:1',
            'information.*' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $validated = $validator->validated();

        $preorder = Preorder::create([
            'partner_id' => $validated['partner_id'],
            'project_id' => $validated['project_id'],
            'po_number' => $validated['po_number'],
        ]);

        $preorderItems = [];
        foreach ($validated['master_item_id'] as $key => $masterItemId) {
            $preorderItems[] = [
                'preorder_id' => $preorder->id,
                'master_item_id' => $masterItemId,
                'unit_id' => $validated['unit_id'][$key],
                'qty_po' => $validated['qty_po'][$key],
                'information' => $validated['information'][$key] ?? null,
            ];
        }

        $preorder->items()->createMany($preorderItems);

        return redirect()->route('preorders.index')->with('success', 'Preorder berhasil ditambahkan.');
    }

    public function showDetailPreorder($id) {
        $preorder = Preorder::with(['partner', 'project', 'items.masterItem', 'items.unit'])
            ->findOrFail($id);

        return view('General.preorders-detail', compact('preorder'));
    }

    public function edit($id)
    {
        $preorder = Preorder::with(['items.masterItem', 'items.unit'])->findOrFail($id);

        $partners = Partner::all();
        $projects = Projects::all();
        $units = Unit::all();
        $masterItems = MasterItem::all();

        $itemsMapped = $preorder->items->map(function ($item) {
            return [
                'masterItemId' => $item->masterItem->id ?? '',
                'itemCode' => $item->masterItem->item_code ?? '',
                'itemName' => $item->masterItem->item_name ?? '',
                'description' => $item->masterItem->description ?? '',
                'unitType' => $item->unit_id ?? '-',
                'qtyPreOrder' => $item->qty_po,
                'information' => $item->information,
            ];
        });

        return view('General.preorders-edit', [
            'preorder' => $preorder,
            'partners' => $partners,
            'projects' => $projects,
            'units' => $units,
            'masterItems' => $masterItems,
            'itemsMapped' => $itemsMapped,
        ]);
    }

    public function update(Request $request, $id)
    {
        $attributes = [];

        foreach ($request->input('master_item_id', []) as $key => $value) {
            $attributes["master_item_id.$key"] = 'Kode Barang baris ' . ($key + 1);
        }
        foreach (['unit_id' => 'Satuan', 'qty_po' => 'Qty PO', 'information' => 'Informasi'] as $field => $label) {
            foreach ($request->input($field, []) as $key => $value) {
                $attributes["$field.$key"] = "$label baris " . ($key + 1);
            }
        }

        $messages = [
            'partner_id.required' => 'Partner harus diisi.',
            'project_id.required' => 'Proyek harus diisi.',
            'po_number.required' => 'Nomor PO harus diisi.',
            'po_number.unique' => 'Nomor PO sudah digunakan.',

            'master_item_id.*.required' => ':attribute harus diisi.',
            'unit_id.*.required' => ':attribute harus diisi.',
            'qty_preorder.*.required' => ':attribute harus diisi.',
        ];

        $rules = [
            'partner_id' => 'required|exists:partners,id',
            'project_id' => 'required|exists:projects,id',
            'po_number' => 'required|unique:preorders,po_number,' . $id,

            'master_item_id.*' => 'required|exists:master_items,id',
            'unit_id.*' => 'required|exists:units,id',
            'qty_preorder.*' => 'required|numeric|min:1',
            'information.*' => 'nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $validated = $validator->validated();

        $preorder = Preorder::findOrFail($id);
        $preorder->update([
            'partner_id' => $validated['partner_id'],
            'project_id' => $validated['project_id'],
            'po_number' => $validated['po_number'],
        ]);

        $preorder->items()->delete();

        $items = [];
        foreach ($validated['master_item_id'] as $key => $masterItemId) {
            $items[] = [
                'preorder_id' => $preorder->id,
                'master_item_id' => $masterItemId,
                'unit_id' => $validated['unit_id'][$key],
                'qty_po' => $validated['qty_preorder'][$key],
                'information' => $validated['information'][$key] ?? null,
            ];
        }

        $preorder->items()->createMany($items);

        return redirect()->route('preorders.index')->with('success', 'Preorder berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $preorder = Preorder::findOrFail($id);
        $preorder->items()->delete();
        $preorder->delete();

        return redirect()->route('preorders.index')->with('success', 'Preorder berhasil dihapus.');
    }





}
