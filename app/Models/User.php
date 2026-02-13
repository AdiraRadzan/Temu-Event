<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'bio',
        'phone',
        'organization_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function organizedEvents()
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }

    public function eventParticipations()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function eventFavorites()
    {
        return $this->hasMany(EventFavorite::class);
    }

    public function eventRatings()
    {
        return $this->hasMany(EventRating::class);
    }

    // Scopes untuk role-based queries
    public function scopeAdmin($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeEventOrganizer($query)
    {
        return $query->where('role', 'event_organizer');
    }

    public function scopeUser($query)
    {
        return $query->where('role', 'user');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Helper methods untuk role checking
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isEventOrganizer()
    {
        return $this->role === 'event_organizer';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
