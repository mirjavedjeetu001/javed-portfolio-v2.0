<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends AdminController
{
    public function index()
    {
        $settings = Setting::all();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Handle resume PDF upload
        if ($request->hasFile('resume_pdf')) {
            $request->validate([
                'resume_pdf' => 'required|file|mimes:pdf|max:10240' // 10MB max
            ]);
            
            $file = $request->file('resume_pdf');
            $filename = 'resume_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('resumes', $filename, 'public');
            
            // Delete old resume if exists
            $oldResume = Setting::where('key', 'resume_pdf_path')->first();
            if ($oldResume && $oldResume->value) {
                \Storage::disk('public')->delete($oldResume->value);
            }
            
            Setting::updateOrCreate(
                ['key' => 'resume_pdf_path'],
                ['value' => $path]
            );
        }
        
        // Handle checkbox settings (convert to 1/0)
        $checkboxSettings = ['enable_hero_animation', 'enable_preloader'];
        foreach ($checkboxSettings as $checkbox) {
            $value = $request->has($checkbox) ? '1' : '0';
            Setting::updateOrCreate(
                ['key' => $checkbox],
                ['value' => $value]
            );
        }
        
        foreach ($request->except(['_token', 'resume_pdf', 'enable_hero_animation', 'enable_preloader']) as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
