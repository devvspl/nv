<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkProcessController extends Controller
{
    public function index()
    {
        $workProcesses = WorkProcess::orderBy('display_order')->paginate(10);
        return view('admin.work-processes.index', compact('workProcesses'));
    }

    public function create()
    {
        return view('admin.work-processes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('work-processes', 'public');
        }

        WorkProcess::create($validated);

        return redirect()->route('admin.work-processes.index')
            ->with('success', 'Work process step created successfully.');
    }

    public function show(WorkProcess $workProcess)
    {
        return view('admin.work-processes.show', compact('workProcess'));
    }

    public function edit(WorkProcess $workProcess)
    {
        return view('admin.work-processes.edit', compact('workProcess'));
    }

    public function update(Request $request, WorkProcess $workProcess)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'step_number' => 'required|integer|min:1',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp|max:2048',
            'display_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon')) {
            // Delete old icon
            if ($workProcess->icon) {
                Storage::disk('public')->delete($workProcess->icon);
            }
            $validated['icon'] = $request->file('icon')->store('work-processes', 'public');
        }

        $workProcess->update($validated);

        return redirect()->route('admin.work-processes.index')
            ->with('success', 'Work process step updated successfully.');
    }

    public function destroy(WorkProcess $workProcess)
    {
        if ($workProcess->icon) {
            Storage::disk('public')->delete($workProcess->icon);
        }

        $workProcess->delete();

        return redirect()->route('admin.work-processes.index')
            ->with('success', 'Work process step deleted successfully.');
    }

    public function toggleStatus(WorkProcess $workProcess)
    {
        $workProcess->update(['is_active' => !$workProcess->is_active]);

        return redirect()->route('admin.work-processes.index')
            ->with('success', 'Status updated successfully.');
    }
}
