@extends('layouts.app-v2')

@section('title', 'Event Organizer Dashboard')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('organizer.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-bullhorn"></i>
                    </span>
                    Event Organizer Dashboard
                </h1>
                <p class="page-description mb-0">
                    Kelola event Anda dan kembangkan audiens dengan tools organizer yang powerful.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="badge badge-glass px-3 py-2">
                    <i class="fas fa-clock me-2"></i>
                    Update: {{ now()->format('d M Y, H:i') }}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Total Event</span>
                        <h3 class="stat-value">{{ number_format($stats['total_events'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>Event yang dibuat</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('organizer.events.index') }}" class="stat-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Event Published</span>
                        <h3 class="stat-value">{{ number_format($stats['published_events'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-globe"></i>
                            <span>Tayang di platform</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('organizer.events.index') }}" class="stat-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Total Peserta</span>
                        <h3 class="stat-value">{{ number_format($stats['total_participants'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-chart-line"></i>
                            <span>Partisipan aktif</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('organizer.events.index') }}" class="stat-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Pending Ratings</span>
                        <h3 class="stat-value">{{ number_format($stats['pending_ratings'] ?? 0) }}</h3>
                        <div class="stat-change warning">
                            <i class="fas fa-clock"></i>
                            <span>Menunggu review</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('organizer.events.index') }}" class="stat-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Aksi Cepat</h5>
                        <p class="card-subtitle mb-0">Akses cepat ke fitur utama organizer</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('organizer.events.create') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-success-subtle">
                                    <i class="fas fa-plus-circle text-success"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Buat Event Baru</h6>
                                    <span>Buat event baru sekarang</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('organizer.events.index') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-primary-subtle">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Kelola Event</h6>
                                    <span>Lihat & edit event</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('organizer.profile') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-warning-subtle">
                                    <i class="fas fa-user-tie text-warning"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Profil Organizer</h6>
                                    <span>Edit profil Anda</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('organizer.settings') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-info-subtle">
                                    <i class="fas fa-cog text-info"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Pengaturan</h6>
                                    <span>Konfigurasi akun</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events & Ratings -->
    <div class="row g-4">
        <div class="col-xl-8">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Event Terbaru</h5>
                        <p class="card-subtitle mb-0">Event yang baru Anda buat</p>
                    </div>
                    <a href="{{ route('organizer.events.create') }}" class="btn btn-primary btn-sm ms-auto">
                        <i class="fas fa-plus me-1"></i>Buat Event
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($recentEvents->count() > 0)
                        <div class="list-group list-group-flush list-group-modern">
                            @foreach($recentEvents as $event)
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="event-date-badge me-3">
                                        <span class="date-day">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                                        <span class="date-month">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</span>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-1 text-truncate">{{ $event->title }}</h6>
                                        <p class="mb-0 text-muted small">
                                            <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} WIB
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-users me-1"></i>{{ $event->participants->count() ?? 0 }} Peserta
                                        </p>
                                    </div>
                                    <div class="ms-3 d-flex align-items-center gap-2">
                                        @if($event->status === 'published' || $event->status === 'approved')
                                            <span class="badge bg-success-subtle text-success">Published</span>
                                        @elseif($event->status === 'pending')
                                            <span class="badge bg-warning-subtle text-warning">Pending</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Draft</span>
                                        @endif
                                        <a href="{{ route('organizer.events.show', $event) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer text-center border-0 pt-3 pb-4">
                            <a href="{{ route('organizer.events.index') }}" class="btn btn-primary-soft btn-sm">
                                <i class="fas fa-list me-2"></i>Lihat Semua Event
                            </a>
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-primary-subtle">
                                <i class="fas fa-calendar-plus text-primary"></i>
                            </div>
                            <h6 class="empty-state-title">Belum Ada Event</h6>
                            <p class="empty-state-description">Anda belum membuat event apapun.</p>
                            <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-2"></i>Buat Event Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-warning-subtle">
                        <i class="fas fa-star text-warning"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Rating Terbaru</h5>
                        <p class="card-subtitle mb-0">Ulasan dari peserta</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($recentRatings->count() > 0)
                        <div class="list-group list-group-flush list-group-modern">
                            @foreach($recentRatings as $rating)
                            <div class="list-group-item">
                                <div class="d-flex align-items-start">
                                    <div class="avatar avatar-sm me-3">
                                        <div class="avatar-initial bg-primary-subtle text-primary rounded-circle">
                                            {{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <div class="d-flex align-items-center mb-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.75rem;"></i>
                                            @endfor
                                            <span class="ms-2 small text-muted">{{ $rating->rating }}/5</span>
                                        </div>
                                        <p class="mb-1 small text-truncate">{{ Str::limit($rating->review, 60) }}</p>
                                        <span class="small text-muted">{{ $rating->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-warning-subtle">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <h6 class="empty-state-title">Belum Ada Rating</h6>
                            <p class="empty-state-description">Belum ada ulasan untuk event Anda.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .stat-card-body {
        padding: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .stat-card-primary .stat-icon { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
    .stat-card-success .stat-icon { background: linear-gradient(135deg, var(--success), #059669); color: white; }
    .stat-card-warning .stat-icon { background: linear-gradient(135deg, var(--warning), #d97706); color: white; }
    .stat-card-info .stat-icon { background: linear-gradient(135deg, var(--info), #0284c7); color: white; }
    
    .stat-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0.25rem 0;
        line-height: 1.2;
    }
    .stat-change {
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    .stat-change.positive { color: var(--success); }
    .stat-change.warning { color: var(--warning); }
    .stat-card-footer {
        padding: 0.75rem 1.5rem;
        background: rgba(0,0,0,0.02);
        border-top: 1px solid var(--border-light);
    }
    .stat-link {
        font-size: 0.8rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }
    .stat-link:hover { color: var(--primary-dark); }

    .quick-action-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: var(--radius-lg);
        background: var(--surface);
        border: 1px solid var(--border-light);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .quick-action-card:hover {
        background: var(--primary);
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }
    .quick-action-card:hover * { color: white !important; }
    .quick-action-card:hover .quick-action-icon { background: rgba(255,255,255,0.2) !important; }
    
    .quick-action-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .quick-action-content h6 { margin: 0; font-weight: 600; color: var(--text-primary); }
    .quick-action-content span { font-size: 0.75rem; color: var(--text-muted); }
    .quick-action-arrow {
        margin-left: auto;
        color: var(--text-muted);
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }
    .quick-action-card:hover .quick-action-arrow { opacity: 1; transform: translateX(0); }

    .event-date-badge {
        width: 48px;
        height: 56px;
        background: var(--primary-soft);
        border-radius: var(--radius-md);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .event-date-badge .date-day { font-size: 1.25rem; font-weight: 700; color: var(--primary); line-height: 1; }
    .event-date-badge .date-month { font-size: 0.7rem; font-weight: 600; color: var(--primary); text-transform: uppercase; }

    .avatar-sm { width: 36px; height: 36px; }
    .avatar-initial {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .btn-primary-soft { background: var(--primary-soft); color: var(--primary); border: none; }
    .btn-primary-soft:hover { background: var(--primary); color: white; }
</style>
@endpush
@endsection
