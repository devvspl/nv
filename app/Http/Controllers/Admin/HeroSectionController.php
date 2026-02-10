<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $heroSections = HeroSection::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.hero-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200', // 50MB max
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle video upload
        if ($request->hasFile('video_path')) {
            $validated['video_path'] = $request->file('video_path')->store('hero/videos', 'public');
        }

        // Handle poster image upload
        if ($request->hasFile('poster_image')) {
            $validated['poster_image'] = $request->file('poster_image')->store('hero/posters', 'public');
        }

        HeroSection::create($validated);

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroSection $heroSection): View
    {
        return view('admin.hero-sections.show', compact('heroSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSection $heroSection): View
    {
        return view('admin.hero-sections.edit', compact('heroSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSection $heroSection): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'highlight_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_video' => 'nullable|boolean',
            'remove_poster' => 'nullable|boolean',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle video removal
        if ($request->remove_video && $heroSection->video_path) {
            \Storage::disk('public')->delete($heroSection->video_path);
            $validated['video_path'] = null;
        }

        // Handle new video upload
        if ($request->hasFile('video_path')) {
            if ($heroSection->video_path) {
                \Storage::disk('public')->delete($heroSection->video_path);
            }
            $validated['video_path'] = $request->file('video_path')->store('hero/videos', 'public');
        }

        // Handle poster removal
        if ($request->remove_poster && $heroSection->poster_image) {
            \Storage::disk('public')->delete($heroSection->poster_image);
            $validated['poster_image'] = null;
        }

        // Handle new poster upload
        if ($request->hasFile('poster_image')) {
            if ($heroSection->poster_image) {
                \Storage::disk('public')->delete($heroSection->poster_image);
            }
            $validated['poster_image'] = $request->file('poster_image')->store('hero/posters', 'public');
        }

        $heroSection->update($validated);

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSection $heroSection): RedirectResponse
    {
        // Delete video if exists
        if ($heroSection->video_path) {
            \Storage::disk('public')->delete($heroSection->video_path);
        }

        // Delete poster if exists
        if ($heroSection->poster_image) {
            \Storage::disk('public')->delete($heroSection->poster_image);
        }
        
        $heroSection->delete();

        return redirect()->route('admin.hero-sections.index')
            ->with('success', 'Hero Section deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(HeroSection $heroSection): RedirectResponse
    {
        $heroSection->update(['status' => !$heroSection->status]);

        $status = $heroSection->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Hero Section {$status} successfully.");
    }
}
