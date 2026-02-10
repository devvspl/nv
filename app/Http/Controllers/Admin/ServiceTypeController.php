<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ServiceTypeController extends Controller
{
    public function index(): View
    {
        $serviceTypes = ServiceType::withCount('propertyTypes')->orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.service-types.index', compact('serviceTypes'));
    }

    public function create(): View
    {
        $propertyTypes = PropertyType::active()->ordered()->get();
        return view('admin.service-types.create', compact('propertyTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_types,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
            'property_types' => 'nullable|array',
            'property_types.*' => 'exists:property_types,id',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $serviceType = ServiceType::create($validated);

        // Sync property types
        if ($request->has('property_types')) {
            $serviceType->propertyTypes()->sync($request->property_types);
        }

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service Type created successfully.');
    }

    public function show(ServiceType $serviceType): View
    {
        $serviceType->load('propertyTypes');
        return view('admin.service-types.show', compact('serviceType'));
    }

    public function edit(ServiceType $serviceType): View
    {
        $propertyTypes = PropertyType::active()->ordered()->get();
        $serviceType->load('propertyTypes');
        return view('admin.service-types.edit', compact('serviceType', 'propertyTypes'));
    }

    public function update(Request $request, ServiceType $serviceType): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_types,slug,' . $serviceType->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
            'property_types' => 'nullable|array',
            'property_types.*' => 'exists:property_types,id',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $serviceType->update($validated);

        // Sync property types
        $serviceType->propertyTypes()->sync($request->property_types ?? []);

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service Type updated successfully.');
    }

    public function destroy(ServiceType $serviceType): RedirectResponse
    {
        $serviceType->propertyTypes()->detach();
        $serviceType->delete();

        return redirect()->route('admin.service-types.index')
            ->with('success', 'Service Type deleted successfully.');
    }

    public function toggleStatus(ServiceType $serviceType): RedirectResponse
    {
        $serviceType->update(['status' => !$serviceType->status]);

        $status = $serviceType->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Service Type {$status} successfully.");
    }
}
