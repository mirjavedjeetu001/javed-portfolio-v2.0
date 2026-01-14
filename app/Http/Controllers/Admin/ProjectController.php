<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends AdminController
{
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        // Convert technologies string to array
        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project added successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'technologies' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'featured' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        // Convert technologies string to array
        if (isset($validated['technologies'])) {
            $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    public function toggleFeatured(Request $request, Project $project)
    {
        // Check if trying to feature a project
        if (!$project->is_featured) {
            // Count currently featured projects
            $featuredCount = Project::where('is_featured', true)->count();
            
            if ($featuredCount >= 3) {
                return back()->with('error', 'You can only feature 3 projects at a time. Please unfeature another project first.');
            }
        }
        
        // Toggle featured status
        $project->is_featured = !$project->is_featured;
        $project->save();
        
        $message = $project->is_featured 
            ? 'Project featured successfully!' 
            : 'Project unfeatured successfully!';
        
        return back()->with('success', $message);
    }
}
