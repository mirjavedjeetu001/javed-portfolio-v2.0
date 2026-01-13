<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends AdminController
{
    public function index()
    {
        $activities = Activity::orderBy('start_date', 'desc')->get();
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();
        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity deleted successfully!');
    }
}
