<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->paginate(10);
        return view('admin.materials.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.materials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:video,file',
            'url' => 'required_if:type,video|nullable|url',
            'file' => 'required_if:type,file|nullable|file|max:20480', // 20MB max
            'category' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;
        unset($data['file']);

        if ($request->hasFile('file') && $validated['type'] === 'file') {
            $data['file_path'] = $request->file('file')->store('materials', 'public');
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('materials/images', 'public');
        }

        Material::create($data);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Material $material)
    {
        return view('admin.materials.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:video,file',
            'url' => 'required_if:type,video|nullable|url',
            'file' => 'nullable|file|max:20480',
            'category' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;
        unset($data['file']);

        if ($request->hasFile('file') && $validated['type'] === 'file') {
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }
            $data['file_path'] = $request->file('file')->store('materials', 'public');
            $data['url'] = null; // Clear URL if switching to file
        } elseif ($validated['type'] === 'video') {
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
                $data['file_path'] = null;
            }
        }

        if ($request->hasFile('image')) {
            if ($material->image) {
                Storage::disk('public')->delete($material->image);
            }
            $data['image'] = $request->file('image')->store('materials/images', 'public');
        }

        $material->update($data);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material)
    {
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        if ($material->image) {
            Storage::disk('public')->delete($material->image);
        }
        $material->delete();
        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil dihapus.');
    }
}
