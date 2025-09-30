<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::paginate(10);
        return view('General.partners', compact('partners'));
    }

    public function create()
    {
        return view('General.partners-add');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePartner($request);

        Partner::create([
            'contact_name'   => $validated['company_name'],
            'company_name'   => $validated['company_name'],
            'company_email'  => $validated['company_email'],
            'company_phone'  => $validated['company_phone'],
            'company_address'=> $validated['company_address'] ?? null,
        ]);

        return redirect()->route('partners.index')->with('success', 'Partner berhasil ditambahkan.');
    }

    public function edit(Partner $partner)
    {
        return view('General.partners-edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $this->validatePartner($request, $partner->id);

        $partner->update([
            'contact_name'   => $validated['company_name'],
            'company_name'   => $validated['company_name'],
            'company_email'  => $validated['company_email'],
            'company_phone'  => $validated['company_phone'],
            'company_address'=> $validated['company_address'] ?? null,
        ]);

        return redirect()->route('partners.index')->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner berhasil dihapus.');
    }

    protected function validatePartner(Request $request, $partnerId = null)
    {
        $uniqueSuffix = $partnerId ? ',' . $partnerId : '';

        return $request->validate([
            'contact_name' => 'required|string|max:255',
            'company_name'   => 'required|string|max:255|unique:partners,company_name' . $uniqueSuffix,
            'company_email'  => 'required|email|unique:partners,company_email' . $uniqueSuffix,
            'company_phone'  => 'required|string|unique:partners,company_phone' . $uniqueSuffix,
            'company_address'=> 'nullable|string|max:255',
        ]);
    }
}
