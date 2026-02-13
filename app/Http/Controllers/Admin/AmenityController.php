<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::withCount('properties')
            ->orderBy('category')
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'category' => 'required|in:basic,security,recreation,convenience,eco_friendly',
            'status' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Amenity::create($validated);

        return redirect()->route('admin.amenities.index')
            ->with('success', 'Amenity created successfully.');
    }

    public function show(Amenity $amenity)
    {
        $amenity->load(['properties' => function($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.amenities.show', compact('amenity'));
    }

    public function edit(Amenity $amenity)
    {
        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:100',
            'category' => 'required|in:basic,security,recreation,convenience,eco_friendly',
            'status' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $amenity->update($validated);

        return redirect()->route('admin.amenities.index')
            ->with('success', 'Amenity updated successfully.');
    }

    public function destroy(Amenity $amenity)
    {
        if ($amenity->properties()->count() > 0) {
            return back()->with('error', 'Cannot delete amenity with associated properties.');
        }

        $amenity->delete();

        return redirect()->route('admin.amenities.index')
            ->with('success', 'Amenity deleted successfully.');
    }

    public function toggleStatus(Amenity $amenity)
    {
        $amenity->update(['status' => !$amenity->status]);

        return back()->with('success', 'Amenity status updated successfully.');
    }
}
