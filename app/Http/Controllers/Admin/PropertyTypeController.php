<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PropertyTypeController extends Controller
{
    public function index(): View
    {
        $propertyTypes = PropertyType::withCount('serviceTypes')->orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.property-types.index', compact('propertyTypes'));
    }

    public function create(): View
    {
        $serviceTypes = ServiceType::active()->ordered()->get();
        return view('admin.property-types.create', compact('serviceTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:residential,commercial',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
            'service_types' => 'nullable|array',
            'service_types.*' => 'exists:service_types,id',
        ]);

        // Auto-generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        $propertyType = PropertyType::create($validated);

        // Sync service types
        if ($request->has('service_types')) {
            $propertyType->serviceTypes()->sync($request->service_types);
        }

        return redirect()->route('admin.property-types.index')
            ->with('success', 'Property Type created successfully.');
    }

    public function show(PropertyType $propertyType): View
    {
        $propertyType->load('serviceTypes');
        return view('admin.property-types.show', compact('propertyType'));
    }

    public function edit(PropertyType $propertyType): View
    {
        $serviceTypes = ServiceType::active()->ordered()->get();
        $propertyType->load('serviceTypes');
        return view('admin.property-types.edit', compact('propertyType', 'serviceTypes'));
    }

    public function update(Request $request, PropertyType $propertyType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:residential,commercial',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
            'service_types' => 'nullable|array',
            'service_types.*' => 'exists:service_types,id',
        ]);

        // Auto-generate slug from name
        $validated['slug'] = Str::slug($validated['name']);

        $propertyType->update($validated);

        // Sync service types
        $propertyType->serviceTypes()->sync($request->service_types ?? []);

        return redirect()->route('admin.property-types.index')
            ->with('success', 'Property Type updated successfully.');
    }

    public function destroy(PropertyType $propertyType): RedirectResponse
    {
        $propertyType->serviceTypes()->detach();
        $propertyType->delete();

        return redirect()->route('admin.property-types.index')
            ->with('success', 'Property Type deleted successfully.');
    }

    public function toggleStatus(PropertyType $propertyType): RedirectResponse
    {
        $propertyType->update(['status' => !$propertyType->status]);

        $status = $propertyType->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Property Type {$status} successfully.");
    }
}
