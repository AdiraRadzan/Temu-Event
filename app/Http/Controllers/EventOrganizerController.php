<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventParticipant;
use App\Models\EventRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventOrganizerController extends Controller
{
    public function dashboard()
    {
        $organizer = Auth::user();
        
        if (!$organizer->isApproved()) {
            return view('organizer.pending-verification');
        }

        $stats = [
            'total_events' => $organizer->organizedEvents()->count(),
            'published_events' => $organizer->organizedEvents()->published()->count(),
            'upcoming_events' => $organizer->organizedEvents()->published()->upcoming()->count(),
            'total_participants' => $organizer->organizedEvents()->withCount('participants')->get()->sum('participants_count'),
            'pending_ratings' => EventRating::whereHas('event', function ($query) use ($organizer) {
                $query->where('organizer_id', $organizer->id);
            })->pending()->count(),
        ];

        $recentEvents = $organizer->organizedEvents()
            ->with(['category', 'participants'])
            ->latest()
            ->take(5)
            ->get();

        $recentRatings = EventRating::whereHas('event', function ($query) use ($organizer) {
                $query->where('organizer_id', $organizer->id);
            })
            ->with(['event', 'user'])
            ->approved()
            ->latest()
            ->take(5)
            ->get();

        return view('organizer.dashboard', compact('stats', 'recentEvents', 'recentRatings'));
    }

    public function events()
    {
        $events = Auth::user()->organizedEvents()
            ->with(['category', 'participants'])
            ->latest()
            ->paginate(15);

        return view('organizer.events.index', compact('events'));
    }

    public function index()
    {
        $events = Auth::user()->organizedEvents()
            ->with(['category', 'participants'])
            ->latest()
            ->paginate(15);

        return view('organizer.events.index', compact('events'));
    }

    public function createEvent()
    {
        $categories = EventCategory::active()->get();
        return view('organizer.events.create', compact('categories'));
    }

    public function create()
    {
        return $this->createEvent();
    }

    public function store(Request $request)
    {
        return $this->storeEvent($request);
    }

    public function show(Event $event)
    {
        return $this->showEvent($event);
    }

    public function edit(Event $event)
    {
        return $this->editEvent($event);
    }

    public function update(Request $request, Event $event)
    {
        return $this->updateEvent($request, $event);
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'category_id' => 'required|exists:event_categories,id',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'event_type' => 'required|in:free,paid',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'requirements' => 'nullable|string',
            'tags' => 'nullable|string',
            'contact_info' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event = Event::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'description' => $request->description,
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'organizer_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'venue' => $request->venue,
            'address' => $request->address,
            'max_participants' => $request->max_participants,
            'price' => $request->price ?? 0,
            'event_type' => $request->event_type,
            'image' => $imagePath,
            'requirements' => $request->requirements ? explode("\n", $request->requirements) : null,
            'tags' => $request->tags ? explode(',', $request->tags) : null,
            'contact_info' => $request->contact_info,
        ]);

        return redirect()->route('organizer.events.show', $event)->with('success', 'Event berhasil dibuat!');
    }

    public function showEvent(Event $event)
    {
        $this->authorizeEventAccess($event);

        $event->load(['category', 'participants.user', 'ratings.user']);

        return view('organizer.events.show', compact('event'));
    }

    public function editEvent(Event $event)
    {
        $this->authorizeEventAccess($event);

        $categories = EventCategory::active()->get();
        return view('organizer.events.edit', compact('event', 'categories'));
    }

    public function updateEvent(Request $request, Event $event)
    {
        $this->authorizeEventAccess($event);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'category_id' => 'required|exists:event_categories,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'event_type' => 'required|in:free,paid',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'requirements' => 'nullable|string',
            'tags' => 'nullable|string',
            'contact_info' => 'nullable|string',
        ]);

        $imagePath = $event->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'venue' => $request->venue,
            'address' => $request->address,
            'max_participants' => $request->max_participants,
            'price' => $request->price ?? 0,
            'event_type' => $request->event_type,
            'image' => $imagePath,
            'requirements' => $request->requirements ? explode("\n", $request->requirements) : null,
            'tags' => $request->tags ? explode(',', $request->tags) : null,
            'contact_info' => $request->contact_info,
        ]);

        return redirect()->route('organizer.events.show', $event)->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        $this->authorizeEventAccess($event);

        // Delete event image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        // Check if event has participants
        if ($event->participants()->count() > 0) {
            return back()->with('error', 'Tidak dapat menghapus event yang sudah memiliki peserta.');
        }

        $event->delete();

        return redirect()->route('organizer.events.index')->with('success', 'Event berhasil dihapus!');
    }

    public function publishEvent(Event $event)
    {
        $this->authorizeEventAccess($event);

        if ($event->status === 'draft') {
            $event->update(['status' => 'published']);
            return back()->with('success', 'Event berhasil dipublikasi!');
        }

        return back()->with('error', 'Event sudah dipublikasi.');
    }

    public function cancelEvent(Event $event)
    {
        $this->authorizeEventAccess($event);

        $event->update(['status' => 'cancelled']);
        return back()->with('success', 'Event berhasil dibatalkan.');
    }

    public function participants(Event $event)
    {
        $this->authorizeEventAccess($event);

        $participants = $event->participants()
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('organizer.events.participants', compact('event', 'participants'));
    }

    public function updateParticipantStatus(EventParticipant $participant, $status)
    {
        $this->authorizeEventAccess($participant->event);

        if (!in_array($status, ['registered', 'confirmed', 'cancelled', 'attended'])) {
            return back()->with('error', 'Status tidak valid.');
        }

        $participant->update(['status' => $status]);

        return back()->with('success', 'Status peserta berhasil diperbarui.');
    }

    public function ratings(Event $event)
    {
        $this->authorizeEventAccess($event);

        $ratings = $event->ratings()
            ->with('user')
            ->approved()
            ->latest()
            ->paginate(15);

        return view('organizer.events.ratings', compact('event', 'ratings'));
    }

    public function profile()
    {
        return view('organizer.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'organization_name' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $user->update($request->only([
            'name', 'email', 'phone', 'organization_name', 'bio'
        ]));

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function settings()
    {
        // Get organizer settings
        $settings = [
            'email_notifications' => true,
            'sms_notifications' => true,
            'auto_approve_bookings' => false,
            'show_analytics' => true,
            'marketing_emails' => true,
            'public_profile' => true,
            'max_events_per_month' => 10,
        ];

        return view('organizer.settings', compact('settings'));
    }

    private function authorizeEventAccess(Event $event)
    {
        if ($event->organizer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this event.');
        }
    }
}
