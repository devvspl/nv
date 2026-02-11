<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function index(): View
    {
        $locations = Location::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.locations.index', compact('locations'));
    }

    public function create(): View
    {
        return view('admin.locations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:locations,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        Location::create($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Location created successfully.');
    }

    public function show(Location $location): View
    {
        return view('admin.locations.show', compact('location'));
    }

    public function edit(Location $location): View
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:locations,slug,' . $location->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $location->update($validated);

        return redirect()->route('admin.locations.index')
            ->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location): RedirectResponse
    {
        $location->delete();

        return redirect()->route('admin.locations.index')
            ->with('success', 'Location deleted successfully.');
    }

    public function toggleStatus(Location $location): RedirectResponse
    {
        $location->update(['status' => !$location->status]);

        $status = $location->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Location {$status} successfully.");
    }
}
