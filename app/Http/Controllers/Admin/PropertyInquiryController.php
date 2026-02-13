<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyInquiry;
use Illuminate\Http\Request;

class PropertyInquiryController extends Controller
{
    public function index()
    {
        $inquiries = PropertyInquiry::with('property')
            ->latest()
            ->paginate(20);

        return view('admin.property-inquiries.index', compact('inquiries'));
    }

    public function show(PropertyInquiry $propertyInquiry)
    {
        $propertyInquiry->load('property');

        return view('admin.property-inquiries.show', compact('propertyInquiry'));
    }

    public function updateStatus(Request $request, PropertyInquiry $propertyInquiry)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,interested,not_interested,closed',
        ]);

        $propertyInquiry->update($validated);

        return back()->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy(PropertyInquiry $propertyInquiry)
    {
        $propertyInquiry->delete();

        return redirect()->route('admin.property-inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
