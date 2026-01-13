<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends AdminController
{
    public function index()
    {
        $certifications = Certification::orderBy('order')->get();
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
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
        $certification = Certification::findOrFail($id);
        $certification->delete();
        return redirect()->route('admin.certifications.index')
            ->with('success', 'Certification deleted successfully!');
    }
}
