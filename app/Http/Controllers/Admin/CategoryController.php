<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'icon_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle icon upload
        if ($request->hasFile('icon_upload')) {
            $validated['icon_upload'] = $request->file('icon_upload')->store('categories/icons', 'public');
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'icon_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'remove_icon_upload' => 'nullable|boolean',
            'link' => 'nullable|string|max:255',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Handle icon upload removal
        if ($request->remove_icon_upload && $category->icon_upload) {
            \Storage::disk('public')->delete($category->icon_upload);
            $validated['icon_upload'] = null;
        }

        // Handle new icon upload
        if ($request->hasFile('icon_upload')) {
            // Delete old icon if exists
            if ($category->icon_upload) {
                \Storage::disk('public')->delete($category->icon_upload);
            }
            $validated['icon_upload'] = $request->file('icon_upload')->store('categories/icons', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Delete uploaded icon if exists
        if ($category->icon_upload) {
            \Storage::disk('public')->delete($category->icon_upload);
        }
        
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Category $category): RedirectResponse
    {
        $category->update(['status' => !$category->status]);

        $status = $category->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Category {$status} successfully.");
    }
}
