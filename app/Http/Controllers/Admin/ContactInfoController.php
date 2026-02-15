<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contactInfos = ContactInfo::ordered()->paginate(10);
        return view('admin.contact-info.index', compact('contactInfos'));
    }

    public function create()
    {
        return view('admin.contact-info.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_key' => 'required|string|unique:contact_info,section_key',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('contact-icons', 'public');
        }

        ContactInfo::create($validated);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact information created successfully.');
    }

    public function edit(ContactInfo $contactInfo)
    {
        return view('admin.contact-info.edit', compact('contactInfo'));
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $validated = $request->validate([
            'section_key' => 'required|string|unique:contact_info,section_key,' . $contactInfo->id,
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon')) {
            if ($contactInfo->icon) {
                Storage::disk('public')->delete($contactInfo->icon);
            }
            $validated['icon'] = $request->file('icon')->store('contact-icons', 'public');
        }

        $contactInfo->update($validated);

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact information updated successfully.');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        if ($contactInfo->icon) {
            Storage::disk('public')->delete($contactInfo->icon);
        }

        $contactInfo->delete();

        return redirect()->route('admin.contact-info.index')
            ->with('success', 'Contact information deleted successfully.');
    }
}
