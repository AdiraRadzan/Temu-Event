@extends('layouts.app-v2')

@section('title', 'Analytics Dashboard')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-chart-line"></i>
                    </span>
                    Analytics Dashboard
                </h1>
                <p class="page-description mb-0">
                    Insight komprehensif tentang performa platform dan engagement pengguna
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="header-actions d-flex gap-2 justify-content-lg-end">
                    <button class="btn btn-outline-light" onclick="exportData()">
                        <i class="fas fa-download me-2"></i>Export
                    </button>
                    <button class="btn btn-light" onclick="refreshData()">
                        <i class="fas fa-sync-alt me-2"></i>Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<script>
function exportData() {
    const link = document.createElement('a');
    link.href = '/admin/analytics/export';
    link.download = 'analytics-' + new Date().toISOString().split('T')[0] + '.csv';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function refreshData() {
    location.reload();
}
</script>

<div class="container-fluid">
    <!-- Overview Stats -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">User Aktif</span>
                        <h3 class="stat-value">{{ number_format($overview['active_users'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12% bulan ini</span>
                        </div>
                    </div>
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
                        <span class="stat-label">Event Published</span>
                        <h3 class="stat-value">{{ number_format($overview['published_events'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            <span>+8% bulan ini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Total Peserta</span>
                        <h3 class="stat-value">{{ number_format($overview['total_participants'] ?? 0) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-chart-line"></i>
                            <span>Meningkat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-label">Rata-rata Rating</span>
                        <h3 class="stat-value">{{ number_format($overview['average_rating'] ?? 0, 1) }}</h3>
                        <div class="stat-change positive">
                            <i class="fas fa-thumbs-up"></i>
                            <span>Performa baik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-5">
        <!-- Monthly Events Chart -->
        <div class="col-xl-8">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Event per Bulan</h5>
                        <p class="card-subtitle mb-0">Statistik 12 bulan terakhir</p>
                    </div>
                </div>
                <div class="card-body">
                    @if($monthlyStats && $monthlyStats->count() > 0)
                        <div class="chart-container">
                            @foreach($monthlyStats as $stat)
                                @php
                                    $maxEvents = $monthlyStats->max('events_created');
                                    $percentage = $maxEvents > 0 ? ($stat->events_created / $maxEvents) * 100 : 0;
                                @endphp
                                <div class="chart-bar-item">
                                    <div class="chart-bar-label">
                                        <span class="month-name">{{ date('M', mktime(0, 0, 0, $stat->month, 1)) }}</span>
                                        <span class="year-name">{{ $stat->year }}</span>
                                    </div>
                                    <div class="chart-bar-track">
                                        <div class="chart-bar-fill" style="width: {{ $percentage }}%">
                                            <span class="chart-bar-value">{{ $stat->events_created }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-secondary-subtle">
                                <i class="fas fa-chart-bar text-secondary"></i>
                            </div>
                            <h6 class="empty-state-title">Belum Ada Data</h6>
                            <p class="empty-state-description">Data statistik akan muncul setelah ada event.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Category Distribution -->
        <div class="col-xl-4">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Distribusi Kategori</h5>
                        <p class="card-subtitle mb-0">Event per kategori</p>
                    </div>
                </div>
                <div class="card-body">
                    @if($categoryStats && $categoryStats->count() > 0)
                        <div class="category-list">
                            @php
                                $colors = ['primary', 'success', 'warning', 'info', 'danger', 'secondary'];
                                $maxCategory = $categoryStats->max('event_count');
                            @endphp
                            @foreach($categoryStats as $index => $stat)
                                @php
                                    $color = $colors[$index % count($colors)];
                                    $percentage = $maxCategory > 0 ? ($stat->event_count / $maxCategory) * 100 : 0;
                                @endphp
                                <div class="category-item">
                                    <div class="category-info">
                                        <span class="category-dot bg-{{ $color }}"></span>
                                        <span class="category-name">{{ $stat->name }}</span>
                                        <span class="category-count">{{ $stat->event_count }}</span>
                                    </div>
                                    <div class="category-progress">
                                        <div class="category-progress-bar bg-{{ $color }}" style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-4">
                            <div class="empty-state-icon bg-secondary-subtle">
                                <i class="fas fa-chart-pie text-secondary"></i>
                            </div>
                            <h6 class="empty-state-title">Belum Ada Data</h6>
                            <p class="empty-state-description">Data kategori akan muncul di sini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Rankings & Activity Section -->
    <div class="row g-4 mb-5">
        <!-- Top Organizers -->
        <div class="col-xl-6">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-warning-subtle">
                        <i class="fas fa-trophy text-warning"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Top Event Organizer</h5>
                        <p class="card-subtitle mb-0">Organizer paling aktif</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($topOrganizers && $topOrganizers->count() > 0)
                        <div class="leaderboard-list">
                            @foreach($topOrganizers as $index => $organizer)
                            <div class="leaderboard-item {{ $index < 3 ? 'top-' . ($index + 1) : '' }}">
                                <div class="leaderboard-rank">
                                    @if($index < 3)
                                        <span class="rank-badge rank-{{ $index + 1 }}">
                                            <i class="fas fa-crown"></i>
                                        </span>
                                    @else
                                        <span class="rank-number">{{ $index + 1 }}</span>
                                    @endif
                                </div>
                                <div class="leaderboard-avatar">
                                    <div class="avatar-initial bg-primary-subtle text-primary">
                                        {{ strtoupper(substr($organizer->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="leaderboard-info">
                                    <h6 class="leaderboard-name">{{ $organizer->name }}</h6>
                                    <p class="leaderboard-subtitle">{{ $organizer->organization_name ?? $organizer->email }}</p>
                                </div>
                                <div class="leaderboard-score">
                                    <span class="score-value">{{ $organizer->organized_events_count }}</span>
                                    <span class="score-label">Event</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-warning-subtle">
                                <i class="fas fa-trophy text-warning"></i>
                            </div>
                            <h6 class="empty-state-title">Belum Ada Data</h6>
                            <p class="empty-state-description">Data organizer akan muncul di sini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-xl-6">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-stream"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                        <p class="card-subtitle mb-0">10 aktivitas terakhir</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($recentActivity && $recentActivity->count() > 0)
                        <div class="activity-list">
                            @foreach($recentActivity->take(10) as $activity)
                            <div class="activity-list-item">
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
                                <div class="activity-info">
                                    <h6 class="activity-title">{{ $activity->title }}</h6>
                                    <span class="activity-time">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state py-5">
                            <div class="empty-state-icon bg-secondary-subtle">
                                <i class="fas fa-stream text-secondary"></i>
                            </div>
                            <h6 class="empty-state-title">Belum Ada Aktivitas</h6>
                            <p class="empty-state-description">Aktivitas akan muncul di sini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Platform Status Section -->
    <div class="row g-4">
        <!-- Platform Health -->
        <div class="col-xl-4 col-lg-6">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-success-subtle">
                        <i class="fas fa-heartbeat text-success"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Kesehatan Platform</h5>
                        <p class="card-subtitle mb-0">Status sistem</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="health-grid">
                        <div class="health-item">
                            <div class="health-icon bg-success-subtle">
                                <i class="fas fa-users text-success"></i>
                            </div>
                            <div class="health-value">{{ $overview['active_users'] ?? 0 }}</div>
                            <div class="health-label">User Aktif</div>
                        </div>
                        <div class="health-item">
                            <div class="health-icon bg-warning-subtle">
                                <i class="fas fa-clock text-warning"></i>
                            </div>
                            <div class="health-value">{{ $overview['pending_approvals'] ?? 0 }}</div>
                            <div class="health-label">Pending</div>
                        </div>
                        <div class="health-item">
                            <div class="health-icon bg-primary-subtle">
                                <i class="fas fa-calendar text-primary"></i>
                            </div>
                            <div class="health-value">{{ $overview['published_events'] ?? 0 }}</div>
                            <div class="health-label">Event Aktif</div>
                        </div>
                        <div class="health-item">
                            <div class="health-icon bg-info-subtle">
                                <i class="fas fa-percentage text-info"></i>
                            </div>
                            <div class="health-value">{{ number_format($overview['engagement_rate'] ?? 0, 1) }}%</div>
                            <div class="health-label">Engagement</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Status -->
        <div class="col-xl-4 col-lg-6">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-info-subtle">
                        <i class="fas fa-tasks text-info"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Status Event</h5>
                        <p class="card-subtitle mb-0">Distribusi status</p>
                    </div>
                </div>
                <div class="card-body">
                    @if($overview)
                        <div class="status-list">
                            <div class="status-item">
                                <div class="status-info">
                                    <span class="status-dot bg-success"></span>
                                    <span class="status-name">Published</span>
                                </div>
                                <span class="badge bg-success-subtle text-success">{{ $overview['published_events'] ?? 0 }}</span>
                            </div>
                            <div class="status-item">
                                <div class="status-info">
                                    <span class="status-dot bg-warning"></span>
                                    <span class="status-name">Pending</span>
                                </div>
                                <span class="badge bg-warning-subtle text-warning">{{ $overview['pending_events'] ?? 0 }}</span>
                            </div>
                            <div class="status-item">
                                <div class="status-info">
                                    <span class="status-dot bg-secondary"></span>
                                    <span class="status-name">Draft</span>
                                </div>
                                <span class="badge bg-secondary-subtle text-secondary">{{ $overview['draft_events'] ?? 0 }}</span>
                            </div>
                            <div class="status-item">
                                <div class="status-info">
                                    <span class="status-dot bg-danger"></span>
                                    <span class="status-name">Cancelled</span>
                                </div>
                                <span class="badge bg-danger-subtle text-danger">{{ $overview['cancelled_events'] ?? 0 }}</span>
                            </div>
                        </div>
                    @else
                        <div class="empty-state py-4">
                            <p class="text-muted mb-0">Data tidak tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-4 col-lg-12">
            <div class="card card-modern h-100">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-primary-subtle">
                        <i class="fas fa-bolt text-primary"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Aksi Cepat</h5>
                        <p class="card-subtitle mb-0">Navigasi cepat</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="quick-actions-grid">
                        <a href="{{ route('admin.organizers.index') }}" class="quick-action-btn">
                            <i class="fas fa-user-tie"></i>
                            <span>Kelola Organizer</span>
                        </a>
                        <a href="{{ route('admin.events.index') }}" class="quick-action-btn">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Kelola Event</span>
                        </a>
                        <a href="{{ route('admin.ratings.index') }}" class="quick-action-btn">
                            <i class="fas fa-star"></i>
                            <span>Kelola Rating</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="quick-action-btn">
                            <i class="fas fa-users"></i>
                            <span>Kelola User</span>
                        </a>
                    </div>
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
    
    .stat-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
    .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin: 0.25rem 0; line-height: 1.2; }
    .stat-change { font-size: 0.75rem; font-weight: 600; display: flex; align-items: center; gap: 0.25rem; }
    .stat-change.positive { color: var(--success); }

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

    /* Chart Container */
    .chart-container { display: flex; flex-direction: column; gap: 0.75rem; }
    .chart-bar-item { display: flex; align-items: center; gap: 1rem; }
    .chart-bar-label { width: 60px; text-align: right; flex-shrink: 0; }
    .chart-bar-label .month-name { font-weight: 600; color: var(--text-primary); font-size: 0.85rem; }
    .chart-bar-label .year-name { font-size: 0.7rem; color: var(--text-muted); display: block; }
    .chart-bar-track { flex: 1; height: 28px; background: var(--surface); border-radius: var(--radius-md); overflow: hidden; }
    .chart-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 0.75rem;
        min-width: 40px;
        transition: width 0.5s ease;
    }
    .chart-bar-value { font-size: 0.75rem; font-weight: 700; color: white; }

    /* Category List */
    .category-list { display: flex; flex-direction: column; gap: 1rem; }
    .category-item { }
    .category-info { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; }
    .category-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .category-name { flex: 1; font-size: 0.875rem; color: var(--text-primary); }
    .category-count { font-weight: 600; color: var(--text-muted); font-size: 0.875rem; }
    .category-progress { height: 6px; background: var(--surface); border-radius: 3px; overflow: hidden; }
    .category-progress-bar { height: 100%; border-radius: 3px; transition: width 0.5s ease; }

    /* Leaderboard */
    .leaderboard-list { }
    .leaderboard-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-light);
        transition: background 0.2s ease;
    }
    .leaderboard-item:hover { background: rgba(var(--primary-rgb), 0.03); }
    .leaderboard-item:last-child { border-bottom: none; }
    .leaderboard-rank { width: 32px; text-align: center; }
    .rank-badge { display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 50%; font-size: 0.75rem; }
    .rank-1 { background: linear-gradient(135deg, #ffd700, #ffb700); color: #8B4513; }
    .rank-2 { background: linear-gradient(135deg, #c0c0c0, #a8a8a8); color: #555; }
    .rank-3 { background: linear-gradient(135deg, #cd7f32, #b8722d); color: white; }
    .rank-number { font-weight: 600; color: var(--text-muted); }
    .leaderboard-avatar { }
    .leaderboard-avatar .avatar-initial {
        width: 40px; height: 40px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 600; font-size: 0.875rem;
    }
    .leaderboard-info { flex: 1; min-width: 0; }
    .leaderboard-name { margin: 0; font-weight: 600; color: var(--text-primary); font-size: 0.875rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .leaderboard-subtitle { margin: 0; font-size: 0.75rem; color: var(--text-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .leaderboard-score { text-align: center; }
    .score-value { display: block; font-size: 1.25rem; font-weight: 700; color: var(--primary); }
    .score-label { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; }

    /* Activity List */
    .activity-list { }
    .activity-list-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.875rem 1.5rem;
        border-bottom: 1px solid var(--border-light);
    }
    .activity-list-item:last-child { border-bottom: none; }
    .activity-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .activity-info { flex: 1; min-width: 0; }
    .activity-title { margin: 0; font-weight: 500; color: var(--text-primary); font-size: 0.875rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .activity-time { font-size: 0.75rem; color: var(--text-muted); }

    /* Health Grid */
    .health-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    .health-item { text-align: center; }
    .health-icon { width: 48px; height: 48px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem; font-size: 1.25rem; }
    .health-value { font-size: 1.5rem; font-weight: 700; color: var(--text-primary); }
    .health-label { font-size: 0.75rem; color: var(--text-muted); }

    /* Status List */
    .status-list { display: flex; flex-direction: column; gap: 1rem; }
    .status-item { display: flex; align-items: center; justify-content: space-between; }
    .status-info { display: flex; align-items: center; gap: 0.75rem; }
    .status-dot { width: 10px; height: 10px; border-radius: 50%; }
    .status-name { font-size: 0.875rem; color: var(--text-primary); }

    /* Quick Actions Grid */
    .quick-actions-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem;
        background: var(--surface);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        text-decoration: none;
        color: var(--text-primary);
        transition: all 0.3s ease;
    }
    .quick-action-btn i { font-size: 1.25rem; color: var(--primary); }
    .quick-action-btn span { font-size: 0.75rem; font-weight: 500; text-align: center; }
    .quick-action-btn:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }
    .quick-action-btn:hover i { color: white; }

    /* Empty State */
    .empty-state { text-align: center; padding: 2rem; }
    .empty-state-icon { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; }
    .empty-state-title { color: var(--text-primary); font-weight: 600; margin-bottom: 0.5rem; }
    .empty-state-description { color: var(--text-muted); font-size: 0.875rem; margin: 0; }

    /* Breadcrumb & Title */
    .breadcrumb-modern { background: transparent; padding: 0; margin: 0; }
    .breadcrumb-modern .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-modern .breadcrumb-item a:hover { color: white; }
    .breadcrumb-modern .breadcrumb-item.active { color: rgba(255,255,255,0.9); }
    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
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
