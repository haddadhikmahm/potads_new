<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'upcoming');
        
        $query = Event::query();
        
        if ($tab === 'passed') {
            $query->where(function($q) {
                $q->where('status', 'completed')
                  ->orWhere('event_date', '<', now());
            });
        } elseif ($tab === 'ongoing') {
            $query->where('status', 'ongoing')
                  ->where('event_date', '>=', now());
        } else {
            $query->where('status', 'upcoming')
                  ->where('event_date', '>=', now());
        }

        $search = $request->query('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $events = $query->latest('event_date')->paginate(9)->withQueryString();
        
        return view('events.index', compact('events', 'tab'));
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
