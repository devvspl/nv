<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'property_count' => 'required|integer|min:0',
            'link' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('cities', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        City::create($data);

        return redirect()->route('admin.cities.index')
            ->with('success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return view('admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'property_count' => 'required|integer|min:0',
            'link' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->has('status');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($city->image && Str::startsWith($city->image, 'cities/')) {
                Storage::disk('public')->delete($city->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('cities', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        $city->update($data);

        return redirect()->route('admin.cities.index')
            ->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        // Delete image if exists
        if ($city->image && Str::startsWith($city->image, 'cities/')) {
            Storage::disk('public')->delete($city->image);
        }

        $city->delete();

        return redirect()->route('admin.cities.index')
            ->with('success', 'City deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(City $city)
    {
        $city->update(['status' => !$city->status]);

        return response()->json([
            'success' => true,
            'status' => $city->status,
            'message' => 'City status updated successfully.'
        ]);
    }
}