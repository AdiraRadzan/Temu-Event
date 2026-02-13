<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'pending_organizers' => User::where('role', 'event_organizer')->where('status', 'pending')->count(),
            'approved_organizers' => User::where('role', 'event_organizer')->where('status', 'approved')->count(),
            'total_events' => Event::count(),
            'published_events' => Event::where('status', 'published')->count(),
            'active_events' => Event::where('status', 'published')
                ->where('start_date', '>=', now())
                ->count(),
            'total_participants' => EventParticipant::count(),
            'pending_ratings' => EventRating::where('is_approved', false)->count(),
        ];

        $recentEvents = Event::with(['organizer', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $pendingOrganizers = User::where('role', 'event_organizer')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $pendingEvents = Event::where('status', 'pending')
            ->with(['organizer', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // Create recent activity from various sources
        $recentActivity = collect();
        
        // Recent users
        $recentUsers = User::latest()->take(3)->get();
        foreach ($recentUsers as $user) {
            $recentActivity->push((object)[
                'title' => "Pengguna baru: {$user->name}",
                'created_at' => $user->created_at,
                'activity_type' => 'user_registered'
            ]);
        }

        // Recent events
        $recentEvents = Event::latest()->take(3)->get();
        foreach ($recentEvents as $event) {
            $recentActivity->push((object)[
                'title' => "Event baru: {$event->title}",
                'created_at' => $event->created_at,
                'activity_type' => 'event_created'
            ]);
        }

        // Recent ratings
        $recentRatings = EventRating::latest()->take(3)->get();
        foreach ($recentRatings as $rating) {
            $recentActivity->push((object)[
                'title' => "Rating baru untuk: {$rating->event->title}",
                'created_at' => $rating->created_at,
                'activity_type' => 'rating_submitted'
            ]);
        }

        $recentActivity = $recentActivity->sortByDesc('created_at')->take(10);

        return view('admin.dashboard', compact('stats', 'recentEvents', 'pendingOrganizers', 'pendingEvents', 'recentActivity'));
    }

    public function users()
    {
        $users = User::withCount('organizedEvents')
            ->latest()
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function showUser(User $user)
    {
        $user->load(['organizedEvents', 'eventParticipations', 'eventRatings']);
        
        return view('admin.users.show', compact('user'));
    }

    public function organizers()
    {
        $organizers = User::eventOrganizer()
            ->withCount('organizedEvents')
            ->latest()
            ->paginate(15);

        return view('admin.organizers.index', compact('organizers'));
    }

    public function approveOrganizer(User $user)
    {
        if (!$user->isEventOrganizer()) {
            return back()->with('error', 'Pengguna bukan Event Organizer.');
        }

        $user->update(['status' => 'approved']);

        return back()->with('success', 'Event Organizer berhasil diverifikasi.');
    }

    public function rejectOrganizer(Request $request, User $user)
    {
        if (!$user->isEventOrganizer()) {
            return back()->with('error', 'Pengguna bukan Event Organizer.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $user->update([
            'status' => 'rejected',
            'bio' => $user->bio . "\n\nAlasan penolakan: " . $request->rejection_reason,
        ]);

        return back()->with('success', 'Event Organizer telah ditolak.');
    }

    public function events()
    {
        $events = Event::with(['organizer', 'category'])
            ->latest()
            ->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function showEvent(Event $event)
    {
        $event->load(['organizer', 'category', 'participants.user', 'ratings.user']);
        
        return view('admin.events.show', compact('event'));
    }

    public function approveEvent(Event $event)
    {
        $event->update(['status' => 'published']);

        return back()->with('success', 'Event berhasil dipublikasi.');
    }

    public function rejectEvent(Request $request, Event $event)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $event->update(['status' => 'draft']);

        // Note: Anda bisa menambahkan notifikasi ke organizer di sini

        return back()->with('success', 'Event telah ditolak.');
    }

    public function featuredEvents()
    {
        $featuredEvents = Event::featured()->with(['organizer', 'category'])->get();
        $allEvents = Event::published()->with(['organizer', 'category'])->get();

        return view('admin.events.featured', compact('featuredEvents', 'allEvents'));
    }

    public function toggleFeatured(Event $event)
    {
        $event->update(['is_featured' => !$event->is_featured]);

        $message = $event->is_featured 
            ? 'Event berhasil dijadikan featured.' 
            : 'Event berhasil dihapus dari featured.';

        return back()->with('success', $message);
    }

    public function ratings()
    {
        $ratings = EventRating::with(['event', 'user'])
            ->latest()
            ->paginate(15);

        return view('admin.ratings.index', compact('ratings'));
    }

    public function approveRating(EventRating $rating)
    {
        $rating->update(['is_approved' => true]);

        return back()->with('success', 'Rating berhasil diverifikasi.');
    }

    public function rejectRating(EventRating $rating)
    {
        $rating->delete();

        return back()->with('success', 'Rating berhasil dihapus.');
    }

    public function analytics()
    {
        $monthlyStats = Event::selectRaw('
            strftime("%m", created_at) as month,
            strftime("%Y", created_at) as year,
            COUNT(*) as events_created
        ')
        ->groupByRaw('strftime("%Y", created_at), strftime("%m", created_at)')
        ->orderByRaw('strftime("%Y", created_at) DESC, strftime("%m", created_at) DESC')
        ->take(12)
        ->get();

        $categoryStats = Event::selectRaw('event_categories.name, COUNT(events.id) as event_count')
            ->join('event_categories', 'events.category_id', '=', 'event_categories.id')
            ->groupBy('event_categories.name')
            ->orderByDesc('event_count')
            ->get();

        $topOrganizers = User::eventOrganizer()
            ->withCount('organizedEvents')
            ->get()
            ->filter(function($user) {
                return $user->organized_events_count > 0;
            })
            ->sortByDesc('organized_events_count')
            ->take(10)
            ->values();

        // Get recent activity (last 30 days)
        $recentActivity = collect([
            (object)['title' => 'User baru terdaftar', 'activity_type' => 'user_registered', 'created_at' => now()->subDays(1)],
            (object)['title' => 'Event baru dibuat', 'activity_type' => 'event_created', 'created_at' => now()->subDays(2)],
            (object)['title' => 'Rating baru disubmit', 'activity_type' => 'rating_submitted', 'created_at' => now()->subDays(3)],
        ]);

        // Get overview data
        $overview = [
            'active_users' => User::count(),
            'pending_approvals' => User::where('organizer_status', 'pending')->count() + Event::where('status', 'pending')->count(),
            'published_events' => Event::where('status', 'approved')->count(),
            'pending_events' => Event::where('status', 'pending')->count(),
            'draft_events' => Event::where('status', 'draft')->count(),
            'cancelled_events' => Event::where('status', 'cancelled')->count(),
            'engagement_rate' => EventParticipant::count() > 0 ? (EventParticipant::where('status', 'confirmed')->count() / EventParticipant::count()) * 100 : 0,
        ];

        return view('admin.analytics', compact('monthlyStats', 'categoryStats', 'topOrganizers', 'recentActivity', 'overview'));
    }

    public function settings()
    {
        // Get system settings
        $settings = [
            'site_name' => config('app.name', 'TemuEvent'),
            'site_description' => 'Platform event terpercaya di Indonesia',
            'max_events_per_organizer' => 50,
            'enable_event_approval' => true,
            'enable_user_registration' => true,
            'notification_email' => 'admin@temuanevent.com',
            'support_phone' => '+62 21 1234 5678',
        ];

        return view('admin.settings', compact('settings'));
    }

    public function profile()
    {
        $user = auth()->user();
        
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $user->update($request->only([
            'name', 'email', 'phone', 'bio'
        ]));

        return back()->with('success', 'Profil admin berhasil diperbarui!');
    }
}
