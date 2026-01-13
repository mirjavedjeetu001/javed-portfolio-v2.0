<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;

class ThemeController extends AdminController
{
    public function index()
    {
        $theme = ThemeSetting::first() ?? new ThemeSetting();
        return view('admin.theme.index', compact('theme'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'primary_color' => 'nullable|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'accent_color' => 'nullable|string|max:7',
            'text_color' => 'nullable|string|max:7',
            'background_color' => 'nullable|string|max:7',
            'font_family' => 'nullable|string|max:255',
            'heading_font' => 'nullable|string|max:255',
        ]);

        $theme = ThemeSetting::first();
        
        if ($theme) {
            $theme->update($validated);
        } else {
            ThemeSetting::create($validated);
        }

        return back()->with('success', 'Theme settings updated successfully!');
    }
}
