<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $aboutUs = AboutUs::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.about-us.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.about-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'mission_text' => 'required|string',
            'checklist_items' => 'nullable|array',
            'checklist_items.*' => 'nullable|string|max:255',
            'stats' => 'nullable|array',
            'stats.*.value' => 'nullable|string|max:50',
            'stats.*.label' => 'nullable|string|max:255',
            'stats.*.prefix' => 'nullable|string|max:10',
            'stats.*.suffix' => 'nullable|string|max:10',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Filter out empty checklist items
        if (isset($validated['checklist_items'])) {
            $validated['checklist_items'] = array_filter($validated['checklist_items'], function($item) {
                return !empty(trim($item));
            });
            $validated['checklist_items'] = array_values($validated['checklist_items']); // Re-index array
        }

        // Filter out empty stats
        if (isset($validated['stats'])) {
            $validated['stats'] = array_filter($validated['stats'], function($stat) {
                return !empty(trim($stat['value'] ?? '')) && !empty(trim($stat['label'] ?? ''));
            });
            $validated['stats'] = array_values($validated['stats']); // Re-index array
        }

        AboutUs::create($validated);

        return redirect()->route('admin.about-us.index')
            ->with('success', 'About Us entry created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs): View
    {
        return view('admin.about-us.show', compact('aboutUs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs): View
    {
        return view('admin.about-us.edit', compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutUs): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'mission_text' => 'required|string',
            'checklist_items' => 'nullable|array',
            'checklist_items.*' => 'nullable|string|max:255',
            'stats' => 'nullable|array',
            'stats.*.value' => 'nullable|string|max:50',
            'stats.*.label' => 'nullable|string|max:255',
            'stats.*.prefix' => 'nullable|string|max:10',
            'stats.*.suffix' => 'nullable|string|max:10',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Filter out empty checklist items
        if (isset($validated['checklist_items'])) {
            $validated['checklist_items'] = array_filter($validated['checklist_items'], function($item) {
                return !empty(trim($item));
            });
            $validated['checklist_items'] = array_values($validated['checklist_items']); // Re-index array
        }

        // Filter out empty stats
        if (isset($validated['stats'])) {
            $validated['stats'] = array_filter($validated['stats'], function($stat) {
                return !empty(trim($stat['value'] ?? '')) && !empty(trim($stat['label'] ?? ''));
            });
            $validated['stats'] = array_values($validated['stats']); // Re-index array
        }

        $aboutUs->update($validated);

        return redirect()->route('admin.about-us.index')
            ->with('success', 'About Us entry updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs): RedirectResponse
    {
        $aboutUs->delete();

        return redirect()->route('admin.about-us.index')
            ->with('success', 'About Us entry deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(AboutUs $aboutUs): RedirectResponse
    {
        $aboutUs->update(['status' => !$aboutUs->status]);

        $status = $aboutUs->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "About Us entry {$status} successfully.");
    }
}