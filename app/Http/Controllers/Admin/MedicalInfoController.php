<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MedicalInfoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $infos = MedicalInfo::when($search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('category', 'like', "%{$search}%")
                             ->orWhere('address', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.medical_infos.index', compact('infos'));
    }

    public function create()
    {
        return view('admin.medical_infos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:akademis,medis,sekolah,rumah sakit,pusat tumbuh kembang',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($validated['title']) . '-' . rand(1000, 9999);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('medical_infos', 'public');
        }

        MedicalInfo::create($data);

        return redirect()->route('admin.medical_infos.index')->with('success', 'Info berhasil ditambahkan.');
    }

    public function edit(MedicalInfo $medicalInfo)
    {
        return view('admin.medical_infos.edit', compact('medicalInfo'));
    }

    public function update(Request $request, MedicalInfo $medicalInfo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:akademis,medis,sekolah,rumah sakit,pusat tumbuh kembang',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        $data = $validated;
        
        if ($medicalInfo->title !== $validated['title']) {
            $data['slug'] = Str::slug($validated['title']) . '-' . rand(1000, 9999);
        }

        if ($request->hasFile('image')) {
            if ($medicalInfo->image) {
                Storage::disk('public')->delete($medicalInfo->image);
            }
            $data['image'] = $request->file('image')->store('medical_infos', 'public');
        }

        $medicalInfo->update($data);

        return redirect()->route('admin.medical_infos.index')->with('success', 'Info berhasil diperbarui.');
    }

    public function destroy(MedicalInfo $medicalInfo)
    {
        if ($medicalInfo->image) {
            Storage::disk('public')->delete($medicalInfo->image);
        }
        $medicalInfo->delete();
        return redirect()->route('admin.medical_infos.index')->with('success', 'Info berhasil dihapus.');
    }
}
