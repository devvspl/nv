<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index(Request $request)
    {
        $query = Inquiry::latest();
        
        // Apply status filter if provided
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        $inquiries = $query->paginate(15);
        
        // Preserve query parameters in pagination links
        $inquiries->appends($request->query());
        
        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Display the specified inquiry.
     */
    public function show(Inquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Update inquiry status
     */
    public function updateStatus(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:pending,responded,in_progress,closed'
        ]);

        $inquiry->update(['status' => $request->status]);

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry status updated successfully.');
    }

    /**
     * Remove the specified inquiry from storage.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
