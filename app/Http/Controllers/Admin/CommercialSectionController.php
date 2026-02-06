<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommercialSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommercialSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commercialSections = CommercialSection::latest()->paginate(10);
        return view('admin.commercial-sections.index', compact('commercialSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.commercial-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'badge' => 'required|string|max:255',
            'title' => 'required|string|max:500',
            'subtitle' => 'required|string',
            'points' => 'required|array|min:1',
            'points.*.title' => 'required|string|max:255',
            'points.*.description' => 'nullable|string',
            'primary_button_text' => 'required|string|max:255',
            'primary_button_link' => 'required|string|max:255',
            'secondary_button_text' => 'required|string|max:255',
            'secondary_button_link' => 'required|string|max:255',
            'gallery_images' => 'nullable|array',
            'gallery_images.*.src' => 'nullable|string',
            'gallery_images.*.alt' => 'nullable|string|max:255',
            'gallery_images.*.label' => 'nullable|string|max:255',
            'uploaded_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'uploaded_image_alts.*' => 'nullable|string|max:255',
            'uploaded_image_labels.*' => 'nullable|string|max:255',
            'gallery_note' => 'required|string|max:500',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['uploaded_images', 'uploaded_image_alts', 'uploaded_image_labels']);
        
        // Handle uploaded images
        $uploadedImages = [];
        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $index => $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('commercial-sections', 'public');
                    $uploadedImages[] = [
                        'path' => $path,
                        'alt' => $request->uploaded_image_alts[$index] ?? 'Commercial property image',
                        'label' => $request->uploaded_image_labels[$index] ?? 'Commercial project'
                    ];
                }
            }
        }
        $data['uploaded_images'] = $uploadedImages;

        // If this is being set as active, deactivate others
        if ($request->is_active) {
            CommercialSection::where('is_active', true)->update(['is_active' => false]);
        }

        CommercialSection::create($data);

        return redirect()->route('admin.commercial-sections.index')
            ->with('success', 'Commercial section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommercialSection $commercialSection)
    {
        return view('admin.commercial-sections.show', compact('commercialSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommercialSection $commercialSection)
    {
        return view('admin.commercial-sections.edit', compact('commercialSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommercialSection $commercialSection)
    {
        $request->validate([
            'badge' => 'required|string|max:255',
            'title' => 'required|string|max:500',
            'subtitle' => 'required|string',
            'points' => 'required|array|min:1',
            'points.*.title' => 'required|string|max:255',
            'points.*.description' => 'nullable|string',
            'primary_button_text' => 'required|string|max:255',
            'primary_button_link' => 'required|string|max:255',
            'secondary_button_text' => 'required|string|max:255',
            'secondary_button_link' => 'required|string|max:255',
            'gallery_images' => 'nullable|array',
            'gallery_images.*.src' => 'nullable|string',
            'gallery_images.*.alt' => 'nullable|string|max:255',
            'gallery_images.*.label' => 'nullable|string|max:255',
            'uploaded_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'uploaded_image_alts.*' => 'nullable|string|max:255',
            'uploaded_image_labels.*' => 'nullable|string|max:255',
            'remove_uploaded_images' => 'nullable|array',
            'gallery_note' => 'required|string|max:500',
            'is_active' => 'boolean'
        ]);

        $data = $request->except(['uploaded_images', 'uploaded_image_alts', 'uploaded_image_labels', 'remove_uploaded_images']);
        
        // Handle existing uploaded images
        $existingImages = $commercialSection->uploaded_images ?? [];
        
        // Remove selected images
        if ($request->remove_uploaded_images) {
            foreach ($request->remove_uploaded_images as $indexToRemove) {
                if (isset($existingImages[$indexToRemove])) {
                    // Delete file from storage
                    Storage::disk('public')->delete($existingImages[$indexToRemove]['path']);
                    unset($existingImages[$indexToRemove]);
                }
            }
            $existingImages = array_values($existingImages); // Re-index array
        }
        
        // Handle new uploaded images
        if ($request->hasFile('uploaded_images')) {
            foreach ($request->file('uploaded_images') as $index => $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('commercial-sections', 'public');
                    $existingImages[] = [
                        'path' => $path,
                        'alt' => $request->uploaded_image_alts[$index] ?? 'Commercial property image',
                        'label' => $request->uploaded_image_labels[$index] ?? 'Commercial project'
                    ];
                }
            }
        }
        
        $data['uploaded_images'] = $existingImages;

        // If this is being set as active, deactivate others
        if ($request->is_active && !$commercialSection->is_active) {
            CommercialSection::where('is_active', true)->update(['is_active' => false]);
        }

        $commercialSection->update($data);

        return redirect()->route('admin.commercial-sections.index')
            ->with('success', 'Commercial section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommercialSection $commercialSection)
    {
        // Delete uploaded images from storage
        if ($commercialSection->uploaded_images) {
            foreach ($commercialSection->uploaded_images as $image) {
                Storage::disk('public')->delete($image['path']);
            }
        }
        
        $commercialSection->delete();

        return redirect()->route('admin.commercial-sections.index')
            ->with('success', 'Commercial section deleted successfully.');
    }

    /**
     * Toggle the active status of the commercial section.
     */
    public function toggleStatus(CommercialSection $commercialSection)
    {
        if (!$commercialSection->is_active) {
            // Deactivate all other sections
            CommercialSection::where('is_active', true)->update(['is_active' => false]);
            $commercialSection->update(['is_active' => true]);
            $message = 'Commercial section activated successfully.';
        } else {
            $commercialSection->update(['is_active' => false]);
            $message = 'Commercial section deactivated successfully.';
        }

        return redirect()->route('admin.commercial-sections.index')
            ->with('success', $message);
    }
}