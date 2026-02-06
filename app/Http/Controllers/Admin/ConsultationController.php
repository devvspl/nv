<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the consultations.
     */
    public function index(Request $request)
    {
        $query = Consultation::latest();
        
        // Apply status filter if provided
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        // Apply priority filter if provided
        if ($request->filled('priority') && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }
        
        $consultations = $query->paginate(15);
        
        // Preserve query parameters in pagination links
        $consultations->appends($request->query());
        
        return view('admin.consultations.index', compact('consultations'));
    }

    /**
     * Display the specified consultation.
     */
    public function show(Consultation $consultation)
    {
        return view('admin.consultations.show', compact('consultation'));
    }

    /**
     * Update the consultation status.
     */
    public function updateStatus(Request $request, Consultation $consultation)
    {
        $request->validate([
            'status' => 'required|in:pending,contacted,in_progress,completed,cancelled',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'admin_notes' => 'nullable|string|max:1000',
            'assigned_to' => 'nullable|string|max:255',
        ]);

        $updateData = [
            'status' => $request->status
        ];

        // Set contacted_at timestamp when status changes to contacted
        if ($request->status === 'contacted' && $consultation->status !== 'contacted') {
            $updateData['contacted_at'] = now();
        }

        // Update other fields if provided
        if ($request->filled('priority')) {
            $updateData['priority'] = $request->priority;
        }

        if ($request->filled('admin_notes')) {
            $updateData['admin_notes'] = $request->admin_notes;
        }

        if ($request->filled('assigned_to')) {
            $updateData['assigned_to'] = $request->assigned_to;
        }

        $consultation->update($updateData);

        return redirect()->back()->with('success', 'Consultation updated successfully.');
    }

    /**
     * Remove the specified consultation from storage.
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();
        
        return redirect()->route('admin.consultations.index')
            ->with('success', 'Consultation deleted successfully.');
    }
}