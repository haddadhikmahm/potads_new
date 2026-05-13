<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    public function index()
    {
        $children = Child::with('user')->latest()->paginate(15);
        return view('admin.children.index', compact('children'));
    }

    public function create()
    {
        $users = \App\Models\User::where('role', 'user')->orderBy('name')->get();
        return view('admin.children.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'address' => 'nullable|string',
            'special_needs' => 'nullable|string',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'parent_job' => 'nullable|string|max:255',
            'parent_address' => 'nullable|string',
            'school_status' => 'nullable|string|max:255',
            'school_type' => 'nullable|string|max:255',
            'therapies' => 'nullable|string',
            'development_notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('children/photos', 'public');
        }

        Child::create($validated);

        return redirect()->route('admin.children.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    public function show(Child $child)
    {
        return view('admin.children.show', compact('child'));
    }

    public function edit(Child $child)
    {
        return view('admin.children.edit', compact('child'));
    }

    public function update(Request $request, Child $child)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'address' => 'nullable|string',
            'special_needs' => 'nullable|string',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'parent_job' => 'nullable|string|max:255',
            'parent_address' => 'nullable|string',
            'school_status' => 'nullable|string|max:255',
            'school_type' => 'nullable|string|max:255',
            'therapies' => 'nullable|string',
            'development_notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($child->photo) {
                Storage::disk('public')->delete($child->photo);
            }
            $validated['photo'] = $request->file('photo')->store('children/photos', 'public');
        }

        $child->update($validated);

        return redirect()->route('admin.children.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function destroy(Child $child)
    {
        if ($child->photo) {
            Storage::disk('public')->delete($child->photo);
        }
        $child->delete();
        return redirect()->route('admin.children.index')->with('success', 'Data anak berhasil dihapus.');
    }
}
