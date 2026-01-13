<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends AdminController
{
    public function index()
    {
        $about = About::first();
        return view('admin.about.index', compact('about'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'years_experience' => 'nullable|integer',
            'projects_completed' => 'nullable|integer',
            'technologies_used' => 'nullable|integer',
            'countries_visited' => 'nullable|integer',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        About::create($data);

        return redirect()->route('admin.about.index')->with('success', 'About section created successfully!');
    }

    public function edit(string $id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, string $id)
    {
        $about = About::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'years_experience' => 'nullable|integer',
            'projects_completed' => 'nullable|integer',
            'technologies_used' => 'nullable|integer',
            'countries_visited' => 'nullable|integer',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'github' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.index')->with('success', 'About section updated successfully!');
    }

    public function destroy(string $id)
    {
        $about = About::findOrFail($id);
        
        if ($about->image) {
            Storage::disk('public')->delete($about->image);
        }
        
        $about->delete();

        return redirect()->route('admin.about.index')->with('success', 'About section deleted successfully!');
    }
}
