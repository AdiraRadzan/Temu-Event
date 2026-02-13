<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventParticipant;
use App\Models\EventFavorite;
use App\Models\EventRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $stats = [
            'total_events' => $user->eventParticipations()->count(),
            'upcoming_events' => $user->eventParticipations()
                ->whereHas('event', function ($query) {
                    $query->published()->where('start_date', '>=', now());
                })->count(),
            'completed_events' => $user->eventParticipations()
                ->whereHas('event', function ($query) {
                    $query->where('end_date', '<', now());
                })->count(),
            'favorites' => $user->eventFavorites()->count(),
        ];

        $upcomingEvents = $user->eventParticipations()
            ->with('event')
            ->whereHas('event', function ($query) {
                $query->published()->where('start_date', '>=', now());
            })
            ->latest()
            ->take(5)
            ->get()
            ->pluck('event');

        $recentRatings = $user->eventRatings()
            ->with('event')
            ->approved()
            ->latest()
            ->take(5)
            ->get();

        $favorites = $user->eventFavorites()
            ->with('event')
            ->latest()
            ->take(5)
            ->get()
            ->pluck('event');

        return view('user.dashboard', compact('stats', 'upcomingEvents', 'recentRatings', 'favorites'));
    }

    public function events(Request $request)
    {
        $query = Event::with(['organizer', 'category'])
            ->published()
            ->upcoming();

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Sort
        switch ($request->get('sort', 'latest')) {
            case 'date':
                $query->orderBy('start_date', 'asc');
                break;
            case 'popular':
                $query->withCount('participants')
                      ->orderByDesc('participants_count');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
        }

        $events = $query->paginate(12);
        $categories = EventCategory::active()->get();

        return view('user.events.index', compact('events', 'categories'));
    }

    public function showEvent(Event $event)
    {
        if ($event->status !== 'published') {
            abort(404);
        }

        $event->load(['organizer', 'category', 'ratings.user']);

        $isRegistered = false;
        $isFavorited = false;
        $userRating = null;

        if (Auth::check()) {
            $isRegistered = EventParticipant::where('event_id', $event->id)
                ->where('user_id', Auth::id())
                ->exists();

            $isFavorited = EventFavorite::where('event_id', $event->id)
                ->where('user_id', Auth::id())
                ->exists();

            $userRating = EventRating::where('event_id', $event->id)
                ->where('user_id', Auth::id())
                ->first();
        }

        $relatedEvents = Event::published()
            ->where('id', '!=', $event->id)
            ->where('category_id', $event->category_id)
            ->take(4)
            ->get();

        return view('user.events.show', compact('event', 'isRegistered', 'isFavorited', 'userRating', 'relatedEvents'));
    }

    public function registerEvent(Event $event)
    {
        if (!$event->can_register) {
            return back()->with('error', 'Event ini tidak dapat didaftari lagi.');
        }

        // Check if user already registered
        if (EventParticipant::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->exists()) {
            return back()->with('error', 'Anda sudah terdaftar pada event ini.');
        }

        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'registered_at' => now(),
        ]);

        return back()->with('success', 'Berhasil mendaftar event! Silakan cek dashboard untuk detailnya.');
    }

    public function cancelRegistration(Event $event)
    {
        EventParticipant::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->where('status', 'registered')
            ->update(['status' => 'cancelled']);

        return back()->with('success', 'Pendaftaran berhasil dibatalkan.');
    }

    public function toggleFavorite(Event $event)
    {
        $favorite = EventFavorite::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Event dihapus dari favorit.');
        } else {
            EventFavorite::create([
                'event_id' => $event->id,
                'user_id' => Auth::id(),
            ]);
            return back()->with('success', 'Event ditambahkan ke favorit.');
        }
    }

    public function submitRating(Request $request, Event $event)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Check if user participated in this event
        $participated = EventParticipant::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->whereIn('status', ['confirmed', 'attended'])
            ->exists();

        if (!$participated) {
            return back()->with('error', 'Anda harus berpartisipasi dalam event ini untuk memberikan rating.');
        }

        // Check if user already rated
        $existingRating = EventRating::where('event_id', $event->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRating) {
            $existingRating->update([
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
            $message = 'Rating berhasil diperbarui!';
        } else {
            EventRating::create([
                'event_id' => $event->id,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
            $message = 'Rating berhasil dikirim! Rating akan ditampilkan setelah diverifikasi admin.';
        }

        return back()->with('success', $message);
    }

    public function myEvents()
    {
        $user = Auth::user();

        $myEvents = $user->eventParticipations()
            ->with(['event', 'event.category', 'event.organizer'])
            ->latest()
            ->paginate(10);

        return view('user.my-events', compact('myEvents'));
    }

    public function myFavorites()
    {
        $favorites = Auth::user()->eventFavorites()
            ->with(['event', 'event.category', 'event.organizer'])
            ->latest()
            ->paginate(12);

        return view('user.favorites', compact('favorites'));
    }

    public function myRatings()
    {
        $ratings = Auth::user()->eventRatings()
            ->with(['event', 'event.category', 'event.organizer'])
            ->latest()
            ->paginate(10);

        return view('user.ratings', compact('ratings'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $user->update($request->only([
            'name', 'email', 'phone', 'bio'
        ]));

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->route('user.events.index');
        }

        $events = Event::with(['organizer', 'category'])
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('location', 'like', "%{$query}%")
                  ->orWhereHas('category', function ($q) use ($query) {
                      $q->where('name', 'like', "%{$query}%");
                  });
            })
            ->latest()
            ->paginate(12);

        return view('user.search', compact('events', 'query'));
    }

    public function settings()
    {
        // Get user settings
        $settings = [
            'email_notifications' => true,
            'sms_notifications' => false,
            'event_recommendations' => true,
            'marketing_emails' => false,
            'public_profile' => true,
            'show_attended_events' => true,
        ];

        return view('user.settings', compact('settings'));
    }
}
