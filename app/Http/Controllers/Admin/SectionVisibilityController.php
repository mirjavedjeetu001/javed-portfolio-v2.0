<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\SectionVisibility;
use Illuminate\Http\Request;

class SectionVisibilityController extends AdminController
{
    public function index()
    {
        $sections = SectionVisibility::orderBy('order')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function toggleVisibility(SectionVisibility $section)
    {
        $section->update(['is_visible' => !$section->is_visible]);
        return back()->with('success', 'Section visibility updated');
    }

    public function updateOrder(Request $request)
    {
        $orders = $request->input('orders', []);
        foreach ($orders as $id => $order) {
            SectionVisibility::where('id', $id)->update(['order' => $order]);
        }
        return back()->with('success', 'Section order updated');
    }
}
