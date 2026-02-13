@extends('layouts.app-v2')

@section('title', 'Detail User - ' . $user->name)

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($user->name, 20) }}</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    {{ $user->name }}
                </h1>
                <p class="page-description mb-0">Detail informasi pengguna</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-xl-4 col-lg-5">
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon"><i class="fas fa-id-card"></i></div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Informasi Profil</h5>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="profile-section text-center mb-4">
                        <div class="profile-avatar-xl">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <h4 class="mt-3 mb-2">{{ $user->name }}</h4>
                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'event_organizer' ? 'warning' : 'primary') }}-subtle text-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'event_organizer' ? 'warning' : 'primary') }} px-3 py-2">
                            <i class="fas fa-{{ $user->role === 'admin' ? 'shield-alt' : ($user->role === 'event_organizer' ? 'user-tie' : 'user') }} me-1"></i>
                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                        </span>
                    </div>

                    <div class="profile-info-list">
                        <div class="profile-info-item">
                            <div class="info-icon"><i class="fas fa-envelope"></i></div>
                            <div class="info-content">
                                <span class="info-label">Email</span>
                                <span class="info-value">{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="info-icon"><i class="fas fa-calendar-plus"></i></div>
                            <div class="info-content">
                                <span class="info-label">Bergabung</span>
                                <span class="info-value">{{ $user->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="info-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="info-content">
                                <span class="info-label">Status Email</span>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success-subtle text-success">Verified</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning">Unverified</span>
                                @endif
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="info-icon"><i class="fas fa-calendar-check"></i></div>
                            <div class="info-content">
                                <span class="info-label">Total Event</span>
                                <span class="info-value">
                                    @if($user->role === 'event_organizer')
                                        {{ $user->organizedEvents()->count() }} diorganisir
                                    @else
                                        {{ $user->eventParticipants()->count() }} diikuti
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($user->role === 'event_organizer' && $user->organizer_status === 'pending')
                        <div class="action-buttons mt-4">
                            <form action="{{ route('admin.organizers.approve', $user) }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="btn btn-success w-100 mb-2" onclick="return confirm('Setujui organizer ini?')">
                                    <i class="fas fa-check me-2"></i>Setujui Organizer
                                </button>
                            </form>
                            <form action="{{ route('admin.organizers.reject', $user) }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Tolak organizer ini?')">
                                    <i class="fas fa-times me-2"></i>Tolak Organizer
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-xl-8 col-lg-7">
            <!-- Events Card -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-success-subtle">
                        <i class="fas fa-calendar-alt text-success"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">{{ $user->role === 'event_organizer' ? 'Event yang Diorganisir' : 'Event yang Diikuti' }}</h5>
                        <p class="card-subtitle mb-0">10 event terbaru</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($user->role === 'event_organizer')
                        @php
                            $organizedEvents = $user->organizedEvents()->with('category')->latest()->take(10)->get();
                        @endphp
                        
                        @if($organizedEvents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($organizedEvents as $event)
                                        <tr>
                                            <td>
                                                <div class="event-cell">
                                                    <span class="event-title">{{ Str::limit($event->title, 30) }}</span>
                                                    @if($event->is_featured)
                                                        <i class="fas fa-star text-warning ms-1"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td><span class="badge bg-secondary-subtle text-secondary">{{ $event->category->name ?? 'No Category' }}</span></td>
                                            <td>
                                                <span class="badge bg-{{ $event->status === 'approved' ? 'success' : ($event->status === 'pending' ? 'warning' : 'danger') }}-subtle text-{{ $event->status === 'approved' ? 'success' : ($event->status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($event->status) }}
                                                </span>
                                            </td>
                                            <td><span class="date-text">{{ $event->event_date ? $event->event_date->format('d M Y') : 'TBD' }}</span></td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.events.show', $event) }}" class="btn btn-action btn-view"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state py-5">
                                <div class="empty-state-icon bg-secondary-subtle"><i class="fas fa-calendar-times text-secondary"></i></div>
                                <h6 class="empty-state-title">Belum Ada Event</h6>
                                <p class="empty-state-description">User belum mengorganisir event apapun.</p>
                            </div>
                        @endif
                    @else
                        @php
                            $participatedEvents = $user->eventParticipants()->with('event.category')->latest()->take(10)->get();
                        @endphp
                        
                        @if($participatedEvents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($participatedEvents as $participant)
                                        @php $event = $participant->event; @endphp
                                        <tr>
                                            <td>
                                                <div class="event-cell">
                                                    <span class="event-title">{{ Str::limit($event->title, 30) }}</span>
                                                    @if($event->is_featured)
                                                        <i class="fas fa-star text-warning ms-1"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td><span class="badge bg-secondary-subtle text-secondary">{{ $event->category->name ?? 'No Category' }}</span></td>
                                            <td>
                                                <span class="badge bg-{{ $participant->status === 'confirmed' ? 'success' : ($participant->status === 'pending' ? 'warning' : 'danger') }}-subtle text-{{ $participant->status === 'confirmed' ? 'success' : ($participant->status === 'pending' ? 'warning' : 'danger') }}">
                                                    {{ ucfirst($participant->status) }}
                                                </span>
                                            </td>
                                            <td><span class="date-text">{{ $event->event_date ? $event->event_date->format('d M Y') : 'TBD' }}</span></td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.events.show', $event) }}" class="btn btn-action btn-view"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state py-5">
                                <div class="empty-state-icon bg-secondary-subtle"><i class="fas fa-calendar-times text-secondary"></i></div>
                                <h6 class="empty-state-title">Belum Ada Event</h6>
                                <p class="empty-state-description">User belum mengikuti event apapun.</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Activity Stats Card -->
            <div class="card card-modern mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-info-subtle"><i class="fas fa-chart-line text-info"></i></div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Statistik Aktivitas</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="stats-grid-4">
                        <div class="stat-box">
                            <span class="stat-number text-primary">{{ $user->created_at->diffInDays(now()) }}</span>
                            <span class="stat-label">Hari Member</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number text-success">
                                {{ $user->role === 'event_organizer' ? $user->organizedEvents()->count() : $user->eventParticipants()->count() }}
                            </span>
                            <span class="stat-label">Total Event</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number text-warning">{{ $user->eventFavorites()->count() }}</span>
                            <span class="stat-label">Favorit</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number text-info">{{ $user->eventRatings()->count() }}</span>
                            <span class="stat-label">Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Card Modern */
    .card-modern { background: var(--glass-bg); backdrop-filter: blur(20px); border-radius: var(--radius-xl); border: 1px solid var(--glass-border); box-shadow: var(--shadow-md); }
    .card-header-modern { display: flex; align-items: center; gap: 1rem; padding: 1.25rem 1.5rem; background: transparent; border-bottom: 1px solid var(--border-light); }
    .card-header-icon { width: 40px; height: 40px; border-radius: var(--radius-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .card-header-content .card-title { font-weight: 600; color: var(--text-primary); }
    .card-header-content .card-subtitle { font-size: 0.8rem; color: var(--text-muted); }

    /* Profile Section */
    .profile-avatar-xl { width: 88px; height: 88px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 600; margin: 0 auto; }

    /* Profile Info List */
    .profile-info-list { border-top: 1px solid var(--border-light); padding-top: 1rem; }
    .profile-info-item { display: flex; align-items: center; gap: 1rem; padding: 0.75rem 0; border-bottom: 1px solid var(--border-light); }
    .profile-info-item:last-child { border-bottom: none; }
    .profile-info-item .info-icon { width: 36px; height: 36px; border-radius: var(--radius-md); background: var(--surface); display: flex; align-items: center; justify-content: center; color: var(--text-muted); flex-shrink: 0; }
    .profile-info-item .info-content { flex: 1; }
    .profile-info-item .info-label { display: block; font-size: 0.75rem; color: var(--text-muted); }
    .profile-info-item .info-value { font-weight: 600; color: var(--text-primary); font-size: 0.875rem; }

    /* Table Modern */
    .table-modern { margin: 0; }
    .table-modern thead th { background: var(--surface); padding: 1rem 1.25rem; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); border-bottom: 1px solid var(--border-light); }
    .table-modern tbody td { padding: 1rem 1.25rem; vertical-align: middle; border-bottom: 1px solid var(--border-light); }
    .table-modern tbody tr:hover { background: rgba(var(--primary-rgb), 0.03); }

    /* Event Cell */
    .event-cell { display: flex; align-items: center; }
    .event-title { font-weight: 600; color: var(--text-primary); }
    .date-text { font-size: 0.8rem; color: var(--text-muted); }
    .btn-action { width: 32px; height: 32px; padding: 0; border-radius: var(--radius-md); display: inline-flex; align-items: center; justify-content: center; border: 1px solid var(--border-light); background: var(--surface); color: var(--text-muted); transition: all 0.2s ease; }
    .btn-view:hover { background: var(--primary); border-color: var(--primary); color: white; }

    /* Stats Grid */
    .stats-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; }
    @media (max-width: 767.98px) { .stats-grid-4 { grid-template-columns: repeat(2, 1fr); } }
    .stat-box { background: var(--surface); padding: 1.25rem 1rem; border-radius: var(--radius-lg); text-align: center; }
    .stat-number { display: block; font-size: 1.5rem; font-weight: 700; }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); }

    /* Empty State */
    .empty-state { text-align: center; }
    .empty-state-icon { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; }
    .empty-state-title { color: var(--text-primary); font-weight: 600; margin-bottom: 0.5rem; }
    .empty-state-description { color: var(--text-muted); font-size: 0.875rem; margin: 0; }

    /* Breadcrumb & Title */
    .breadcrumb-modern { background: transparent; padding: 0; margin: 0; }
    .breadcrumb-modern .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-modern .breadcrumb-item.active { color: rgba(255,255,255,0.9); }
    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
    .title-icon { display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: var(--radius-lg); margin-right: 1rem; }
</style>
@endpush
@endsection
