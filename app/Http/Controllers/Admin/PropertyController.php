<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Bhk;
use App\Models\City;
use App\Models\Location;
use App\Models\ProjectStatus;
use App\Models\Builder;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with(['propertyType', 'bhk', 'city', 'location', 'projectStatus', 'builder', 'mainImage'])
            ->latest()
            ->paginate(10);

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $propertyTypes = PropertyType::active()->ordered()->get();
        $bhks = Bhk::active()->ordered()->get();
        $cities = City::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $projectStatuses = ProjectStatus::active()->ordered()->get();
        $builders = Builder::active()->ordered()->get();
        $amenities = Amenity::active()->ordered()->get();

        return view('admin.properties.create', compact(
            'propertyTypes',
            'bhks',
            'cities',
            'locations',
            'projectStatuses',
            'builders',
            'amenities'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'property_type_id' => 'required|exists:property_types,id',
            'bhk_id' => 'required|exists:bhks,id',
            'city_id' => 'required|exists:cities,id',
            'location_id' => 'required|exists:locations,id',
            'project_status_id' => 'required|exists:project_statuses,id',
            'builder_id' => 'nullable|exists:builders,id',
            'price' => 'required|numeric|min:0',
            'price_per_sqft' => 'nullable|numeric|min:0',
            'carpet_area' => 'nullable|numeric|min:0',
            'built_up_area' => 'nullable|numeric|min:0',
            'plot_area' => 'nullable|numeric|min:0',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_featured' => 'boolean',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // Specifications
            'total_floors' => 'nullable|integer|min:1',
            'floor_number' => 'nullable|integer|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'balconies' => 'nullable|integer|min:0',
            'parking_spaces' => 'nullable|integer|min:0',
            'furnishing_status' => 'nullable|in:unfurnished,semi_furnished,fully_furnished',
            'facing' => 'nullable|in:north,south,east,west,north_east,north_west,south_east,south_west',
            'age_of_property' => 'nullable|integer|min:0',
            'possession_date' => 'nullable|date',
            'rera_id' => 'nullable|string|max:100',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();

        $property = Property::create($validated);

        // Attach amenities
        if ($request->has('amenities')) {
            $property->amenities()->attach($request->amenities);
        }

        // Create specifications
        $property->specifications()->create([
            'total_floors' => $request->total_floors,
            'floor_number' => $request->floor_number,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'balconies' => $request->balconies,
            'parking_spaces' => $request->parking_spaces,
            'furnishing_status' => $request->furnishing_status,
            'facing' => $request->facing,
            'age_of_property' => $request->age_of_property,
            'possession_date' => $request->possession_date,
            'rera_id' => $request->rera_id,
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create([
                    'image_path' => $path,
                    'image_type' => $index === 0 ? 'main' : 'gallery',
                    'display_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property created successfully.');
    }

    public function show(Property $property)
    {
        $property->load([
            'propertyType',
            'bhk',
            'city',
            'location',
            'projectStatus',
            'builder',
            'images',
            'amenities',
            'specifications',
            'user'
        ]);

        return view('admin.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $property->load(['amenities', 'specifications', 'images']);
        
        $propertyTypes = PropertyType::active()->ordered()->get();
        $bhks = Bhk::active()->ordered()->get();
        $cities = City::active()->ordered()->get();
        $locations = Location::active()->ordered()->get();
        $projectStatuses = ProjectStatus::active()->ordered()->get();
        $builders = Builder::active()->ordered()->get();
        $amenities = Amenity::active()->ordered()->get();

        return view('admin.properties.edit', compact(
            'property',
            'propertyTypes',
            'bhks',
            'cities',
            'locations',
            'projectStatuses',
            'builders',
            'amenities'
        ));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'property_type_id' => 'required|exists:property_types,id',
            'bhk_id' => 'required|exists:bhks,id',
            'city_id' => 'required|exists:cities,id',
            'location_id' => 'required|exists:locations,id',
            'project_status_id' => 'required|exists:project_statuses,id',
            'builder_id' => 'nullable|exists:builders,id',
            'price' => 'required|numeric|min:0',
            'price_per_sqft' => 'nullable|numeric|min:0',
            'carpet_area' => 'nullable|numeric|min:0',
            'built_up_area' => 'nullable|numeric|min:0',
            'plot_area' => 'nullable|numeric|min:0',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_featured' => 'boolean',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // Specifications
            'total_floors' => 'nullable|integer|min:1',
            'floor_number' => 'nullable|integer|min:0',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'balconies' => 'nullable|integer|min:0',
            'parking_spaces' => 'nullable|integer|min:0',
            'furnishing_status' => 'nullable|in:unfurnished,semi_furnished,fully_furnished',
            'facing' => 'nullable|in:north,south,east,west,north_east,north_west,south_east,south_west',
            'age_of_property' => 'nullable|integer|min:0',
            'possession_date' => 'nullable|date',
            'rera_id' => 'nullable|string|max:100',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $property->update($validated);

        // Sync amenities
        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities);
        } else {
            $property->amenities()->detach();
        }

        // Update specifications
        $property->specifications()->updateOrCreate(
            ['property_id' => $property->id],
            [
                'total_floors' => $request->total_floors,
                'floor_number' => $request->floor_number,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'balconies' => $request->balconies,
                'parking_spaces' => $request->parking_spaces,
                'furnishing_status' => $request->furnishing_status,
                'facing' => $request->facing,
                'age_of_property' => $request->age_of_property,
                'possession_date' => $request->possession_date,
                'rera_id' => $request->rera_id,
            ]
        );

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $lastOrder = $property->images()->max('display_order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                $property->images()->create([
                    'image_path' => $path,
                    'image_type' => 'gallery',
                    'display_order' => $lastOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        // Delete images from storage
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $property->delete();

        return redirect()->route('admin.properties.index')
            ->with('success', 'Property deleted successfully.');
    }

    public function toggleStatus(Property $property)
    {
        $property->update(['is_active' => !$property->is_active]);

        return back()->with('success', 'Property status updated successfully.');
    }

    public function toggleFeatured(Property $property)
    {
        $property->update(['is_featured' => !$property->is_featured]);

        return back()->with('success', 'Property featured status updated successfully.');
    }

    public function toggleVerified(Property $property)
    {
        $property->update(['is_verified' => !$property->is_verified]);

        return back()->with('success', 'Property verification status updated successfully.');
    }

    public function deleteImage($imageId)
    {
        $image = \App\Models\PropertyImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
