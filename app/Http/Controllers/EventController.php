<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCategory;

class EventController extends Controller
{
    /**
     * Display a listing of all events.
     */
    public function index()
    {
        $events = Event::with(['category', 'organizer'])
                    ->published()
                    ->orderBy('event_date', 'desc')
                    ->paginate(12);
                    
        return view('events.index-v3', compact('events'));  // ← Ubah dari 'welcome' ke 'events.index-v3'
    }

    /**
     * Display the specified event.
     */
    public function show($id)
    {
        $event = Event::with(['category', 'organizer', 'participants', 'ratings'])
                    ->published()
                    ->findOrFail($id);
                    
        return view('events.show', compact('event'));
    }

    /**
     * Display all event categories.
     */
    public function categories()
    {
        $categories = EventCategory::withCount('events')
                    ->orderBy('name')
                    ->get();
                    
        return view('categories.index', compact('categories'));
    }
}