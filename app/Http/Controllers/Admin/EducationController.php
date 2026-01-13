<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends AdminController
{
    public function index()
    {
        $education = Education::orderBy('start_date', 'desc')->get();
        return view('admin.education.index', compact('education'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'institution' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'grade' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        Education::create($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education entry added successfully!');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'institution' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'grade' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $education->update($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education entry updated successfully!');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('success', 'Education entry deleted successfully!');
    }
}
