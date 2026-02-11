<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProjectStatusController extends Controller
{
    public function index(): View
    {
        $projectStatuses = ProjectStatus::orderBy('sort_order', 'asc')->paginate(10);
        return view('admin.project-statuses.index', compact('projectStatuses'));
    }

    public function create(): View
    {
        return view('admin.project-statuses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255|unique:project_statuses,value',
            'description' => 'nullable|string',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        ProjectStatus::create($validated);

        return redirect()->route('admin.project-statuses.index')
            ->with('success', 'Project Status created successfully.');
    }

    public function show(ProjectStatus $projectStatus): View
    {
        return view('admin.project-statuses.show', compact('projectStatus'));
    }

    public function edit(ProjectStatus $projectStatus): View
    {
        return view('admin.project-statuses.edit', compact('projectStatus'));
    }

    public function update(Request $request, ProjectStatus $projectStatus): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255|unique:project_statuses,value,' . $projectStatus->id,
            'description' => 'nullable|string',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $projectStatus->update($validated);

        return redirect()->route('admin.project-statuses.index')
            ->with('success', 'Project Status updated successfully.');
    }

    public function destroy(ProjectStatus $projectStatus): RedirectResponse
    {
        $projectStatus->delete();

        return redirect()->route('admin.project-statuses.index')
            ->with('success', 'Project Status deleted successfully.');
    }

    public function toggleStatus(ProjectStatus $projectStatus): RedirectResponse
    {
        $projectStatus->update(['status' => !$projectStatus->status]);

        $status = $projectStatus->status ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Project Status {$status} successfully.");
    }
}
