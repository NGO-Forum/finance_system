<?php

namespace App\Http\Controllers;

use App\Models\DonorLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonorLogoController extends Controller
{
    public function index()
    {
        $logos = DonorLogo::latest()->get();

        return view('donor_logos.index', compact('logos'));
    }

    public function create()
    {
        return view('donor_logos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);

        $logo = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('donor-logos', 'public');
        }

        DonorLogo::create([
            'name' => $request->name,
            'logo' => $logo,
        ]);

        return redirect()
            ->route('donor-logos.index')
            ->with('success', 'Donor logo created successfully.');
    }

    public function edit(DonorLogo $donorLogo)
    {
        return view('donor_logos.edit', compact('donorLogo'));
    }

    public function update(Request $request, DonorLogo $donorLogo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);

        $logo = $donorLogo->logo;

        if ($request->hasFile('logo')) {

            if ($logo && Storage::disk('public')->exists($logo)) {
                Storage::disk('public')->delete($logo);
            }

            $logo = $request->file('logo')->store('donor-logos', 'public');
        }

        $donorLogo->update([
            'code' => $request->code,
            'logo' => $logo,
        ]);

        return redirect()
            ->route('donor-logos.index')
            ->with('success', 'Donor logo updated successfully.');
    }

    public function destroy(DonorLogo $donorLogo)
    {
        if ($donorLogo->logo && Storage::disk('public')->exists($donorLogo->logo)) {
            Storage::disk('public')->delete($donorLogo->logo);
        }

        $donorLogo->delete();

        return redirect()
            ->route('donor-logos.index')
            ->with('success', 'Donor logo deleted successfully.');
    }
}
