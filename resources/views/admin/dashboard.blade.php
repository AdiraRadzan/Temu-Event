@extends('layouts.app-v2')

@section('title', 'Admin Dashboard')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </span>
                    Admin Dashboard
                </h1>
                <p class="page-description mb-0">
                    Selamat datang kembali! Berikut ringkasan aktivitas platform hari ini.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="header-actions">
                    <span class="badge badge-glass px-3 py-2">
                        <i class="fas fa-clock me-2"></i>
                        Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Total Pengguna</span>
                        <h3 class="stat-value">{{ number_format($stats['total_users'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+5% minggu ini</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('admin.users.index') }}" class="stat-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Total Event</span>
                        <h3 class="stat-value">{{ number_format($stats['total_events'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12% bulan ini</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('admin.events.index') }}" class="stat-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Menunggu Verifikasi</span>
                        <h3 class="stat-value">{{ number_format($stats['pending_organizers'] ?? 0) }}</h3>
                        <div class="stat-change warning">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Perlu tindakan</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('admin.organizers.index') }}" class="stat-link">
                        Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Event Aktif</span>
                        <h3 class="stat-value">{{ number_format($stats['active_events'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-chart-line"></i>
                            <span>Berkembang stabil</span>
                        </div>
                    </div>
                </div>
                <div class="stat-card-footer">
                    <a href="{{ route('admin.events.index') }}" class="stat-link">
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
                        <p class="card-subtitle mb-0">Akses cepat ke fitur utama</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.users.index') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-primary-subtle">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Kelola Pengguna</h6>
                                    <span>Lihat & kelola semua pengguna</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.events.index') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-success-subtle">
                                    <i class="fas fa-calendar-alt text-success"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Kelola Event</h6>
                                    <span>Atur & moderasi event</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.organizers.index') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-warning-subtle">
                                    <i class="fas fa-user-tie text-warning"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Verifikasi Organizer</h6>
                                    <span>Proses permintaan organizer</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <a href="{{ route('admin.analytics') }}" class="quick-action-card">
                                <div class="quick-action-icon bg-info-subtle">
                                    <i class="fas fa-chart-line text-info"></i>
                                </div>
                                <div class="quick-action-content">
                                    <h6>Lihat Analitik</h6>
                                    <span>Statistik & laporan</span>
                                </div>
                                <i class="fas fa-chevron-right quick-action-arrow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Approvals Section -->
    <div class="row g-4 mb-5">
        <!-- Pending Organizers -->
        <div class="col-xl-6">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Permintaan Verifikasi Organizer</h5>
                        <p class="card-subtitle mb-0">Organizer menunggu persetujuan</p>
                    </div>
                    @if($pendingOrganizers->count() > 0)
                    <span class="badge bg-warning-subtle text-warning ms-auto">{{ $pendingOrganizers->count() }} Pending</span>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if($pendingOrganizers->count() > 0)
                        <div class="list-group list-group-flush list-group-modern">
                            @foreach($pendingOrganizers->take(5) as $organizer)
                            <div class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-3">
                                        <div class="avatar-initial bg-primary-subtle text-primary rounded-circle">
                                            {{ strtoupper(substr($organizer->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-1 text-truncate">{{ $organizer->name }}</h6>
                                        <p class="mb-0 text-muted small text-truncate">{{ $organizer->email }}</p>
                                        @if($organizer->organization_name)
                                            <span class="badge bg-light text-dark mt-1">{{ $organizer->organization_name }}</span>
                                        @endif
                                    </div>
                                    <div class="ms-3 d-flex gap-2">
                                        <a href="{{ route('admin.organizers.index') }}" class="btn btn-sm btn-success-soft" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="{{ route('admin.organizers.index') }}" class="btn btn-sm btn-danger-soft" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer text-center border-0 pt-3 pb-4">
                            <a href="{{ route('admin.organizers.index') }}" class="btn btn-primary-soft btn-sm">
                                <i class="fas fa-list me-2"></i>Lihat Semua Permintaan
                            </a>
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-success-subtle">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <h6 class="empty-state-title">Tidak Ada Permintaan</h6>
                            <p class="empty-state-description">Semua permintaan verifikasi telah diproses.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pending Events -->
        <div class="col-xl-6">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-calendar-clock"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Event Menunggu Persetujuan</h5>
                        <p class="card-subtitle mb-0">Event yang perlu direview</p>
                    </div>
                    @if($pendingEvents->count() > 0)
                    <span class="badge bg-warning-subtle text-warning ms-auto">{{ $pendingEvents->count() }} Pending</span>
                    @endif
                </div>
                <div class="card-body p-0">
                    @if($pendingEvents->count() > 0)
                        <div class="list-group list-group-flush list-group-modern">
                            @foreach($pendingEvents->take(5) as $event)
                            <a href="{{ route('admin.events.show', $event->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="event-thumbnail me-3">
                                        <div class="event-date-badge">
                                            <span class="date-day">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                                            <span class="date-month">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 min-w-0">
                                        <h6 class="mb-1 text-truncate">{{ $event->title }}</h6>
                                        <p class="mb-0 text-muted small">
                                            <i class="fas fa-user me-1"></i>{{ $event->organizer->name ?? 'Unknown' }}
                                        </p>
                                        <p class="mb-0 text-muted small">
                                            <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <div class="ms-3">
                                        <span class="badge bg-warning-subtle text-warning">Pending</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="card-footer text-center border-0 pt-3 pb-4">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-primary-soft btn-sm">
                                <i class="fas fa-list me-2"></i>Lihat Semua Event
                            </a>
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-success-subtle">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <h6 class="empty-state-title">Tidak Ada Event Pending</h6>
                            <p class="empty-state-description">Semua event telah diproses.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-stream"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                        <p class="card-subtitle mb-0">Timeline aktivitas di platform</p>
                    </div>
                </div>
                <div class="card-body">
                    @if($recentActivity->count() > 0)
                        <div class="activity-timeline">
                            @foreach($recentActivity->take(10) as $activity)
                            <div class="activity-item">
                                <div class="activity-icon 
                                    @if($activity->activity_type === 'user_registered') bg-primary-subtle
                                    @elseif($activity->activity_type === 'event_created') bg-success-subtle
                                    @elseif($activity->activity_type === 'rating_submitted') bg-warning-subtle
                                    @else bg-secondary-subtle
                                    @endif">
                                    @if($activity->activity_type === 'user_registered')
                                        <i class="fas fa-user-plus text-primary"></i>
                                    @elseif($activity->activity_type === 'event_created')
                                        <i class="fas fa-calendar-plus text-success"></i>
                                    @elseif($activity->activity_type === 'rating_submitted')
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="fas fa-circle text-secondary"></i>
                                    @endif
                                </div>
                                <div class="activity-content">
                                    <h6 class="activity-title mb-1">{{ $activity->title }}</h6>
                                    <p class="activity-time mb-0">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="activity-badge ms-auto">
                                    @if($activity->activity_type === 'user_registered')
                                        <span class="badge bg-primary-subtle text-primary">Pengguna Baru</span>
                                    @elseif($activity->activity_type === 'event_created')
                                        <span class="badge bg-success-subtle text-success">Event Baru</span>
                                    @elseif($activity->activity_type === 'rating_submitted')
                                        <span class="badge bg-warning-subtle text-warning">Ulasan Baru</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-secondary-subtle">
                                <i class="fas fa-history text-secondary"></i>
                            </div>
                            <h6 class="empty-state-title">Belum Ada Aktivitas</h6>
                            <p class="empty-state-description">Aktivitas terbaru akan muncul di sini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Stat Cards */
    .stat-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: var(--radius-xl);
        border: 1px solid var(--glass-border);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }
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
        border-top: 1px solid var(--glass-border);
    }
    .stat-link {
        font-size: 0.8rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .stat-link:hover { color: var(--primary-dark); gap: 0.5rem; }

    /* Quick Action Cards */
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
    .quick-action-content h6 {
        margin: 0;
        font-weight: 600;
        color: var(--text-primary);
    }
    .quick-action-content span {
        font-size: 0.75rem;
        color: var(--text-muted);
    }
    .quick-action-arrow {
        margin-left: auto;
        color: var(--text-muted);
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }
    .quick-action-card:hover .quick-action-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    /* Modern Card */
    .card-modern {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border-radius: var(--radius-xl);
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow-md);
    }
    .card-header-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem 1.5rem;
        background: transparent;
        border-bottom: 1px solid var(--border-light);
    }
    .card-header-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        background: var(--primary-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card-header-content .card-title { font-weight: 600; color: var(--text-primary); }
    .card-header-content .card-subtitle { font-size: 0.8rem; color: var(--text-muted); }

    /* List Group Modern */
    .list-group-modern .list-group-item {
        padding: 1rem 1.5rem;
        border: none;
        border-bottom: 1px solid var(--border-light);
        background: transparent;
        transition: background 0.2s ease;
    }
    .list-group-modern .list-group-item:hover { background: rgba(var(--primary-rgb), 0.03); }
    .list-group-modern .list-group-item:last-child { border-bottom: none; }

    /* Avatar */
    .avatar { position: relative; display: inline-flex; }
    .avatar-sm { width: 40px; height: 40px; }
    .avatar-initial {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
    }

    /* Event Date Badge */
    .event-date-badge {
        width: 48px;
        height: 56px;
        background: var(--primary-soft);
        border-radius: var(--radius-md);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .event-date-badge .date-day {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
    }
    .event-date-badge .date-month {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--primary);
        text-transform: uppercase;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 2rem;
    }
    .empty-state-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }
    .empty-state-title { color: var(--text-primary); font-weight: 600; margin-bottom: 0.5rem; }
    .empty-state-description { color: var(--text-muted); font-size: 0.875rem; margin: 0; }

    /* Activity Timeline */
    .activity-timeline { position: relative; }
    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1rem 0;
        position: relative;
    }
    .activity-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 20px;
        top: 56px;
        bottom: 0;
        width: 2px;
        background: var(--border-light);
    }
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }
    .activity-title { font-weight: 600; color: var(--text-primary); }
    .activity-time { font-size: 0.75rem; color: var(--text-muted); }

    /* Soft Buttons */
    .btn-primary-soft { background: var(--primary-soft); color: var(--primary); border: none; }
    .btn-primary-soft:hover { background: var(--primary); color: white; }
    .btn-success-soft { background: rgba(16, 185, 129, 0.1); color: var(--success); border: none; padding: 0.375rem 0.5rem; }
    .btn-success-soft:hover { background: var(--success); color: white; }
    .btn-danger-soft { background: rgba(239, 68, 68, 0.1); color: var(--danger); border: none; padding: 0.375rem 0.5rem; }
    .btn-danger-soft:hover { background: var(--danger); color: white; }

    /* Badge Glass */
    .badge-glass {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        color: white;
        font-weight: 500;
    }

    /* Breadcrumb Modern */
    .breadcrumb-modern {
        background: transparent;
        padding: 0;
        margin: 0;
    }
    .breadcrumb-modern .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-modern .breadcrumb-item a:hover { color: white; }
    .breadcrumb-modern .breadcrumb-item.active { color: rgba(255,255,255,0.9); }
    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }

    /* Title Icon */
    .title-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: rgba(255,255,255,0.15);
        border-radius: var(--radius-lg);
        margin-right: 1rem;
    }
</style>
@endpush
@endsection
