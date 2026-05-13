<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(9);
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        $user = auth()->user();
        
        if ($user->events()->where('event_id', $event->id)->exists()) {
            // Already registered, so we unregister
            $user->events()->detach($event->id);
            return back()->with('success', 'Berhasil membatalkan pendaftaran event.');
        } else {
            // Register
            $user->events()->attach($event->id, ['status' => 'registered']);
            return back()->with('success', 'Berhasil mendaftar event.');
        }
    }
}
