@extends('layouts.app-v2')

@section('title', 'Kelola Rating & Ulasan')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Kelola Rating</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-star"></i>
                    </span>
                    Kelola Rating & Ulasan
                </h1>
                <p class="page-description mb-0">
                    Moderasi dan kelola rating serta ulasan pengguna
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
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
                    <div class="stat-icon"><i class="fas fa-comments"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Total Ulasan</span>
                        <h3 class="stat-value">{{ $ratings->total() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Approved</span>
                        <h3 class="stat-value">{{ $ratings->where('is_approved', true)->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Pending</span>
                        <h3 class="stat-value">{{ $ratings->where('is_approved', false)->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-star"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Rata-rata Rating</span>
                        <h3 class="stat-value">
                            @if($ratings->where('is_approved', true)->count() > 0)
                                {{ number_format($ratings->where('is_approved', true)->avg('rating'), 1) }}
                            @else
                                0.0
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card card-modern mb-4">
        <div class="card-header card-header-modern">
            <div class="card-header-icon"><i class="fas fa-filter"></i></div>
            <div class="card-header-content">
                <h5 class="card-title mb-0">Filter & Pencarian</h5>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-lg-2 col-md-4">
                    <label class="form-label-modern">Status</label>
                    <select class="form-select form-select-modern" name="status">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <label class="form-label-modern">Rating</label>
                    <select class="form-select form-select-modern" name="rating">
                        <option value="">Semua Rating</option>
                        <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang</option>
                        <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang</option>
                        <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang</option>
                        <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang</option>
                        <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang</option>
                    </select>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label-modern">Pencarian</label>
                    <div class="input-group-modern">
                        <span class="input-icon"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control form-control-modern" name="search" 
                               value="{{ request('search') }}" placeholder="Nama user, judul event...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label-modern">Urutkan</label>
                    <select class="form-select form-select-modern" name="sort">
                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="rating_high" {{ request('sort') == 'rating_high' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="rating_low" {{ request('sort') == 'rating_low' ? 'selected' : '' }}>Rating Terendah</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-modern flex-grow-1">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                        <a href="{{ route('admin.ratings.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Ratings List -->
    @if($ratings->count() > 0)
        <div class="row g-4">
            @foreach($ratings as $rating)
                <div class="col-12">
                    <div class="card card-modern rating-card">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <!-- User Section -->
                                <div class="col-lg-2 col-md-3 rating-user-section">
                                    <div class="user-avatar-large">
                                        <span class="avatar-initial">{{ strtoupper(substr($rating->user->name, 0, 1)) }}</span>
                                    </div>
                                    <h6 class="user-name mt-3 mb-1">{{ $rating->user->name }}</h6>
                                    <span class="user-email">{{ $rating->user->email }}</span>
                                </div>

                                <!-- Content Section -->
                                <div class="col-lg-7 col-md-5 rating-content-section">
                                    <div class="event-info mb-3">
                                        <h5 class="event-title mb-2">{{ $rating->event->title }}</h5>
                                        <div class="event-meta">
                                            <span><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($rating->event->start_date)->format('d M Y') }}</span>
                                            <span><i class="fas fa-map-marker-alt"></i> {{ Str::limit($rating->event->location, 30) }}</span>
                                        </div>
                                    </div>

                                    <!-- Star Rating -->
                                    <div class="rating-stars mb-3">
                                        <div class="rating-main">
                                            <span class="rating-label">Rating Utama:</span>
                                            <div class="stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                                <span class="rating-value">({{ $rating->rating }}/5)</span>
                                            </div>
                                        </div>
                                        @if($rating->content_rating || $rating->management_rating)
                                            <div class="rating-details mt-2">
                                                @if($rating->content_rating)
                                                    <div class="rating-detail-item">
                                                        <span>Konten:</span>
                                                        <div class="stars-small">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fas fa-star {{ $i <= $rating->content_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($rating->management_rating)
                                                    <div class="rating-detail-item">
                                                        <span>Manajemen:</span>
                                                        <div class="stars-small">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <i class="fas fa-star {{ $i <= $rating->management_rating ? 'text-warning' : 'text-muted' }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Review Text -->
                                    @if($rating->review)
                                        <div class="review-text">
                                            <p class="mb-0">{{ $rating->review }}</p>
                                        </div>
                                    @endif

                                    @if($rating->would_recommend)
                                        <div class="recommend-badge mt-3">
                                            <i class="fas fa-thumbs-up"></i>
                                            <span>User merekomendasikan event ini</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions Section -->
                                <div class="col-lg-3 col-md-4 rating-actions-section">
                                    <div class="status-badge mb-3">
                                        @if($rating->is_approved)
                                            <span class="badge bg-success-subtle text-success">
                                                <i class="fas fa-check-circle me-1"></i>Approved
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @endif
                                    </div>

                                    <div class="action-buttons-vertical">
                                        @if(!$rating->is_approved)
                                            <form action="{{ route('admin.ratings.approve', $rating) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-action-full">
                                                    <i class="fas fa-check me-2"></i>Approve
                                                </button>
                                            </form>
                                        @endif

                                        <button type="button" class="btn btn-danger btn-action-full" 
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $rating->id }}">
                                            <i class="fas fa-trash me-2"></i>Hapus
                                        </button>

                                        <a href="{{ route('events.show', $rating->event) }}" class="btn btn-outline-primary btn-action-full">
                                            <i class="fas fa-eye me-2"></i>Lihat Event
                                        </a>
                                    </div>

                                    <div class="timestamp mt-3">
                                        <i class="fas fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($rating->created_at)->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $ratings->links() }}
        </div>
    @else
        <div class="card card-modern">
            <div class="card-body">
                <div class="empty-state py-5">
                    <div class="empty-state-icon bg-secondary-subtle">
                        <i class="fas fa-star-half-alt text-secondary"></i>
                    </div>
                    <h5 class="empty-state-title">Tidak Ada Ulasan</h5>
                    <p class="empty-state-description">Tidak ada ulasan yang sesuai dengan filter.</p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Delete Modals -->
@foreach($ratings as $rating)
    <div class="modal fade" id="deleteModal{{ $rating->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-modern">
                <div class="modal-header">
                    <div class="modal-icon bg-danger-subtle">
                        <i class="fas fa-trash text-danger"></i>
                    </div>
                    <h5 class="modal-title">Hapus Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus ulasan ini?</p>
                    <div class="info-preview">
                        <div class="preview-item">
                            <span class="preview-label">Event:</span>
                            <span class="preview-value">{{ $rating->event->title }}</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">User:</span>
                            <span class="preview-value">{{ $rating->user->name }}</span>
                        </div>
                        <div class="preview-item">
                            <span class="preview-label">Rating:</span>
                            <span class="preview-value">{{ $rating->rating }}/5</span>
                        </div>
                    </div>
                    <div class="alert alert-danger-modern mt-3">
                        <i class="fas fa-exclamation-triangle me-2"></i>Tindakan ini tidak dapat dibatalkan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.ratings.reject', $rating) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-2"></i>Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('styles')
<style>
    /* Stats Cards */
    .stat-card { background: var(--glass-bg); backdrop-filter: blur(20px); border-radius: var(--radius-xl); border: 1px solid var(--glass-border); overflow: hidden; transition: all 0.3s ease; }
    .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-xl); }
    .stat-card-body { padding: 1.25rem; display: flex; align-items: center; gap: 1rem; }
    .stat-icon { width: 48px; height: 48px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
    .stat-card-primary .stat-icon { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
    .stat-card-success .stat-icon { background: linear-gradient(135deg, var(--success), #059669); color: white; }
    .stat-card-warning .stat-icon { background: linear-gradient(135deg, var(--warning), #d97706); color: white; }
    .stat-card-info .stat-icon { background: linear-gradient(135deg, var(--info), #0284c7); color: white; }
    .stat-label { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
    .stat-value { font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin: 0; }

    /* Card Modern */
    .card-modern { background: var(--glass-bg); backdrop-filter: blur(20px); border-radius: var(--radius-xl); border: 1px solid var(--glass-border); box-shadow: var(--shadow-md); }
    .card-header-modern { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.5rem; background: transparent; border-bottom: 1px solid var(--border-light); }
    .card-header-icon { width: 36px; height: 36px; border-radius: var(--radius-md); background: var(--primary-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; }
    .card-header-content .card-title { font-weight: 600; color: var(--text-primary); }

    /* Form Modern */
    .form-label-modern { font-size: 0.8rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.375rem; }
    .form-select-modern, .form-control-modern { background: var(--surface); border: 1px solid var(--border-light); border-radius: var(--radius-md); padding: 0.625rem 0.875rem; font-size: 0.875rem; transition: all 0.3s ease; }
    .input-group-modern { position: relative; }
    .input-group-modern .input-icon { position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); z-index: 1; }
    .input-group-modern .form-control-modern { padding-left: 2.5rem; }
    .btn-modern { border-radius: var(--radius-md); font-weight: 600; padding: 0.625rem 1rem; }

    /* Rating Card */
    .rating-card { overflow: hidden; }
    .rating-user-section { padding: 1.5rem; text-align: center; background: var(--surface); border-right: 1px solid var(--border-light); }
    .user-avatar-large { width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); display: flex; align-items: center; justify-content: center; margin: 0 auto; }
    .user-avatar-large .avatar-initial { color: white; font-size: 1.75rem; font-weight: 600; }
    .rating-user-section .user-name { font-weight: 600; color: var(--text-primary); }
    .rating-user-section .user-email { font-size: 0.75rem; color: var(--text-muted); word-break: break-all; }

    .rating-content-section { padding: 1.5rem; }
    .event-title { font-weight: 600; color: var(--text-primary); margin: 0; }
    .event-meta { display: flex; gap: 1rem; flex-wrap: wrap; }
    .event-meta span { font-size: 0.8rem; color: var(--text-muted); }
    .event-meta i { margin-right: 0.25rem; color: var(--primary); }

    /* Rating Stars */
    .rating-main { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap; }
    .rating-label { font-weight: 600; font-size: 0.85rem; color: var(--text-primary); }
    .stars { display: flex; align-items: center; gap: 0.25rem; }
    .stars i { font-size: 1.1rem; }
    .rating-value { margin-left: 0.5rem; font-size: 0.85rem; color: var(--text-muted); }
    .rating-details { display: flex; gap: 1.5rem; flex-wrap: wrap; }
    .rating-detail-item { display: flex; align-items: center; gap: 0.5rem; }
    .rating-detail-item span { font-size: 0.75rem; color: var(--text-muted); }
    .stars-small i { font-size: 0.75rem; }

    /* Review Text */
    .review-text { background: var(--surface); padding: 1rem; border-radius: var(--radius-md); border-left: 3px solid var(--primary); }
    .review-text p { color: var(--text-secondary); font-size: 0.9rem; line-height: 1.6; }

    /* Recommend Badge */
    .recommend-badge { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: rgba(16, 185, 129, 0.1); border-radius: var(--radius-md); color: var(--success); font-size: 0.8rem; font-weight: 500; }

    /* Actions Section */
    .rating-actions-section { padding: 1.5rem; text-align: center; background: var(--surface); border-left: 1px solid var(--border-light); display: flex; flex-direction: column; justify-content: center; }
    .action-buttons-vertical { display: flex; flex-direction: column; gap: 0.5rem; }
    .btn-action-full { width: 100%; padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: var(--radius-md); }
    .timestamp { font-size: 0.75rem; color: var(--text-muted); }
    .timestamp i { margin-right: 0.25rem; }

    /* Empty State */
    .empty-state { text-align: center; }
    .empty-state-icon { width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 2rem; }
    .empty-state-title { color: var(--text-primary); font-weight: 600; }
    .empty-state-description { color: var(--text-muted); }

    /* Modal Modern */
    .modal-modern { border-radius: var(--radius-xl); border: none; }
    .modal-modern .modal-header { padding: 1.5rem; border-bottom: 1px solid var(--border-light); gap: 1rem; }
    .modal-icon { width: 48px; height: 48px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    .modal-modern .modal-body { padding: 1.5rem; }
    .modal-modern .modal-footer { padding: 1rem 1.5rem; border-top: 1px solid var(--border-light); }
    .info-preview { background: var(--surface); padding: 1rem; border-radius: var(--radius-lg); }
    .preview-item { display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light); }
    .preview-item:last-child { border-bottom: none; }
    .preview-label { font-size: 0.8rem; color: var(--text-muted); }
    .preview-value { font-weight: 600; color: var(--text-primary); font-size: 0.875rem; }
    .alert-danger-modern { background: rgba(239, 68, 68, 0.1); border: none; border-radius: var(--radius-md); padding: 0.75rem 1rem; font-size: 0.8rem; color: #b91c1c; }

    /* Breadcrumb & Title */
    .breadcrumb-modern { background: transparent; padding: 0; margin: 0; }
    .breadcrumb-modern .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-modern .breadcrumb-item.active { color: rgba(255,255,255,0.9); }
    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
    .title-icon { display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: var(--radius-lg); margin-right: 1rem; }

    /* Responsive */
    @media (max-width: 991.98px) {
        .rating-user-section, .rating-actions-section { border-right: none; border-left: none; border-bottom: 1px solid var(--border-light); }
        .rating-actions-section { border-bottom: none; }
    }
</style>
@endpush
@endsection
