<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Show the donation form.
     */
    public function index()
    {
        return view('donations.index');
    }

    /**
     * Store a new donation (simulated).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1000',
            'notes' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        $validated['status'] = 'pending';
        $validated['transaction_id'] = 'POTADS-' . strtoupper(uniqid());

        Donation::create($validated);

        return redirect()->back()->with('success', 'Terima kasih atas niat baik Anda! Admin kami akan menghubungi Anda untuk konfirmasi pembayaran.');
    }
}
