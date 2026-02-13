@extends('layouts.app-v2')

@section('title', 'Featured Events Management')

@section('content')
<div class="admin-content">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="page-header-content">
            <div class="page-title-section">
                <div class="page-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <div>
                    <h1 class="page-title">Featured Events</h1>
                    <p class="page-subtitle">Kelola event unggulan yang ditampilkan di halaman utama</p>
                </div>
            </div>
            <nav class="breadcrumb-modern">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span class="separator">/</span>
                <a href="{{ route('admin.events.index') }}">Events</a>
                <span class="separator">/</span>
                <span class="current">Featured</span>
            </nav>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card stat-card-warning">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $featuredEvents->total() }}</span>
                <span class="stat-label">Total Featured</span>
            </div>
        </div>

        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $featuredEvents->where('status', 'approved')->count() }}</span>
                <span class="stat-label">Approved</span>
            </div>
        </div>

        <div class="stat-card stat-card-info">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $featuredEvents->sum(function($event) { return $event->participants->count(); }) }}</span>
                <span class="stat-label">Total Participants</span>
            </div>
        </div>

        <div class="stat-card stat-card-primary">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div class="stat-content">
                <span class="stat-value">{{ $featuredEvents->where('status', 'pending')->count() }}</span>
                <span class="stat-label">Pending Review</span>
            </div>
        </div>
    </div>

    <!-- Featured Events Table -->
    <div class="content-card">
        <div class="card-header-modern">
            <div class="header-left">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="8" y1="6" x2="21" y2="6"></line>
                        <line x1="8" y1="12" x2="21" y2="12"></line>
                        <line x1="8" y1="18" x2="21" y2="18"></line>
                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                    </svg>
                    Daftar Featured Events
                </h2>
                <span class="badge badge-primary">{{ $featuredEvents->total() }} events</span>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Kelola Semua Event
                </a>
            </div>
        </div>

        <div class="card-body-modern">
            @if($featuredEvents->count() > 0)
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Organizer</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Participants</th>
                                <th>Status</th>
                                <th>Featured Since</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($featuredEvents as $event)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="avatar avatar-primary">
                                            {{ strtoupper(substr($event->title, 0, 1)) }}
                                        </div>
                                        <div class="user-details">
                                            <span class="user-name">
                                                {{ Str::limit($event->title, 35) }}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="0" class="text-warning ms-1">
                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                </svg>
                                            </span>
                                            <span class="user-email">{{ $event->location }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-info">
                                        <div class="avatar avatar-sm avatar-secondary">
                                            {{ strtoupper(substr($event->organizer->name ?? 'N', 0, 1)) }}
                                        </div>
                                        <div class="user-details">
                                            <span class="user-name">{{ Str::limit($event->organizer->name ?? 'Unknown', 18) }}</span>
                                            <span class="user-email">{{ Str::limit($event->organizer->email ?? '-', 20) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">{{ $event->category->name ?? 'No Category' }}</span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <span class="date-main">{{ $event->event_date->format('d M Y') }}</span>
                                        <span class="date-sub">{{ $event->event_date->format('H:i') }} WIB</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="participant-count">
                                        <span class="count-value">{{ $event->participants->count() }}</span>
                                        <span class="count-label">
                                            @if($event->capacity)
                                                / {{ number_format($event->capacity) }}
                                            @else
                                                unlimited
                                            @endif
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($event->status) {
                                            'approved' => 'success',
                                            'pending' => 'warning',
                                            default => 'danger'
                                        };
                                    @endphp
                                    <span class="badge badge-{{ $statusClass }}">{{ ucfirst($event->status) }}</span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <span class="date-main">{{ $event->updated_at->format('d M Y') }}</span>
                                        <span class="date-sub">{{ $event->updated_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.events.show', $event) }}" class="btn-action btn-action-primary" title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.events.toggle-featured', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus event ini dari featured?')">
                                            @csrf
                                            <button type="submit" class="btn-action btn-action-warning" title="Hapus dari Featured">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($featuredEvents->hasPages())
                    <div class="pagination-wrapper">
                        {{ $featuredEvents->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <h3>Belum Ada Featured Events</h3>
                    <p>Tidak ada event yang dijadikan featured saat ini. Tambahkan event ke featured dari halaman kelola events.</p>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        Kelola Semua Event
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    @if($featuredEvents->count() > 0)
    <div class="content-card">
        <div class="card-header-modern">
            <h2 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
                Quick Actions
            </h2>
        </div>
        <div class="card-body-modern">
            <div class="quick-actions-grid">
                <a href="{{ route('admin.events.index') }}" class="quick-action-card">
                    <div class="quick-action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="quick-action-content">
                        <span class="quick-action-title">Kelola Semua Event</span>
                        <span class="quick-action-desc">Lihat dan kelola semua event</span>
                    </div>
                </a>

                <a href="{{ route('admin.analytics') }}" class="quick-action-card">
                    <div class="quick-action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                    </div>
                    <div class="quick-action-content">
                        <span class="quick-action-title">Lihat Analytics</span>
                        <span class="quick-action-desc">Statistik dan laporan</span>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="quick-action-card">
                    <div class="quick-action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </div>
                    <div class="quick-action-content">
                        <span class="quick-action-title">Dashboard Admin</span>
                        <span class="quick-action-desc">Kembali ke dashboard</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Page Footer -->
    <div class="page-footer-actions">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali ke Dashboard
        </a>
        <a href="{{ route('admin.events.index') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Kelola Semua Event
        </a>
    </div>
</div>

<style>
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-4);
}

.quick-action-card {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-4);
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    text-decoration: none;
    color: inherit;
    transition: all var(--transition-base);
}

.quick-action-card:hover {
    background: var(--primary-50);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.quick-action-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
    border-radius: var(--radius-lg);
    color: white;
}

.quick-action-content {
    display: flex;
    flex-direction: column;
}

.quick-action-title {
    font-weight: 600;
    color: var(--gray-900);
}

.quick-action-desc {
    font-size: var(--text-sm);
    color: var(--gray-500);
}

.participant-count {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.count-value {
    font-size: var(--text-lg);
    font-weight: 700;
    color: var(--primary-600);
}

.count-label {
    font-size: var(--text-xs);
    color: var(--gray-500);
}

.date-info {
    display: flex;
    flex-direction: column;
}

.date-main {
    font-weight: 500;
    color: var(--gray-900);
}

.date-sub {
    font-size: var(--text-xs);
    color: var(--gray-500);
}

.page-footer-actions {
    display: flex;
    justify-content: space-between;
    margin-top: var(--space-6);
    padding-top: var(--space-4);
    border-top: 1px solid var(--gray-200);
}

@media (max-width: 768px) {
    .quick-actions-grid {
        grid-template-columns: 1fr;
    }
    
    .page-footer-actions {
        flex-direction: column;
        gap: var(--space-3);
    }
    
    .page-footer-actions .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection
