<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'image',
        'category_id',
        'organizer_id',
        'start_date',
        'end_date',
        'location',
        'venue',
        'address',
        'max_participants',
        'price',
        'event_type',
        'status',
        'is_featured',
        'requirements',
        'tags',
        'contact_info',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'max_participants' => 'integer',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'requirements' => 'array',
        'tags' => 'array',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }

    public function favorites()
    {
        return $this->hasMany(EventFavorite::class);
    }

    public function ratings()
    {
        return $this->hasMany(EventRating::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', Carbon::now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByOrganizer($query, $organizerId)
    {
        return $query->where('organizer_id', $organizerId);
    }

    // Accessor untuk rating rata-rata
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->where('is_approved', true)->avg('rating');
    }

    // Accessor untuk total participants
    public function getTotalParticipantsAttribute()
    {
        return $this->participants()->whereIn('status', ['registered', 'confirmed'])->count();
    }

    // Accessor untuk checking apakah masih bisa register
    public function getCanRegisterAttribute()
    {
        return $this->status === 'published' 
            && $this->start_date > Carbon::now()
            && ($this->max_participants === null || $this->total_participants < $this->max_participants);
    }

    // Auto-generate slug dari title
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title) . '-' . Str::random(6);
            }
        });
    }
}
