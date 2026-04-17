<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Models\Builder;
use App\Models\Amenity;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BuilderController extends Controller
{
    public function index()
    {
        $builders = Builder::withCount('properties')
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.builders.index', compact('builders'));
    }

    public function create()
    {
        $amenities = Amenity::active()->ordered()->get();
        $projectStatuses = ProjectStatus::active()->ordered()->get();
        return view('admin.builders.create', compact('amenities', 'projectStatuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'youtube_url' => 'nullable|url|max:255',
            'is_verified' => 'boolean',
            'status' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
            // Common Details
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'project_statuses' => 'nullable|array',
            'project_statuses.*' => 'exists:project_statuses,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = ImageHelper::storeWebp($request->file('logo'), $validated['name'], 0, 'logo', 'builders');
        }

        if ($request->hasFile('video_path')) {
            $validated['video_path'] = $request->file('video_path')->store('builders/videos', 'public');
        }

        $builder = Builder::create($validated);

        $builder->amenities()->sync($request->input('amenities', []));
        $builder->projectStatuses()->sync($request->input('project_statuses', []));

        return redirect()->route('admin.builders.index')
            ->with('success', 'Builder created successfully.');
    }

    public function show(Builder $builder)
    {
        $builder->load(['properties' => function($query) {
            $query->latest()->take(10);
        }, 'amenities', 'projectStatuses']);

        return view('admin.builders.show', compact('builder'));
    }

    public function edit(Builder $builder)
    {
        $builder->load(['amenities', 'projectStatuses']);
        $amenities = Amenity::active()->ordered()->get();
        $projectStatuses = ProjectStatus::active()->ordered()->get();
        return view('admin.builders.edit', compact('builder', 'amenities', 'projectStatuses'));
    }

    public function update(Request $request, Builder $builder)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'youtube_url' => 'nullable|url|max:255',
            'remove_video' => 'nullable|boolean',
            'is_verified' => 'boolean',
            'status' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
            // Common Details
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'project_statuses' => 'nullable|array',
            'project_statuses.*' => 'exists:project_statuses,id',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            if ($builder->logo) {
                Storage::disk('public')->delete($builder->logo);
            }
            $validated['logo'] = ImageHelper::storeWebp($request->file('logo'), $validated['name'], $builder->id, 'logo', 'builders');
        }

        // Handle video removal
        if ($request->boolean('remove_video') && $builder->video_path) {
            Storage::disk('public')->delete($builder->video_path);
            $validated['video_path'] = null;
        }

        // Handle new video upload
        if ($request->hasFile('video_path')) {
            if ($builder->video_path) {
                Storage::disk('public')->delete($builder->video_path);
            }
            $validated['video_path'] = $request->file('video_path')->store('builders/videos', 'public');
        }

        $builder->update($validated);

        $builder->amenities()->sync($request->input('amenities', []));
        $builder->projectStatuses()->sync($request->input('project_statuses', []));

        return redirect()->route('admin.builders.index')
            ->with('success', 'Builder updated successfully.');
    }

    public function destroy(Builder $builder)
    {
        if ($builder->properties()->count() > 0) {
            return back()->with('error', 'Cannot delete builder with associated properties.');
        }

        if ($builder->logo) {
            Storage::disk('public')->delete($builder->logo);
        }

        if ($builder->video_path) {
            Storage::disk('public')->delete($builder->video_path);
        }

        $builder->delete();

        return redirect()->route('admin.builders.index')
            ->with('success', 'Builder deleted successfully.');
    }

    public function toggleStatus(Builder $builder)
    {
        $builder->update(['status' => !$builder->status]);

        return back()->with('success', 'Builder status updated successfully.');
    }

    public function toggleVerified(Builder $builder)
    {
        $builder->update(['is_verified' => !$builder->is_verified]);

        return back()->with('success', 'Builder verification status updated successfully.');
    }
}
