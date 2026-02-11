<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bhk;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BhkController extends Controller
{
    public function index(): View
    {
        $bhks = Bhk::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.bhks.index', compact('bhks'));
    }

    public function create(): View
    {
        return view('admin.bhks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Auto-generate value from name (extract number or use name)
        $value = $this->extractValueFromName($validated['name']);
        $validated['value'] = $value;

        Bhk::create($validated);

        return redirect()->route('admin.bhks.index')
            ->with('success', 'BHK created successfully.');
    }

    public function show(Bhk $bhk): View
    {
        return view('admin.bhks.show', compact('bhk'));
    }

    public function edit(Bhk $bhk): View
    {
        return view('admin.bhks.edit', compact('bhk'));
    }

    public function update(Request $request, Bhk $bhk): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        // Auto-generate value from name (extract number or use name)
        $value = $this->extractValueFromName($validated['name']);
        $validated['value'] = $value;

        $bhk->update($validated);

        return redirect()->route('admin.bhks.index')
            ->with('success', 'BHK updated successfully.');
    }

    public function destroy(Bhk $bhk): RedirectResponse
    {
        $bhk->delete();

        return redirect()->route('admin.bhks.index')
            ->with('success', 'BHK deleted successfully.');
    }

    public function toggleStatus(Bhk $bhk): RedirectResponse
    {
        $bhk->update(['status' => !$bhk->status]);

        $status = $bhk->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "BHK {$status} successfully.");
    }

    /**
     * Extract numeric value from BHK name
     * Examples: "1 BHK" -> "1", "2 BHK" -> "2", "4+ BHK" -> "4+"
     */
    private function extractValueFromName(string $name): string
    {
        // Try to extract number with optional +
        if (preg_match('/(\d+\+?)/', $name, $matches)) {
            return $matches[1];
        }
        
        // Fallback: use lowercase name with hyphens
        return strtolower(str_replace(' ', '-', $name));
    }
}
