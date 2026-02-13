@extends('layouts.app-v2')

@section('title', 'Kelola Event Organizer')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Kelola Organizer</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-user-tie"></i>
                    </span>
                    Kelola Event Organizer
                </h1>
                <p class="page-description mb-0">
                    Verifikasi dan kelola event organizer di platform
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
        <div class="col-xl-4 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Total Organizer</span>
                        <h3 class="stat-value">{{ $organizers->total() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Approved</span>
                        <h3 class="stat-value">{{ $organizers->where('status', 'approved')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Pending</span>
                        <h3 class="stat-value">{{ $organizers->where('status', 'pending')->count() }}</h3>
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
                <div class="col-lg-3 col-md-4">
                    <label class="form-label-modern">Status</label>
                    <select class="form-select form-select-modern" name="status">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4">
                    <label class="form-label-modern">Pencarian</label>
                    <div class="input-group-modern">
                        <span class="input-icon"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control form-control-modern" name="search" 
                               value="{{ request('search') }}" placeholder="Nama, email, organisasi...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <label class="form-label-modern">Urutkan</label>
                    <select class="form-select form-select-modern" name="sort">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="events_desc" {{ request('sort') == 'events_desc' ? 'selected' : '' }}>Event Terbanyak</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-modern flex-grow-1">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                        <a href="{{ route('admin.organizers.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Organizers Table -->
    @if($organizers->count() > 0)
        <div class="card card-modern">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>Organizer</th>
                                <th>Organisasi</th>
                                <th>Kontak</th>
                                <th>Event</th>
                                <th>Status</th>
                                <th>Bergabung</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organizers as $organizer)
                                <tr>
                                    <td>
                                        <div class="organizer-cell">
                                            <div class="organizer-avatar">
                                                <span class="avatar-initial">{{ strtoupper(substr($organizer->name, 0, 1)) }}</span>
                                            </div>
                                            <div class="organizer-info">
                                                <h6 class="organizer-name">{{ $organizer->name }}</h6>
                                                @if($organizer->bio)
                                                    <span class="organizer-bio">{{ Str::limit($organizer->bio, 40) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($organizer->organization_name)
                                            <span class="org-name">{{ $organizer->organization_name }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="contact-cell">
                                            <span class="contact-email">{{ $organizer->email }}</span>
                                            <span class="contact-phone">{{ $organizer->phone ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="event-count-badge">{{ $organizer->organized_events_count ?? 0 }}</span>
                                    </td>
                                    <td>
                                        @if($organizer->status === 'approved')
                                            <span class="badge bg-success-subtle text-success">Approved</span>
                                        @elseif($organizer->status === 'pending')
                                            <span class="badge bg-warning-subtle text-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="date-text">{{ \Carbon\Carbon::parse($organizer->created_at)->format('d M Y') }}</span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.show', $organizer) }}" class="btn btn-action btn-view" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($organizer->status === 'pending')
                                                <button type="button" class="btn btn-action btn-approve" 
                                                        data-bs-toggle="modal" data-bs-target="#approveModal{{ $organizer->id }}" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-action btn-reject" 
                                                        data-bs-toggle="modal" data-bs-target="#rejectModal{{ $organizer->id }}" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="table-footer">
                    {{ $organizers->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="card card-modern">
            <div class="card-body">
                <div class="empty-state py-5">
                    <div class="empty-state-icon bg-secondary-subtle">
                        <i class="fas fa-user-slash text-secondary"></i>
                    </div>
                    <h5 class="empty-state-title">Tidak Ada Organizer</h5>
                    <p class="empty-state-description">Belum ada event organizer yang terdaftar.</p>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Modals -->
@foreach($organizers as $organizer)
    @if($organizer->status === 'pending')
        <!-- Approve Modal -->
        <div class="modal fade" id="approveModal{{ $organizer->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-modern">
                    <div class="modal-header">
                        <div class="modal-icon bg-success-subtle">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <h5 class="modal-title">Approve Organizer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menyetujui <strong>{{ $organizer->name }}</strong> sebagai Event Organizer?</p>
                        <div class="info-preview">
                            <div class="preview-item">
                                <span class="preview-label">Nama:</span>
                                <span class="preview-value">{{ $organizer->name }}</span>
                            </div>
                            <div class="preview-item">
                                <span class="preview-label">Email:</span>
                                <span class="preview-value">{{ $organizer->email }}</span>
                            </div>
                            @if($organizer->organization_name)
                            <div class="preview-item">
                                <span class="preview-label">Organisasi:</span>
                                <span class="preview-value">{{ $organizer->organization_name }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.organizers.approve', $organizer) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success"><i class="fas fa-check me-2"></i>Approve</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reject Modal -->
        <div class="modal fade" id="rejectModal{{ $organizer->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-modern">
                    <div class="modal-header">
                        <div class="modal-icon bg-danger-subtle">
                            <i class="fas fa-times-circle text-danger"></i>
                        </div>
                        <h5 class="modal-title">Tolak Organizer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.organizers.reject', $organizer) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menolak <strong>{{ $organizer->name }}</strong>?</p>
                            <div class="mb-3">
                                <label class="form-label-modern">Alasan Penolakan <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-modern" name="rejection_reason" rows="3" 
                                          placeholder="Jelaskan alasan penolakan..." required></textarea>
                            </div>
                            <div class="alert alert-warning-modern">
                                <i class="fas fa-info-circle me-2"></i>Alasan penolakan akan ditampilkan kepada pengguna.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-times me-2"></i>Tolak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
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
    .form-select-modern:focus, .form-control-modern:focus { background: white; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1); }
    .input-group-modern { position: relative; }
    .input-group-modern .input-icon { position: absolute; left: 0.875rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); z-index: 1; }
    .input-group-modern .form-control-modern { padding-left: 2.5rem; }
    .btn-modern { border-radius: var(--radius-md); font-weight: 600; padding: 0.625rem 1rem; transition: all 0.3s ease; }

    /* Table Modern */
    .table-modern { margin: 0; }
    .table-modern thead th { background: var(--surface); padding: 1rem 1.25rem; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); border-bottom: 1px solid var(--border-light); }
    .table-modern tbody td { padding: 1rem 1.25rem; vertical-align: middle; border-bottom: 1px solid var(--border-light); }
    .table-modern tbody tr:hover { background: rgba(var(--primary-rgb), 0.03); }
    .table-footer { padding: 1rem 1.5rem; border-top: 1px solid var(--border-light); }

    /* Organizer Cell */
    .organizer-cell { display: flex; align-items: center; gap: 0.875rem; }
    .organizer-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--warning), #d97706); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .avatar-initial { color: white; font-weight: 600; font-size: 1rem; }
    .organizer-name { font-weight: 600; color: var(--text-primary); margin: 0 0 0.125rem; font-size: 0.9rem; }
    .organizer-bio { font-size: 0.75rem; color: var(--text-muted); }
    .org-name { color: var(--primary); font-weight: 500; }

    /* Contact Cell */
    .contact-cell { display: flex; flex-direction: column; }
    .contact-email { font-size: 0.85rem; color: var(--text-secondary); }
    .contact-phone { font-size: 0.75rem; color: var(--text-muted); }

    /* Event Count Badge */
    .event-count-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 32px; padding: 0.25rem 0.5rem; background: var(--info-soft); color: var(--info); font-weight: 600; font-size: 0.8rem; border-radius: var(--radius-md); }
    .date-text { font-size: 0.8rem; color: var(--text-muted); }

    /* Action Buttons */
    .action-buttons { display: flex; gap: 0.375rem; justify-content: center; }
    .btn-action { width: 32px; height: 32px; padding: 0; border-radius: var(--radius-md); display: inline-flex; align-items: center; justify-content: center; border: 1px solid var(--border-light); background: var(--surface); color: var(--text-muted); transition: all 0.2s ease; }
    .btn-action:hover { transform: translateY(-2px); }
    .btn-view:hover { background: var(--primary); border-color: var(--primary); color: white; }
    .btn-approve:hover { background: var(--success); border-color: var(--success); color: white; }
    .btn-reject:hover { background: var(--danger); border-color: var(--danger); color: white; }

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
    .info-preview { background: var(--surface); padding: 1rem; border-radius: var(--radius-lg); margin-top: 1rem; }
    .preview-item { display: flex; justify-content: space-between; padding: 0.5rem 0; border-bottom: 1px solid var(--border-light); }
    .preview-item:last-child { border-bottom: none; }
    .preview-label { font-size: 0.8rem; color: var(--text-muted); }
    .preview-value { font-weight: 600; color: var(--text-primary); font-size: 0.875rem; }
    .alert-warning-modern { background: rgba(245, 158, 11, 0.1); border: none; border-radius: var(--radius-md); padding: 0.75rem 1rem; font-size: 0.8rem; color: #b45309; }

    /* Breadcrumb & Title */
    .breadcrumb-modern { background: transparent; padding: 0; margin: 0; }
    .breadcrumb-modern .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-modern .breadcrumb-item.active { color: rgba(255,255,255,0.9); }
    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
    .title-icon { display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: var(--radius-lg); margin-right: 1rem; }
</style>
@endpush
@endsection
