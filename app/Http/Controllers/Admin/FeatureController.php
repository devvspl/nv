<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of features.
     */
    public function index()
    {
        $features = Feature::ordered()->paginate(10);
        return view('admin.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new feature.
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created feature in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'icon_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'tag' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // Handle icon upload
        if ($request->hasFile('icon_upload')) {
            $data['icon_upload'] = $request->file('icon_upload')->store('features/icons', 'public');
        }

        Feature::create($data);

        return redirect()->route('admin.features.index')
            ->with('success', 'Feature created successfully.');
    }

    /**
     * Display the specified feature.
     */
    public function show(Feature $feature)
    {
        return view('admin.features.show', compact('feature'));
    }

    /**
     * Show the form for editing the specified feature.
     */
    public function edit(Feature $feature)
    {
        return view('admin.features.edit', compact('feature'));
    }

    /**
     * Update the specified feature in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'icon_upload' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'remove_icon_upload' => ['nullable', 'boolean'],
            'tag' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        // Handle icon upload removal
        if ($request->remove_icon_upload && $feature->icon_upload) {
            \Storage::disk('public')->delete($feature->icon_upload);
            $data['icon_upload'] = null;
        }

        // Handle new icon upload
        if ($request->hasFile('icon_upload')) {
            // Delete old icon if exists
            if ($feature->icon_upload) {
                \Storage::disk('public')->delete($feature->icon_upload);
            }
            $data['icon_upload'] = $request->file('icon_upload')->store('features/icons', 'public');
        }

        $feature->update($data);

        return redirect()->route('admin.features.index')
            ->with('success', 'Feature updated successfully.');
    }

    /**
     * Remove the specified feature from storage.
     */
    public function destroy(Feature $feature)
    {
        // Delete uploaded icon if exists
        if ($feature->icon_upload) {
            \Storage::disk('public')->delete($feature->icon_upload);
        }
        
        $feature->delete();

        return redirect()->route('admin.features.index')
            ->with('success', 'Feature deleted successfully.');
    }

    /**
     * Toggle feature status
     */
    public function toggleStatus(Feature $feature)
    {
        $feature->update(['is_active' => !$feature->is_active]);

        $status = $feature->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.features.index')
            ->with('success', "Feature {$status} successfully.");
    }
}
