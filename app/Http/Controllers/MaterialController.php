<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $audience = $request->query('audience', 'parent'); // Default to parent
        
        $materials = Material::where('audience', $audience)
            ->when($search, function($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%")
                             ->orWhere('category', 'like', "%{$search}%");
            })
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();
        
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

        return view('materials.index', compact('materials', 'completedMaterialIds', 'nextToComplete', 'audience'));
    }

    public function show(Material $material)
    {
        // Check if previous material is completed
        if (auth()->check()) {
            $prevMaterial = Material::where(function($q) use ($material) {
                                        $q->where('level', '<', $material->level)
                                          ->orWhere(function($q2) use ($material) {
                                              $q2->where('level', $material->level)
                                                 ->where('sort_order', '<', $material->sort_order);
                                          });
                                    })
                                    ->orderBy('level', 'desc')
                                    ->orderBy('sort_order', 'desc')
                                    ->first();
            
            if ($prevMaterial && !auth()->user()->completedMaterials()->where('material_id', $prevMaterial->id)->exists()) {
                return redirect()->route('materials.index', ['audience' => $material->audience])->with('error', 'Selesaikan materi sebelumnya terlebih dahulu!');
            }
        }

        $material->load('quizzes');
        
        $otherMaterials = Material::where('audience', $material->audience)
                                  ->where('id', '!=', $material->id)
                                  ->orderBy('level')
                                  ->orderBy('sort_order')
                                  ->take(5)
                                  ->get();
                                  
        return view('materials.show', compact('material', 'otherMaterials'));
    }

    public function complete(Material $material)
    {
        if (auth()->check()) {
            auth()->user()->completedMaterials()->syncWithoutDetaching([$material->id]);
            
            $nextMaterial = Material::where('audience', $material->audience)
                                    ->where(function($q) use ($material) {
                                        $q->where('level', '>', $material->level)
                                          ->orWhere(function($q2) use ($material) {
                                              $q2->where('level', $material->level)
                                                 ->where('sort_order', '>', $material->sort_order);
                                          });
                                    })
                                    ->orderBy('level', 'asc')
                                    ->orderBy('sort_order', 'asc')
                                    ->first();
            
            if ($nextMaterial) {
                return redirect()->route('materials.show', $nextMaterial)->with('success', 'Selamat! Materi berhasil diselesaikan. Lanjut ke materi berikutnya!');
            }
            
            return redirect()->route('materials.index', ['audience' => $material->audience])->with('success', 'Selamat! Anda telah menyelesaikan materi ini.');
        }

        return redirect()->back()->with('error', 'Silakan login untuk menyimpan progres belajar Anda.');
    }
}
