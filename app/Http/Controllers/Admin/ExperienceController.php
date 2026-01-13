<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends AdminController
{
    public function index()
    {
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'achievements' => 'nullable|string',
        ]);

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience added successfully!');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'achievements' => 'nullable|string',
        ]);

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully!');
    }
}
