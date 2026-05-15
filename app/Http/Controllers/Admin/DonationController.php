<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $donations = Donation::when($search, function($query, $search) {
                return $query->where('donor_name', 'like', "%{$search}%")
                             ->orWhere('note', 'like', "%{$search}%")
                             ->orWhere('payment_status', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        return view('admin.donations.show', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'payment_status' => 'required|string|in:pending,success,failed',
        ]);

        $donation->update($validated);

        return redirect()->route('admin.donations.index')->with('success', 'Status donasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        if ($donation->proof_image) {
            Storage::disk('public')->delete($donation->proof_image);
        }
        $donation->delete();

        return redirect()->route('admin.donations.index')->with('success', 'Data donasi berhasil dihapus.');
    }
}
