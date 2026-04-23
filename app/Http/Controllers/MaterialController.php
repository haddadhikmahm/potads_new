<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::latest();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $materials = $query->get();
        return view('materials.index', compact('materials'));
    }

    public function show(Material $material)
    {
        $otherMaterials = Material::where('id', '!=', $material->id)
                                  ->latest()
                                  ->take(5)
                                  ->get();
        return view('materials.show', compact('material', 'otherMaterials'));
    }
}
