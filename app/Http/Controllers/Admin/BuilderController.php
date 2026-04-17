<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Models\Builder;
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
        return view('admin.builders.create');
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
            'is_verified' => 'boolean',
            'status' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = ImageHelper::storeWebp($request->file('logo'), $validated['name'], 0, 'logo', 'builders');
        }

        Builder::create($validated);

        return redirect()->route('admin.builders.index')
            ->with('success', 'Builder created successfully.');
    }

    public function show(Builder $builder)
    {
        $builder->load(['properties' => function($query) {
            $query->latest()->take(10);
        }]);

        return view('admin.builders.show', compact('builder'));
    }

    public function edit(Builder $builder)
    {
        return view('admin.builders.edit', compact('builder'));
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
            'is_verified' => 'boolean',
            'status' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($builder->logo) {
                Storage::disk('public')->delete($builder->logo);
            }
            $validated['logo'] = ImageHelper::storeWebp($request->file('logo'), $validated['name'], $builder->id, 'logo', 'builders');
        }

        $builder->update($validated);

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
