<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $materials = Material::orderBy('sort_order')->get();
        
        $completedMaterialIds = [];
        if (auth()->check()) {
            $completedMaterialIds = auth()->user()->completedMaterials()->pluck('material_id')->toArray();
        }

        // Determine which materials are locked
        $nextToComplete = null;
        foreach ($materials as $material) {
            if (!in_array($material->id, $completedMaterialIds)) {
                $nextToComplete = $material->id;
                break;
            }
        }

        return view('materials.index', compact('materials', 'completedMaterialIds', 'nextToComplete'));
    }

    public function show(Material $material)
    {
        // Check if previous material is completed
        if (auth()->check()) {
            $prevMaterial = Material::where('sort_order', '<', $material->sort_order)
                                    ->orderBy('sort_order', 'desc')
                                    ->first();
            
            if ($prevMaterial && !auth()->user()->completedMaterials()->where('material_id', $prevMaterial->id)->exists()) {
                return redirect()->route('materials.index')->with('error', 'Selesaikan materi sebelumnya terlebih dahulu!');
            }
        }

        $material->load('quizzes');
        
        $otherMaterials = Material::where('id', '!=', $material->id)
                                  ->orderBy('sort_order')
                                  ->take(5)
                                  ->get();
                                  
        return view('materials.show', compact('material', 'otherMaterials'));
    }

    public function complete(Material $material)
    {
        if (auth()->check()) {
            auth()->user()->completedMaterials()->syncWithoutDetaching([$material->id]);
            
            $nextMaterial = Material::where('sort_order', '>', $material->sort_order)
                                    ->orderBy('sort_order', 'asc')
                                    ->first();
            
            if ($nextMaterial) {
                return redirect()->route('materials.show', $nextMaterial)->with('success', 'Selamat! Materi berhasil diselesaikan. Lanjut ke materi berikutnya!');
            }
            
            return redirect()->route('materials.index')->with('success', 'Selamat! Anda telah menyelesaikan materi ini.');
        }

        return redirect()->back()->with('error', 'Silakan login untuk menyimpan progres belajar Anda.');
    }
}
