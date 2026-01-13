<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends AdminController
{
    public function index()
    {
        $menuItems = MenuItem::orderBy('order')->get();
        return view('admin.menu.index', compact('menuItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'section_id' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_visible' => 'boolean'
        ]);

        MenuItem::create($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully');
    }

    public function update(Request $request, MenuItem $menu)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'section_id' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_visible' => 'boolean'
        ]);

        $menu->update($validated);
        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully');
    }

    public function toggleVisibility(MenuItem $menu)
    {
        $menu->update(['is_visible' => !$menu->is_visible]);
        return back()->with('success', 'Menu visibility updated');
    }
}
