@extends('layouts.app-v2')

@section('title', 'Dashboard - TemuEvent')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb-modern mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-1">
                    <span class="title-icon">
                        <i class="fas fa-th-large"></i>
                    </span>
                    Selamat Datang, {{ auth()->user()->name }}!
                </h1>
                <p class="page-description mb-0">
                    Kelola event dan pantau aktivitas Anda di TemuEvent
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('events.index') }}" class="btn btn-light">
                    <i class="fas fa-compass me-2"></i>Jelajahi Event
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card primary">
            <div class="stat-card-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-card-value">{{ $stats['total_events'] ?? 0 }}</div>
            <div class="stat-card-label">Event Terdaftar</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card success">
            <div class="stat-card-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-card-value">{{ $stats['upcoming_events'] ?? 0 }}</div>
            <div class="stat-card-label">Event Mendatang</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card info">
            <div class="stat-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-card-value">{{ $stats['completed_events'] ?? 0 }}</div>
            <div class="stat-card-label">Event Selesai</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card danger">
            <div class="stat-card-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-card-value">{{ $stats['favorites'] ?? 0 }}</div>
            <div class="stat-card-label">Event Favorit</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Upcoming Events -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <div class="card-title-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    Event Mendatang
                </h5>
                <a href="{{ route('user.my-events') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($upcomingEvents->take(5) as $event)
                            <a href="{{ route('events.show', $event->id) }}" class="list-group-item list-group-item-action p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-lg" style="background: linear-gradient(135deg, var(--primary-500), var(--accent-violet));">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-1 fw-semibold text-truncate">{{ $event->title }}</h6>
                                        <div class="d-flex align-items-center gap-2 text-muted small">
                                            <span><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-primary">{{ $event->category->name ?? 'Event' }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state py-5">
                        <div class="empty-state-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <h6 class="text-muted">Belum ada event mendatang</h6>
                        <p class="text-muted small mb-3">Jelajahi dan daftar event sekarang!</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-compass me-1"></i>Jelajahi Event
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Favorites -->
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <div class="card-title-icon" style="background: linear-gradient(135deg, rgba(244, 63, 94, 0.2), rgba(244, 63, 94, 0.1)); color: var(--accent-rose);">
                        <i class="fas fa-heart"></i>
                    </div>
                    Event Favorit
                </h5>
                <a href="{{ route('user.favorites') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if(isset($favorites) && $favorites->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($favorites->take(5) as $event)
                            <a href="{{ route('events.show', $event->id) }}" class="list-group-item list-group-item-action p-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-lg" style="background: linear-gradient(135deg, var(--accent-rose), #fb7185);">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-1 fw-semibold text-truncate">{{ $event->title }}</h6>
                                        <div class="d-flex align-items-center gap-2 text-muted small">
                                            <span><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-primary">{{ $event->category->name ?? 'Event' }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state py-5">
                        <div class="empty-state-icon">
                            <i class="fas fa-heart-broken"></i>
                        </div>
                        <h6 class="text-muted">Belum ada event favorit</h6>
                        <p class="text-muted small mb-3">Simpan event yang Anda sukai!</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-compass me-1"></i>Jelajahi Event
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Reviews -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <div class="card-title-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2), rgba(245, 158, 11, 0.1)); color: var(--accent-amber);">
                        <i class="fas fa-star"></i>
                    </div>
                    Review Terbaru Anda
                </h5>
                <a href="{{ route('user.ratings') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if(isset($recentRatings) && $recentRatings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th>Event</th>
                                    <th>Rating</th>
                                    <th>Review</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentRatings->take(5) as $rating)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold">{{ $rating->event->title ?? 'Event' }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.75rem;"></i>
                                                @endfor
                                                <span class="ms-1 text-muted small">({{ $rating->rating }})</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ Str::limit($rating->review ?? '-', 50) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted small">{{ $rating->created_at->format('d M Y') }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('events.show', $rating->event->id ?? 1) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state py-5">
                        <div class="empty-state-icon">
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <h6 class="text-muted">Belum ada review</h6>
                        <p class="text-muted small mb-0">Berikan review untuk event yang telah Anda ikuti!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
