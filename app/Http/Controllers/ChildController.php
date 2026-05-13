<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    public function create()
    {
        return view('children.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'school' => 'nullable|string|max:255',
            'hobby' => 'nullable|string|max:255',
            'medical_notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $validated;
        $data['user_id'] = auth()->id();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('children', 'public');
        }

        Child::create($data);

        return redirect()->route('profile')->with('success', 'Data anak berhasil ditambahkan.');
    }

    public function edit(Child $child)
    {
        $this->authorizeOwner($child);
        return view('children.edit', compact('child'));
    }

    public function update(Request $request, Child $child)
    {
        $this->authorizeOwner($child);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:L,P',
            'school' => 'nullable|string|max:255',
            'hobby' => 'nullable|string|max:255',
            'medical_notes' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $validated;

        if ($request->hasFile('photo')) {
            if ($child->photo) {
                Storage::disk('public')->delete($child->photo);
            }
            $data['photo'] = $request->file('photo')->store('children', 'public');
        }

        $child->update($data);

        return redirect()->route('profile')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function destroy(Child $child)
    {
        $this->authorizeOwner($child);
        
        if ($child->photo) {
            Storage::disk('public')->delete($child->photo);
        }
        
        $child->delete();
        return redirect()->route('profile')->with('success', 'Data anak berhasil dihapus.');
    }

    private function authorizeOwner(Child $child)
    {
        if ($child->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
