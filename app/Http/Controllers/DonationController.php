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
            'whatsapp' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'payment_method' => 'required|string',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_anonymous' => 'nullable|string',
        ]);

        $donationData = [
            'donor_name' => $validated['donor_name'],
            'amount' => $validated['amount'],
            'email' => $validated['donor_email'],
            'phone' => $validated['whatsapp'] ?? null,
            'message' => $validated['notes'] ?? null,
            'payment_status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'transaction_id' => 'POTADS-' . strtoupper(uniqid()),
            'is_anonymous' => isset($validated['is_anonymous']),
        ];

        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('donations', 'public');
            $donationData['proof_image'] = $path;
        }

        Donation::create($donationData);

        return redirect()->back()->with('success', 'Terima kasih atas niat baik Anda! Admin kami akan menghubungi Anda untuk konfirmasi pembayaran.');
    }
}
