<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $message = Message::create($validated);

        try {
            Mail::to('admin@potadsjabar.or.id')->send(new ContactMessageMail($message));
        } catch (\Exception $e) {
            // Log error or ignore if mail is not configured
            \Log::error('Mail sending failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Pesan Anda telah terkirim! Kami akan segera menghubungi Anda.');
    }
}
