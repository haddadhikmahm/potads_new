<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }
}
