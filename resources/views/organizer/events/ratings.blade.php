@extends('layouts.app-v2')

@section('title', 'Rating & Ulasan - ' . $event->title)

@push('styles')
<style>
    .modern-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .event-summary-card {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border-radius: var(--radius-xl, 1rem);
        padding: 1.5rem;
        color: white;
    }
    
    .stat-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .form-control-modern, .form-select-modern {
        border: 2px solid var(--slate-200, #e2e8f0);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.625rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control-modern:focus, .form-select-modern:focus {
        border-color: var(--warning-500, #f59e0b);
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border: none;
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.625rem 1.25rem;
        font-weight: 600;
        color: white;
    }
    
    .btn-primary-modern:hover {
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .rating-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .rating-card:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.5rem;
    }
    
    .rating-stars {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .rating-stars .fas, .rating-stars .far {
        color: var(--warning-500, #f59e0b);
        font-size: 1.25rem;
    }
    
    .sub-rating {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .sub-rating .fas, .sub-rating .far {
        color: var(--warning-500, #f59e0b);
        font-size: 0.875rem;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md, 0.5rem);
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .status-approved {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
        color: var(--success-700, #047857);
    }
    
    .status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);
        color: var(--warning-700, #b45309);
    }
    
    .progress-modern {
        height: 24px;
        border-radius: var(--radius-lg, 0.75rem);
        background: var(--slate-100, #f1f5f9);
        overflow: hidden;
    }
    
    .progress-modern .progress-bar {
        border-radius: var(--radius-lg, 0.75rem);
    }
    
    .insights-card {
        background: var(--slate-50, #f8fafc);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 1rem;
    }
    
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-state-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .alert-modern {
        border-radius: var(--radius-lg, 0.75rem);
        border: none;
        padding: 0.75rem 1rem;
    }
</style>
@endpush

@section('page-header')
<div class="page-header" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);">
    <div class="container-fluid py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('organizer.dashboard') }}" class="text-decoration-none" style="color: var(--warning-700, #b45309);">
                                <i class="fas fa-home me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('organizer.events.show', $event) }}" class="text-decoration-none" style="color: var(--warning-700, #b45309);">{{ Str::limit($event->title, 20) }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: var(--warning-800, #92400e);">Rating</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2" style="color: var(--warning-900, #78350f);">
                    <i class="fas fa-star me-3"></i>
                    Rating & Ulasan
                </h1>
                <p class="mb-0" style="color: var(--warning-700, #b45309);">
                    {{ $event->title }}
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="d-inline-block text-center px-4 py-2 rounded-3" style="background: rgba(255,255,255,0.5);">
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="fs-2 fw-bold me-2" style="color: var(--warning-800, #92400e);">
                            @if($ratings->where('is_approved', true)->count() > 0)
                                {{ number_format($ratings->where('is_approved', true)->avg('rating'), 1) }}
                            @else
                                0.0
                            @endif
                        </span>
                        <i class="fas fa-star text-warning fs-4"></i>
                    </div>
                    <div class="small" style="color: var(--warning-700, #b45309);">{{ $ratings->where('is_approved', true)->count() }} Ulasan</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Event Summary -->
    <div class="event-summary-card mb-4">
        <div class="row align-items-center">
            <div class="col-auto">
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                         class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                @else
                    <div class="rounded d-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px; background: rgba(255,255,255,0.2);">
                        <i class="fas fa-calendar-alt fs-2 opacity-75"></i>
                    </div>
                @endif
            </div>
            <div class="col">
                <h4 class="mb-1 fw-bold">{{ $event->title }}</h4>
                <div class="d-flex flex-wrap gap-3 opacity-75">
                    <span><i class="fas fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y H:i') }} WIB</span>
                    <span><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value text-primary">{{ $ratings->count() }}</div>
                <div class="text-muted small">Total Rating</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value text-success">{{ $ratings->where('is_approved', true)->count() }}</div>
                <div class="text-muted small">Approved</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value text-warning">{{ $ratings->where('is_approved', false)->count() }}</div>
                <div class="text-muted small">Pending</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value" style="color: var(--warning-500, #f59e0b);">{{ number_format($ratings->where('is_approved', true)->avg('rating') ?? 0, 1) }}</div>
                <div class="text-muted small">Rata-rata</div>
            </div>
        </div>
    </div>

    <!-- Rating Distribution -->
    @if($ratings->where('is_approved', true)->count() > 0)
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="modern-card">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4"><i class="fas fa-chart-bar text-warning me-2"></i>Distribusi Rating</h6>
                        @for($i = 5; $i >= 1; $i--)
                            @php
                                $count = $ratings->where('is_approved', true)->where('rating', $i)->count();
                                $total = $ratings->where('is_approved', true)->count();
                                $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                            @endphp
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3" style="width: 70px;">
                                    <span class="fw-semibold">{{ $i }}</span>
                                    <i class="fas fa-star text-warning ms-1"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="progress-modern">
                                        <div class="progress-bar" role="progressbar" 
                                             style="width: {{ $percentage }}%; background: {{ $i >= 4 ? 'linear-gradient(135deg, #10b981 0%, #059669 100%)' : ($i >= 3 ? 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)' : 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)') }};">
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-3" style="width: 80px; text-align: right;">
                                    <span class="small fw-semibold">{{ $count }}</span>
                                    <span class="small text-muted">({{ number_format($percentage, 0) }}%)</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="modern-card h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4"><i class="fas fa-lightbulb text-warning me-2"></i>Insights</h6>
                        
                        <div class="insights-card mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small">Rating Tinggi (4-5)</span>
                                <span class="badge bg-success">{{ $ratings->where('is_approved', true)->whereIn('rating', [4, 5])->count() }}</span>
                            </div>
                        </div>
                        <div class="insights-card mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small">Rating Sedang (3)</span>
                                <span class="badge bg-warning text-dark">{{ $ratings->where('is_approved', true)->where('rating', 3)->count() }}</span>
                            </div>
                        </div>
                        <div class="insights-card mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small">Rating Rendah (1-2)</span>
                                <span class="badge bg-danger">{{ $ratings->where('is_approved', true)->whereIn('rating', [1, 2])->count() }}</span>
                            </div>
                        </div>
                        
                        @php
                            $approvedTotal = max($ratings->where('is_approved', true)->count(), 1);
                            $highRatingPercentage = $ratings->where('is_approved', true)->whereIn('rating', [4, 5])->count() / $approvedTotal;
                            $lowRatingPercentage = $ratings->where('is_approved', true)->whereIn('rating', [1, 2])->count() / $approvedTotal;
                        @endphp
                        
                        @if($highRatingPercentage > 0.7)
                            <div class="alert alert-modern bg-success bg-opacity-10 text-success">
                                <i class="fas fa-check-circle me-2"></i>
                                <small>Event mendapat feedback positif!</small>
                            </div>
                        @elseif($lowRatingPercentage > 0.3)
                            <div class="alert alert-modern bg-warning bg-opacity-10 text-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <small>Perlu perbaikan berdasarkan feedback</small>
                            </div>
                        @else
                            <div class="alert alert-modern bg-info bg-opacity-10 text-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Feedback bervariasi, terus tingkatkan!</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Filters -->
    <div class="modern-card mb-4">
        <div class="card-body p-4">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label for="status" class="form-label fw-semibold small">Status</label>
                    <select class="form-select form-select-modern" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="rating" class="form-label fw-semibold small">Rating</label>
                    <select class="form-select form-select-modern" id="rating" name="rating">
                        <option value="">Semua Rating</option>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold small">Cari</label>
                    <input type="text" class="form-control form-control-modern" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Nama user, ulasan...">
                </div>
                <div class="col-md-2">
                    <label for="sort" class="form-label fw-semibold small">Urutkan</label>
                    <select class="form-select form-select-modern" id="sort" name="sort">
                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="rating_high" {{ request('sort') == 'rating_high' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="rating_low" {{ request('sort') == 'rating_low' ? 'selected' : '' }}>Rating Terendah</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-modern w-100">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Ratings List -->
    @if($ratings->count() > 0)
        @foreach($ratings as $rating)
            <div class="rating-card">
                <div class="row">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <div class="user-avatar mx-auto mb-2" style="background: linear-gradient(135deg, var(--warning-400, #fbbf24) 0%, var(--orange-400, #fb923c) 100%); color: white;">
                            {{ strtoupper(substr($rating->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <h6 class="mb-1 fw-semibold">{{ $rating->user->name ?? 'User' }}</h6>
                        @if($rating->anonymous ?? false)
                            <small class="text-muted">(Anonim)</small>
                        @else
                            <small class="text-muted">{{ $rating->user->email ?? '' }}</small>
                        @endif
                    </div>
                    
                    <div class="col-md-7 mb-3 mb-md-0">
                        <!-- Main Rating -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="rating-stars me-3">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating->rating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="badge bg-warning text-dark">{{ $rating->rating }}/5</span>
                        </div>
                        
                        <!-- Sub Ratings -->
                        @if($rating->content_rating || $rating->management_rating)
                            <div class="row mb-3">
                                @if($rating->content_rating)
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Konten Event:</small>
                                        <div class="sub-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating->content_rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                @endif
                                @if($rating->management_rating)
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Manajemen:</small>
                                        <div class="sub-rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating->management_rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        
                        <!-- Review Text -->
                        @if($rating->review)
                            <div class="p-3 rounded mb-3" style="background: var(--slate-50, #f8fafc);">
                                <p class="mb-0">{{ $rating->review }}</p>
                            </div>
                        @endif
                        
                        <!-- Recommendation -->
                        @if($rating->would_recommend ?? false)
                            <div class="alert alert-modern bg-success bg-opacity-10 text-success mb-0">
                                <i class="fas fa-thumbs-up me-2"></i>
                                <small>User merekomendasikan event ini</small>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-3 text-center">
                        <!-- Status -->
                        <div class="mb-3">
                            @if($rating->is_approved)
                                <span class="status-badge status-approved">
                                    <i class="fas fa-check-circle me-1"></i>Approved
                                </span>
                            @else
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock me-1"></i>Pending
                                </span>
                            @endif
                        </div>
                        
                        <!-- Date -->
                        <div class="mb-3">
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($rating->created_at)->format('d M Y') }}<br>
                                {{ \Carbon\Carbon::parse($rating->created_at)->format('H:i') }} WIB
                            </small>
                        </div>
                        
                        @if(!$rating->is_approved)
                            <div class="alert alert-modern bg-info bg-opacity-10 text-info small mb-0">
                                <i class="fas fa-info-circle me-1"></i>Menunggu approval admin
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        
        <!-- Pagination -->
        @if($ratings->hasPages())
            <div class="mt-4">
                {{ $ratings->links() }}
            </div>
        @endif
    @else
        <div class="modern-card">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-star text-warning fs-1"></i>
                </div>
                <h4 class="mb-2 fw-bold">Belum Ada Rating</h4>
                <p class="text-muted mb-4">Event ini belum menerima rating atau ulasan apapun.</p>
                <a href="{{ route('events.show', $event) }}" class="btn btn-primary-modern">
                    <i class="fas fa-share-alt me-2"></i>Bagikan Event
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
