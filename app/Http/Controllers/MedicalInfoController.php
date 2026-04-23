<?php

namespace App\Http\Controllers;

use App\Models\MedicalInfo;
use Illuminate\Http\Request;

class MedicalInfoController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicalInfo::where('status', 'published')->latest();

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $infos = $query->get();
        return view('medical_infos.index', compact('infos'));
    }

    public function show($slug)
    {
        $info = MedicalInfo::where('slug', $slug)->firstOrFail();
        return view('medical_infos.show', compact('info'));
    }
}
