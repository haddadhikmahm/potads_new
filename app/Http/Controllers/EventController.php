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

        // Prevent internal registration if event uses external link
        if ($event->registration_link) {
            return back()->with('error', 'Pendaftaran untuk event ini dilakukan melalui formulir eksternal.');
        }
        
        // Handle unregistration if explicitly requested
        if ($request->input('action') === 'unregister') {
            \Illuminate\Support\Facades\DB::table('event_user')
                ->where('event_id', $event->id)
                ->where('user_id', $user->id)
                ->delete();
            return back()->with('success', 'Berhasil membatalkan pendaftaran.');
        }

        $childIds = $request->input('child_ids', []);
        $registerSelf = $request->has('register_self');

        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($user, $event, $childIds, $registerSelf) {
                // Clear all existing registrations for this specific user and event
                \Illuminate\Support\Facades\DB::table('event_user')
                    ->where('event_id', $event->id)
                    ->where('user_id', $user->id)
                    ->delete();

                // Re-register self if selected
                if ($registerSelf) {
                    $user->events()->attach($event->id, [
                        'status' => 'registered', 
                        'child_id' => null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }

                // Register children
                foreach ($childIds as $childId) {
                    // Verify child belongs to user
                    if ($user->children()->where('id', $childId)->exists()) {
                        $user->events()->attach($event->id, [
                            'status' => 'registered', 
                            'child_id' => $childId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            });

            return back()->with('success', 'Pendaftaran berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan pendaftaran: ' . $e->getMessage());
        }
    }
}
