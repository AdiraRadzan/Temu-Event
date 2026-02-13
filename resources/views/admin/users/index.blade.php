@extends('layouts.app-v2')

@section('title', 'Kelola Pengguna')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Kelola Pengguna</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-users"></i>
                    </span>
                    Kelola Pengguna
                </h1>
                <p class="page-description mb-0">
                    Kelola semua pengguna yang terdaftar di platform
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
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Total Pengguna</span>
                        <h3 class="stat-value">{{ $users->total() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-user"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">User Regular</span>
                        <h3 class="stat-value">{{ $users->where('role', 'user')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Event Organizer</span>
                        <h3 class="stat-value">{{ $users->where('role', 'event_organizer')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
                    <div class="stat-content">
                        <span class="stat-label">Administrator</span>
                        <h3 class="stat-value">{{ $users->where('role', 'admin')->count() }}</h3>
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
                    <label class="form-label-modern">Peran</label>
                    <select class="form-select form-select-modern" name="role">
                        <option value="">Semua Peran</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="event_organizer" {{ request('role') == 'event_organizer' ? 'selected' : '' }}>Event Organizer</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
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
                <div class="col-lg-2 col-md-4">
                    <label class="form-label-modern">Urutkan</label>
                    <select class="form-select form-select-modern" name="sort">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-modern flex-grow-1">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    @if($users->count() > 0)
        <div class="card card-modern">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th>Pengguna</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Status</th>
                                <th>Event</th>
                                <th>Bergabung</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="user-avatar">
                                                <span class="avatar-initial">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                            </div>
                                            <div class="user-info">
                                                <h6 class="user-name">{{ $user->name }}</h6>
                                                @if($user->organization_name)
                                                    <span class="user-org">{{ $user->organization_name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="email-text">{{ $user->email }}</span>
                                    </td>
                                    <td>
                                        @if($user->role === 'admin')
                                            <span class="badge bg-danger-subtle text-danger">
                                                <i class="fas fa-shield-alt me-1"></i>Admin
                                            </span>
                                        @elseif($user->role === 'event_organizer')
                                            <span class="badge bg-warning-subtle text-warning">
                                                <i class="fas fa-user-tie me-1"></i>Organizer
                                            </span>
                                        @else
                                            <span class="badge bg-primary-subtle text-primary">
                                                <i class="fas fa-user me-1"></i>User
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->status === 'approved')
                                            <span class="badge bg-success-subtle text-success">Approved</span>
                                        @elseif($user->status === 'pending')
                                            <span class="badge bg-warning-subtle text-warning">Pending</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="event-count-badge">{{ $user->organized_events_count ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <span class="date-text">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-action btn-view" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($user->role === 'event_organizer' && $user->status === 'pending')
                                                <button type="button" class="btn btn-action btn-approve" 
                                                        data-bs-toggle="modal" data-bs-target="#approveModal{{ $user->id }}" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button type="button" class="btn btn-action btn-reject" 
                                                        data-bs-toggle="modal" data-bs-target="#rejectModal{{ $user->id }}" title="Reject">
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="card card-modern">
            <div class="card-body">
                <div class="empty-state py-5">
                    <div class="empty-state-icon bg-secondary-subtle">
                        <i class="fas fa-users-slash text-secondary"></i>
                    </div>
                    <h5 class="empty-state-title">Tidak Ada Pengguna</h5>
                    <p class="empty-state-description">Tidak ada pengguna yang sesuai dengan filter.</p>
                </div>
            </div>
        </div>
    @endif
</div>

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

    /* User Cell */
    .user-cell { display: flex; align-items: center; gap: 0.875rem; }
    .user-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .avatar-initial { color: white; font-weight: 600; font-size: 1rem; }
    .user-name { font-weight: 600; color: var(--text-primary); margin: 0 0 0.125rem; font-size: 0.9rem; }
    .user-org { font-size: 0.75rem; color: var(--text-muted); }
    .email-text { font-size: 0.875rem; color: var(--text-secondary); }
    .date-text { font-size: 0.8rem; color: var(--text-muted); }

    /* Event Count Badge */
    .event-count-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 32px; padding: 0.25rem 0.5rem; background: var(--info-soft); color: var(--info); font-weight: 600; font-size: 0.8rem; border-radius: var(--radius-md); }

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

    /* Breadcrumb & Title */
    .breadcrumb-modern { background: transparent; padding: 0; margin: 0; }
    .breadcrumb-modern .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-modern .breadcrumb-item.active { color: rgba(255,255,255,0.9); }
    .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
    .title-icon { display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: rgba(255,255,255,0.15); border-radius: var(--radius-lg); margin-right: 1rem; }
</style>
@endpush
@endsection
