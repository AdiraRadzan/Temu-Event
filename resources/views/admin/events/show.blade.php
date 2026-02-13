@extends('layouts.app-v2')

@section('title', 'Detail Event - ' . $event->title)

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($event->title, 25) }}</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </span>
                    {{ Str::limit($event->title, 40) }}
                    @if($event->is_featured)
                        <span class="badge badge-glass bg-warning-glass ms-2"><i class="fas fa-star me-1"></i>Featured</span>
                    @endif
                </h1>
                <p class="page-description mb-0">Detail informasi event</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('admin.events.index') }}" class="btn btn-light">
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
        <!-- Main Content -->
        <div class="col-xl-8">
            <!-- Event Info Card -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon"><i class="fas fa-info-circle"></i></div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Informasi Event</h5>
                        <p class="card-subtitle mb-0">Detail lengkap event</p>
                    </div>
                    <div class="ms-auto d-flex gap-2">
                        @if($event->status === 'pending')
                            <form action="{{ route('admin.events.approve', $event) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui event ini?')">
                                    <i class="fas fa-check me-1"></i>Setujui
                                </button>
                            </form>
                            <form action="{{ route('admin.events.reject', $event) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tolak event ini?')">
                                    <i class="fas fa-times me-1"></i>Tolak
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('admin.events.toggle-featured', $event) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-{{ $event->is_featured ? 'warning' : 'outline-warning' }} btn-sm">
                                <i class="fas fa-star me-1"></i>{{ $event->is_featured ? 'Hapus Featured' : 'Featured' }}
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label"><i class="fas fa-heading me-2"></i>Judul Event</label>
                                <p class="info-value">{{ $event->title }}</p>
                            </div>
                            <div class="info-group">
                                <label class="info-label"><i class="fas fa-align-left me-2"></i>Deskripsi</label>
                                <div class="description-box">
                                    {!! nl2br(e($event->description)) !!}
                                </div>
                            </div>
                            <div class="info-group">
                                <label class="info-label"><i class="fas fa-map-marker-alt me-2"></i>Lokasi</label>
                                <p class="info-value">{{ $event->location }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-group">
                                <label class="info-label"><i class="fas fa-folder me-2"></i>Kategori</label>
                                <p><span class="badge bg-primary-subtle text-primary px-3 py-2">{{ $event->category->name ?? 'No Category' }}</span></p>
                            </div>
                            <div class="info-group">
                                <label class="info-label"><i class="fas fa-calendar me-2"></i>Tanggal & Waktu</label>
                                <p class="info-value">{{ $event->event_date ? $event->event_date->format('d M Y H:i') . ' WIB' : 'Tanggal belum ditentukan' }}</p>
                            </div>
                            <div class="info-group">
                                <label class="info-label"><i class="fas fa-tag me-2"></i>Harga</label>
                                <p>
                                    @if($event->price > 0)
                                        <span class="price-tag">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="badge bg-success-subtle text-success px-3 py-2">GRATIS</span>
                                    @endif
                                </p>
                            </div>
                            <div class="info-group">
                                <label class="info-label"><i class="fas fa-users me-2"></i>Kapasitas</label>
                                <p class="info-value">{{ $event->capacity ? number_format($event->capacity) . ' orang' : 'Tidak terbatas' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participants Card -->
            <div class="card card-modern mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-success-subtle"><i class="fas fa-users text-success"></i></div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Peserta Event</h5>
                        <p class="card-subtitle mb-0">{{ $event->participants->count() }} peserta terdaftar</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($event->participants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th>Peserta</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Registrasi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->participants as $participant)
                                    <tr>
                                        <td>
                                            <div class="participant-cell">
                                                <div class="participant-avatar">{{ strtoupper(substr($participant->user->name, 0, 1)) }}</div>
                                                <span class="participant-name">{{ $participant->user->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $participant->user->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $participant->status === 'confirmed' ? 'success' : ($participant->status === 'pending' ? 'warning' : 'danger') }}-subtle text-{{ $participant->status === 'confirmed' ? 'success' : ($participant->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($participant->status) }}
                                            </span>
                                        </td>
                                        <td><span class="date-text">{{ $participant->created_at->format('d M Y H:i') }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.users.show', $participant->user) }}" class="btn btn-action btn-view">
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
                            <div class="empty-state-icon bg-secondary-subtle"><i class="fas fa-users text-secondary"></i></div>
                            <h6 class="empty-state-title">Belum Ada Peserta</h6>
                            <p class="empty-state-description">Belum ada peserta yang mendaftar event ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4">
            <!-- Organizer Card -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-warning-subtle"><i class="fas fa-user-tie text-warning"></i></div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Organizer</h5>
                    </div>
                </div>
                <div class="card-body text-center p-4">
                    <div class="organizer-avatar-large">{{ strtoupper(substr($event->organizer->name, 0, 1)) }}</div>
                    <h5 class="mt-3 mb-1">{{ $event->organizer->name }}</h5>
                    <p class="text-muted mb-3">{{ $event->organizer->email }}</p>
                    <a href="{{ route('admin.users.show', $event->organizer) }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-eye me-2"></i>Lihat Profil
                    </a>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="card card-modern mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-info-subtle"><i class="fas fa-chart-pie text-info"></i></div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Statistik</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="stats-grid">
                        <div class="stat-box">
                            <span class="stat-number text-primary">{{ $event->participants->count() }}</span>
                            <span class="stat-label">Peserta</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number text-success">{{ $event->favorites->count() }}</span>
                            <span class="stat-label">Favorit</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number text-warning">{{ $event->ratings->where('status', 'approved')->count() }}</span>
                            <span class="stat-label">Rating</span>
                        </div>
                        <div class="stat-box">
                            @php $avgRating = $event->ratings->where('status', 'approved')->avg('rating') ?? 0; @endphp
                            <span class="stat-number text-info">{{ number_format($avgRating, 1) }}</span>
                            <span class="stat-label">Rata-rata</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="card card-modern mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon"><i class="fas fa-flag"></i></div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Status & Info</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="status-info-list">
                        <div class="status-info-item">
                            <span class="status-label">Status Event:</span>
                            <span class="badge bg-{{ $event->status === 'approved' ? 'success' : ($event->status === 'pending' ? 'warning' : 'danger') }}-subtle text-{{ $event->status === 'approved' ? 'success' : ($event->status === 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                        <div class="status-info-item">
                            <span class="status-label">Featured:</span>
                            @if($event->is_featured)
                                <span class="badge bg-warning-subtle text-warning"><i class="fas fa-star me-1"></i>Featured</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Regular</span>
                            @endif
                        </div>
                        <div class="status-info-item">
                            <span class="status-label">Dibuat:</span>
                            <span class="status-value">{{ $event->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="status-info-item">
                            <span class="status-label">Diperbarui:</span>
                            <span class="status-value">{{ $event->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>

                    @if($event->status === 'approved')
                        <div class="alert alert-success-modern mt-3">
                            <i class="fas fa-check-circle me-2"></i>Event sudah disetujui dan dapat dilihat publik.
                        </div>
                    @elseif($event->status === 'pending')
                        <div class="alert alert-warning-modern mt-3">
                            <i class="fas fa-clock me-2"></i>Event menunggu persetujuan dari admin.
                        </div>
                    @else
                        <div class="alert alert-danger-modern mt-3">
                            <i class="fas fa-times-circle me-2"></i>Event telah ditolak.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Card Modern */
    .card-modern { background: var(--glass-bg); backdrop-filter: blur(20px); border-radius: var(--radius-xl); border: 1px solid var(--glass-border); box-shadow: var(--shadow-md); }
    .card-header-modern { display: flex; align-items: center; gap: 1rem; padding: 1.25rem 1.5rem; background: transparent; border-bottom: 1px solid var(--border-light); flex-wrap: wrap; }
    .card-header-icon { width: 40px; height: 40px; border-radius: var(--radius-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .card-header-content .card-title { font-weight: 600; color: var(--text-primary); }
    .card-header-content .card-subtitle { font-size: 0.8rem; color: var(--text-muted); }

    /* Info Groups */
    .info-group { margin-bottom: 1.25rem; }
    .info-label { font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; display: block; }
    .info-value { font-weight: 500; color: var(--text-primary); margin: 0; }
    .description-box { background: var(--surface); padding: 1rem; border-radius: var(--radius-md); border-left: 3px solid var(--primary); color: var(--text-secondary); line-height: 1.6; }
    .price-tag { font-size: 1.25rem; font-weight: 700; color: var(--success); }

    /* Table Modern */
    .table-modern { margin: 0; }
    .table-modern thead th { background: var(--surface); padding: 1rem 1.25rem; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); border-bottom: 1px solid var(--border-light); }
    .table-modern tbody td { padding: 1rem 1.25rem; vertical-align: middle; border-bottom: 1px solid var(--border-light); }
    .table-modern tbody tr:hover { background: rgba(var(--primary-rgb), 0.03); }

    /* Participant Cell */
    .participant-cell { display: flex; align-items: center; gap: 0.75rem; }
    .participant-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.85rem; }
    .participant-name { font-weight: 600; color: var(--text-primary); }
    .date-text { font-size: 0.8rem; color: var(--text-muted); }
    .btn-action { width: 32px; height: 32px; padding: 0; border-radius: var(--radius-md); display: inline-flex; align-items: center; justify-content: center; border: 1px solid var(--border-light); background: var(--surface); color: var(--text-muted); transition: all 0.2s ease; }
    .btn-view:hover { background: var(--primary); border-color: var(--primary); color: white; }

    /* Organizer Avatar */
    .organizer-avatar-large { width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, var(--warning), #d97706); color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 600; margin: 0 auto; }

    /* Stats Grid */
    .stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
    .stat-box { background: var(--surface); padding: 1rem; border-radius: var(--radius-md); text-align: center; }
    .stat-number { display: block; font-size: 1.5rem; font-weight: 700; }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); }

    /* Status Info List */
    .status-info-list { display: flex; flex-direction: column; gap: 0.75rem; }
    .status-info-item { display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light); }
    .status-info-item:last-child { border-bottom: none; }
    .status-label { font-size: 0.85rem; color: var(--text-muted); }
    .status-value { font-size: 0.85rem; color: var(--text-primary); font-weight: 500; }

    /* Alerts */
    .alert-success-modern { background: rgba(16, 185, 129, 0.1); border: none; border-radius: var(--radius-md); padding: 0.75rem 1rem; font-size: 0.85rem; color: #059669; }
    .alert-warning-modern { background: rgba(245, 158, 11, 0.1); border: none; border-radius: var(--radius-md); padding: 0.75rem 1rem; font-size: 0.85rem; color: #b45309; }
    .alert-danger-modern { background: rgba(239, 68, 68, 0.1); border: none; border-radius: var(--radius-md); padding: 0.75rem 1rem; font-size: 0.85rem; color: #b91c1c; }

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
    .badge-glass { backdrop-filter: blur(10px); font-weight: 500; }
    .bg-warning-glass { background: rgba(245, 158, 11, 0.3); color: white; }
</style>
@endpush
@endsection
