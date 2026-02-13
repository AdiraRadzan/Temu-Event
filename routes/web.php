<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventOrganizerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;

// Public Routes
Route::get('/', function() {
    $events = \App\Models\Event::latest()->take(6)->get();
    return view('welcome-promotional', compact('events'));
})->name('welcome');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/user/events', [EventController::class, 'index'])->name('user.events.index');
Route::get('/categories', [EventController::class, 'categories'])->name('categories.index');
Route::get('/search', [UserController::class, 'search'])->name('user.search');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Test login route without CSRF for testing
Route::post('/test-login', function() {
    try {
        $credentials = request()->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            $user = Auth::user();
            
            // Redirect based on role
            $redirectUrl = match($user->role) {
                'admin' => '/admin/dashboard',
                'event_organizer' => '/organizer/dashboard', 
                'user' => '/user/dashboard',
                default => '/dashboard'
            };
            
            return response()->json([
                'success' => true, 
                'message' => 'Login successful', 
                'user' => $user,
                'redirect' => $redirectUrl
            ]);
        }
        
        return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
    } catch (Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
})->middleware('guest');

// Test logout route
Route::post('/test-logout', function() {
    try {
        if (Auth::check()) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return response()->json(['success' => true, 'message' => 'Logout successful']);
        }
        return response()->json(['success' => false, 'message' => 'Not logged in'], 401);
    } catch (Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::post('/events/{event}/register', [UserController::class, 'registerEvent'])->name('user.events.register');
    Route::delete('/events/{event}/cancel', [UserController::class, 'cancelRegistration'])->name('user.events.cancel');
    Route::post('/events/{event}/favorite', [UserController::class, 'toggleFavorite'])->name('user.events.favorite');
    Route::post('/events/{event}/rating', [UserController::class, 'submitRating'])->name('user.events.rating');
    Route::get('/my-events', [UserController::class, 'myEvents'])->name('user.my-events');
    Route::get('/favorites', [UserController::class, 'myFavorites'])->name('user.favorites');
    Route::get('/ratings', [UserController::class, 'myRatings'])->name('user.ratings');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
});

// Event Organizer Routes
Route::middleware(['auth', 'role:event_organizer'])->prefix('organizer')->name('organizer.')->group(function () {
    Route::get('/dashboard', [EventOrganizerController::class, 'dashboard'])->name('dashboard');
    Route::get('/pending-verification', [EventOrganizerController::class, 'dashboard'])->name('pending');
    
    // Events Management
    Route::resource('events', EventOrganizerController::class);
    Route::post('/events/{event}/publish', [EventOrganizerController::class, 'publishEvent'])->name('events.publish');
    Route::post('/events/{event}/cancel', [EventOrganizerController::class, 'cancelEvent'])->name('events.cancel');
    Route::get('/events/{event}/participants', [EventOrganizerController::class, 'participants'])->name('events.participants');
    Route::put('/participants/{participant}/{status}', [EventOrganizerController::class, 'updateParticipantStatus'])->name('participants.update');
    Route::get('/events/{event}/ratings', [EventOrganizerController::class, 'ratings'])->name('events.ratings');
    
    // Profile
    Route::get('/profile', [EventOrganizerController::class, 'profile'])->name('profile');
    Route::put('/profile', [EventOrganizerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [EventOrganizerController::class, 'settings'])->name('settings');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/organizers', [AdminController::class, 'organizers'])->name('organizers.index');
    Route::post('/organizers/{user}/approve', [AdminController::class, 'approveOrganizer'])->name('organizers.approve');
    Route::post('/organizers/{user}/reject', [AdminController::class, 'rejectOrganizer'])->name('organizers.reject');
    
    // Event Management
    Route::get('/events', [AdminController::class, 'events'])->name('events.index');
    Route::get('/events/{event}', [AdminController::class, 'showEvent'])->name('events.show');
    Route::post('/events/{event}/approve', [AdminController::class, 'approveEvent'])->name('events.approve');
    Route::post('/events/{event}/reject', [AdminController::class, 'rejectEvent'])->name('events.reject');
    Route::get('/featured-events', [AdminController::class, 'featuredEvents'])->name('events.featured');
    Route::post('/events/{event}/toggle-featured', [AdminController::class, 'toggleFeatured'])->name('events.toggle-featured');
    
    // Rating Management
    Route::get('/ratings', [AdminController::class, 'ratings'])->name('ratings.index');
    Route::post('/ratings/{rating}/approve', [AdminController::class, 'approveRating'])->name('ratings.approve');
    Route::delete('/ratings/{rating}', [AdminController::class, 'rejectRating'])->name('ratings.reject');
    
    // Analytics
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    
    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    
    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
});

