<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', '!=', 'superadmin')->latest()->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    public function edit(User $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($member->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'profession' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'is_parent' => ['required', 'boolean'],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($member->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:user,admin'],
        ]);

        $data = $validated;
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        } else {
            unset($data['password']);
        }

        $member->update($data);

        return redirect()->route('admin.members.index')->with('success', 'Data member berhasil diperbarui.');
    }

    public function show(User $member)
    {
        return view('admin.members.show', compact('member'));
    }

    public function destroy(User $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus.');
    }
}
