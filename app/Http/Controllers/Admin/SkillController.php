<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;

class SkillController extends AdminController
{
    public function index()
    {
        $categories = SkillCategory::with('skills')->orderBy('order')->get();
        return view('admin.skills.index', compact('categories'));
    }

    public function create()
    {
        $categories = SkillCategory::orderBy('name')->get();
        return view('admin.skills.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'years_experience' => 'nullable|integer|min:0',
            'icon' => 'nullable|string|max:255',
        ]);

        Skill::create($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill added successfully!');
    }

    public function edit(Skill $skill)
    {
        $categories = SkillCategory::orderBy('name')->get();
        return view('admin.skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:skill_categories,id',
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'years_experience' => 'nullable|integer|min:0',
            'icon' => 'nullable|string|max:255',
        ]);

        $skill->update($validated);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill updated successfully!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully!');
    }
}
