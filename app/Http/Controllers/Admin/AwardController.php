<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends AdminController
{
    public function index()
    {
        $awards = Award::orderBy('date', 'desc')->get();
        return view('admin.awards.index', compact('awards'));
    }

    public function create()
    {
        return view('admin.awards.create');
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
        $award = Award::findOrFail($id);
        $award->delete();
        return redirect()->route('admin.awards.index')
            ->with('success', 'Award deleted successfully!');
    }
}
