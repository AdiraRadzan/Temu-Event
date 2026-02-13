@extends('layouts.app-v2')

@section('title', $event->title . ' - TemuEvent')

@push('styles')
<style>
    .modern-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .modern-card:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .modern-card .card-header {
        background: transparent;
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
        padding: 1.25rem 1.5rem;
    }
    
    .modern-card .card-body {
        padding: 1.5rem;
    }
    
    .event-hero {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border-radius: var(--radius-xl, 1rem);
        overflow: hidden;
        position: relative;
    }
    
    .event-hero-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }
    
    .event-hero-placeholder {
        width: 100%;
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--warning-400, #fbbf24) 0%, var(--orange-400, #fb923c) 100%);
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border: none;
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.625rem 1.25rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem;
        border-radius: var(--radius-lg, 0.75rem);
        background: var(--slate-50, #f8fafc);
        margin-bottom: 0.75rem;
    }
    
    .info-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-lg, 0.75rem);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .stat-card {
        text-align: center;
        padding: 1.5rem;
        border-radius: var(--radius-lg, 0.75rem);
        background: var(--slate-50, #f8fafc);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        background: var(--slate-100, #f1f5f9);
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .badge-status-published {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
        color: var(--success-700, #047857);
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md, 0.5rem);
    }
    
    .badge-status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);
        color: var(--warning-700, #b45309);
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md, 0.5rem);
    }
    
    .badge-status-draft {
        background: var(--slate-200, #e2e8f0);
        color: var(--slate-600, #475569);
        padding: 0.5rem 1rem;
        border-radius: var(--radius-md, 0.5rem);
    }
    
    .table-modern thead th {
        background: var(--slate-50, #f8fafc);
        border: none;
        padding: 0.875rem 1rem;
        font-weight: 600;
        color: var(--slate-600, #475569);
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    
    .table-modern tbody td {
        padding: 0.875rem 1rem;
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
        vertical-align: middle;
    }
    
    .rating-card {
        padding: 1rem;
        border-radius: var(--radius-lg, 0.75rem);
        background: var(--slate-50, #f8fafc);
        margin-bottom: 0.75rem;
    }
    
    .tag-badge {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);
        color: var(--warning-700, #b45309);
        padding: 0.375rem 0.75rem;
        border-radius: var(--radius-md, 0.5rem);
        font-size: 0.8rem;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
        display: inline-block;
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
                            <a href="{{ route('organizer.events.index') }}" class="text-decoration-none" style="color: var(--warning-700, #b45309);">Event</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: var(--warning-800, #92400e);">{{ Str::limit($event->title, 30) }}</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2" style="color: var(--warning-900, #78350f);">
                    <i class="fas fa-calendar-check me-3"></i>
                    {{ $event->title }}
                </h1>
                <p class="mb-0" style="color: var(--warning-700, #b45309);">
                    Detail dan informasi lengkap event
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="d-flex gap-2 justify-content-lg-end">
                    <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-primary-modern">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    @if($event->status === 'draft')
                        <form action="{{ route('organizer.events.publish', $event) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-1"></i>Publish
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Event Hero -->
            <div class="event-hero mb-4">
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="event-hero-image">
                @else
                    <div class="event-hero-placeholder">
                        <i class="fas fa-calendar-alt text-white" style="font-size: 4rem; opacity: 0.5;"></i>
                    </div>
                @endif
            </div>
            
            <!-- Event Details -->
            <div class="modern-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-info-circle text-warning me-2"></i>
                        Informasi Event
                    </h5>
                    @if($event->status === 'published')
                        <span class="badge badge-status-published"><i class="fas fa-check-circle me-1"></i>Published</span>
                    @elseif($event->status === 'pending')
                        <span class="badge badge-status-pending"><i class="fas fa-clock me-1"></i>Pending</span>
                    @else
                        <span class="badge badge-status-draft"><i class="fas fa-file-alt me-1"></i>Draft</span>
                    @endif
                </div>
                <div class="card-body">
                    <!-- Category & Type -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);">
                                    <i class="fas fa-tag text-primary"></i>
                                </div>
                                <div>
                                    <div class="small text-muted mb-1">Kategori</div>
                                    <div class="fw-semibold">{{ $event->category->name ?? 'Uncategorized' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                    <i class="fas fa-ticket-alt text-success"></i>
                                </div>
                                <div>
                                    <div class="small text-muted mb-1">Tipe Event</div>
                                    <div class="fw-semibold">
                                        @if($event->event_type === 'free')
                                            <span class="text-success">Gratis</span>
                                        @else
                                            Rp {{ number_format($event->price ?? 0, 0, ',', '.') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">
                            <i class="fas fa-align-left text-warning me-2"></i>Deskripsi
                        </h6>
                        <p class="text-muted">{{ $event->description }}</p>
                        @if($event->short_description)
                            <div class="alert alert-light border mt-3">
                                <strong>Ringkasan:</strong> {{ $event->short_description }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Date & Time -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);">
                                    <i class="fas fa-calendar-alt text-warning"></i>
                                </div>
                                <div>
                                    <div class="small text-muted mb-1">Tanggal</div>
                                    <div class="fw-semibold">{{ \Carbon\Carbon::parse($event->start_date)->format('d F Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(124, 58, 237, 0.2) 100%);">
                                    <i class="fas fa-clock" style="color: #8b5cf6;"></i>
                                </div>
                                <div>
                                    <div class="small text-muted mb-1">Waktu</div>
                                    <div class="fw-semibold">{{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location -->
                    <div class="info-item mb-4">
                        <div class="info-icon" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);">
                            <i class="fas fa-map-marker-alt text-danger"></i>
                        </div>
                        <div>
                            <div class="small text-muted mb-1">Lokasi</div>
                            <div class="fw-semibold">{{ $event->location }}</div>
                            @if($event->venue)
                                <div class="text-muted small">{{ $event->venue }}</div>
                            @endif
                            @if($event->address)
                                <div class="text-muted small mt-1">{{ $event->address }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Capacity -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="info-item mb-0">
                                <div class="info-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <div>
                                    <div class="small text-muted mb-1">Kapasitas</div>
                                    <div class="fw-semibold">{{ $event->max_participants ?? 'Tidak terbatas' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item mb-0">
                                <div class="info-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                    <i class="fas fa-user-check text-success"></i>
                                </div>
                                <div>
                                    <div class="small text-muted mb-1">Terdaftar</div>
                                    <div class="fw-semibold">{{ $event->participants->count() ?? 0 }} Peserta</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    @if($event->tags && count($event->tags) > 0)
                        <div class="mb-4">
                            <h6 class="fw-semibold mb-3">
                                <i class="fas fa-tags text-warning me-2"></i>Tags
                            </h6>
                            <div>
                                @foreach($event->tags as $tag)
                                    <span class="tag-badge">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Contact -->
                    @if($event->contact_info)
                        <div class="info-item mb-0">
                            <div class="info-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                <i class="fas fa-phone text-success"></i>
                            </div>
                            <div>
                                <div class="small text-muted mb-1">Kontak</div>
                                <div class="fw-semibold">{{ $event->contact_info }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Participants -->
            <div class="modern-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-users text-warning me-2"></i>
                        Daftar Peserta ({{ $event->participants->count() ?? 0 }})
                    </h5>
                    <a href="{{ route('organizer.events.participants', $event) }}" class="btn btn-sm btn-primary-modern">
                        <i class="fas fa-users me-1"></i>Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    @if($event->participants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-modern mb-0">
                                <thead>
                                    <tr>
                                        <th>Peserta</th>
                                        <th>Status</th>
                                        <th>Terdaftar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->participants->take(5) as $participant)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--warning-100, #fef3c7) 0%, var(--orange-100, #ffedd5) 100%);">
                                                        <i class="fas fa-user text-warning"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-semibold">{{ $participant->user->name }}</div>
                                                        <div class="text-muted small">{{ $participant->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($participant->status === 'registered')
                                                    <span class="badge bg-info">Terdaftar</span>
                                                @elseif($participant->status === 'confirmed')
                                                    <span class="badge bg-success">Dikonfirmasi</span>
                                                @elseif($participant->status === 'attended')
                                                    <span class="badge bg-primary">Hadir</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($participant->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ \Carbon\Carbon::parse($participant->registered_at ?? $participant->created_at)->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($event->participants->count() > 5)
                            <div class="text-center mt-4">
                                <a href="{{ route('organizer.events.participants', $event) }}" class="btn btn-primary-modern">
                                    Lihat {{ $event->participants->count() - 5 }} peserta lainnya
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                 style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--slate-100, #f1f5f9) 0%, var(--slate-200, #e2e8f0) 100%);">
                                <i class="fas fa-users text-muted fs-2"></i>
                            </div>
                            <p class="text-muted mb-0">Belum ada peserta yang terdaftar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Stats -->
            <div class="modern-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-chart-bar text-warning me-2"></i>
                        Statistik Event
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-card">
                                <div class="stat-value text-primary">{{ $event->participants->count() ?? 0 }}</div>
                                <div class="text-muted small">Peserta</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card">
                                <div class="stat-value text-warning">{{ $event->ratings->count() ?? 0 }}</div>
                                <div class="text-muted small">Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="modern-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-edit me-2"></i>Edit Event
                    </a>
                    <a href="{{ route('organizer.events.participants', $event) }}" class="btn btn-outline-success w-100 mb-2">
                        <i class="fas fa-users me-2"></i>Kelola Peserta
                    </a>
                    <a href="{{ route('organizer.events.ratings', $event) }}" class="btn btn-outline-warning w-100">
                        <i class="fas fa-star me-2"></i>Lihat Rating
                    </a>
                </div>
            </div>
            
            <!-- Recent Ratings -->
            @if($event->ratings && $event->ratings->count() > 0)
                <div class="modern-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-star text-warning me-2"></i>
                            Rating Terbaru
                        </h5>
                        <a href="{{ route('organizer.events.ratings', $event) }}" class="btn btn-sm btn-outline-warning">
                            Semua
                        </a>
                    </div>
                    <div class="card-body">
                        @foreach($event->ratings->take(3) as $rating)
                            <div class="rating-card">
                                <div class="d-flex align-items-center mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-2 small text-muted">{{ $rating->rating }}/5</span>
                                </div>
                                <p class="small text-muted mb-2">{{ Str::limit($rating->review, 80) }}</p>
                                <div class="small fw-semibold">{{ $rating->user->name ?? 'Anonim' }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
