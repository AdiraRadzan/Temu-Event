@extends('layouts.app-v2')

@section('title', 'Kelola Peserta - ' . $event->title)

@push('styles')
<style>
    .modern-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .event-summary-card {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border-radius: var(--radius-xl, 1rem);
        padding: 1.5rem;
        color: white;
    }
    
    .stat-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.2;
    }
    
    .form-control-modern, .form-select-modern {
        border: 2px solid var(--slate-200, #e2e8f0);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.625rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control-modern:focus, .form-select-modern:focus {
        border-color: var(--warning-500, #f59e0b);
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border: none;
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.625rem 1.25rem;
        font-weight: 600;
        color: white;
    }
    
    .btn-primary-modern:hover {
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .table-modern thead th {
        background: var(--slate-50, #f8fafc);
        border: none;
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: var(--slate-600, #475569);
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    
    .table-modern tbody td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
        vertical-align: middle;
    }
    
    .table-modern tbody tr:hover {
        background: var(--slate-50, #f8fafc);
    }
    
    .participant-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: var(--radius-md, 0.5rem);
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .status-registered {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);
        color: var(--primary-700, #1d4ed8);
    }
    
    .status-confirmed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
        color: var(--success-700, #047857);
    }
    
    .status-attended {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(124, 58, 237, 0.2) 100%);
        color: #7c3aed;
    }
    
    .status-cancelled {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
        color: var(--danger-700, #b91c1c);
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-md, 0.5rem);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--slate-200, #e2e8f0);
        background: white;
        color: var(--slate-600, #475569);
        transition: all 0.2s ease;
        margin-right: 0.25rem;
    }
    
    .action-btn:hover {
        background: var(--slate-100, #f1f5f9);
        color: var(--slate-800, #1e293b);
    }
    
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-state-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }
    
    .modal-content {
        border-radius: var(--radius-xl, 1rem);
        border: none;
    }
    
    .modal-header {
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
        padding: 1.25rem 1.5rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-footer {
        border-top: 1px solid var(--slate-100, #f1f5f9);
        padding: 1rem 1.5rem;
    }
</style>
@endpush

@section('page-header')
<div class="page-header" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);">
    <div class="container-fluid py-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-2">
                        <li class="breadcrumb-item">
                            <a href="{{ route('organizer.dashboard') }}" class="text-decoration-none" style="color: var(--warning-700, #b45309);">
                                <i class="fas fa-home me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('organizer.events.show', $event) }}" class="text-decoration-none" style="color: var(--warning-700, #b45309);">{{ Str::limit($event->title, 20) }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: var(--warning-800, #92400e);">Peserta</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2" style="color: var(--warning-900, #78350f);">
                    <i class="fas fa-users me-3"></i>
                    Kelola Peserta
                </h1>
                <p class="mb-0" style="color: var(--warning-700, #b45309);">
                    {{ $event->title }}
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <div class="d-inline-block text-center px-4 py-2 rounded-3" style="background: rgba(255,255,255,0.5);">
                    <div class="fs-3 fw-bold" style="color: var(--warning-800, #92400e);">{{ $participants->total() }}</div>
                    <div class="small" style="color: var(--warning-700, #b45309);">Total Peserta</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Event Summary -->
    <div class="event-summary-card mb-4">
        <div class="row align-items-center">
            <div class="col-auto">
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                         class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                @else
                    <div class="rounded d-flex align-items-center justify-content-center" 
                         style="width: 80px; height: 80px; background: rgba(255,255,255,0.2);">
                        <i class="fas fa-calendar-alt fs-2 opacity-75"></i>
                    </div>
                @endif
            </div>
            <div class="col">
                <h4 class="mb-1 fw-bold">{{ $event->title }}</h4>
                <div class="d-flex flex-wrap gap-3 opacity-75">
                    <span><i class="fas fa-calendar-alt me-1"></i>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y H:i') }} WIB</span>
                    <span><i class="fas fa-map-marker-alt me-1"></i>{{ $event->location }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value text-primary">{{ $participants->where('status', 'registered')->count() }}</div>
                <div class="text-muted small">Terdaftar</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value text-success">{{ $participants->where('status', 'confirmed')->count() }}</div>
                <div class="text-muted small">Dikonfirmasi</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value" style="color: #8b5cf6;">{{ $participants->where('status', 'attended')->count() }}</div>
                <div class="text-muted small">Hadir</div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="stat-value text-danger">{{ $participants->where('status', 'cancelled')->count() }}</div>
                <div class="text-muted small">Dibatalkan</div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="modern-card mb-4">
        <div class="card-body p-4">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="status" class="form-label fw-semibold small">Status</label>
                    <select class="form-select form-select-modern" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="registered" {{ request('status') == 'registered' ? 'selected' : '' }}>Terdaftar</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="attended" {{ request('status') == 'attended' ? 'selected' : '' }}>Hadir</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold small">Cari Peserta</label>
                    <input type="text" class="form-control form-control-modern" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Nama, email, organisasi...">
                </div>
                <div class="col-md-3">
                    <label for="date" class="form-label fw-semibold small">Tanggal Daftar</label>
                    <select class="form-select form-select-modern" id="date" name="date">
                        <option value="">Semua</option>
                        <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary-modern w-100">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Participants List -->
    @if($participants->count() > 0)
        <div class="modern-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern mb-0">
                        <thead>
                            <tr>
                                <th>Peserta</th>
                                <th>Kontak</th>
                                <th>Status</th>
                                <th>Tanggal Daftar</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $participant)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="participant-avatar me-3" style="background: linear-gradient(135deg, var(--warning-400, #fbbf24) 0%, var(--orange-400, #fb923c) 100%); color: white;">
                                                {{ strtoupper(substr($participant->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $participant->user->name }}</div>
                                                <div class="text-muted small">{{ $participant->user->organization_name ?? 'Individual' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <div><i class="fas fa-envelope text-muted me-1"></i>{{ $participant->user->email }}</div>
                                            @if($participant->user->phone)
                                                <div><i class="fas fa-phone text-muted me-1"></i>{{ $participant->user->phone }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="status-badge status-{{ $participant->status }} dropdown-toggle border-0" 
                                                    type="button" data-bs-toggle="dropdown">
                                                {{ ucfirst($participant->status) }}
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $participant->id }}, 'registered')"><i class="fas fa-user-plus me-2 text-primary"></i>Terdaftar</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $participant->id }}, 'confirmed')"><i class="fas fa-check-circle me-2 text-success"></i>Dikonfirmasi</a></li>
                                                <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $participant->id }}, 'attended')"><i class="fas fa-user-check me-2" style="color: #8b5cf6;"></i>Hadir</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="updateStatus({{ $participant->id }}, 'cancelled')"><i class="fas fa-times-circle me-2"></i>Dibatalkan</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small">
                                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($participant->registered_at ?? $participant->created_at)->format('d M Y') }}</div>
                                            <div class="text-muted">{{ \Carbon\Carbon::parse($participant->registered_at ?? $participant->created_at)->format('H:i') }} WIB</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="action-btn" data-bs-toggle="modal" data-bs-target="#detailModal{{ $participant->id }}" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="action-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $participant->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($participants->hasPages())
                    <div class="p-4 border-top">
                        {{ $participants->links() }}
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="modern-card">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-users text-warning fs-1"></i>
                </div>
                <h4 class="mb-2 fw-bold">Belum Ada Peserta</h4>
                <p class="text-muted mb-4">Event ini belum memiliki peserta yang terdaftar.</p>
                <a href="{{ route('events.show', $event) }}" class="btn btn-primary-modern">
                    <i class="fas fa-eye me-2"></i>Lihat Halaman Event
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Status Update Form -->
<form id="statusUpdateForm" method="POST" style="display: none;">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" id="newStatus">
</form>

<!-- Detail Modal -->
@foreach($participants as $participant)
    <div class="modal fade" id="detailModal{{ $participant->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-user text-warning me-2"></i>
                        Detail Peserta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="fw-semibold mb-3"><i class="fas fa-id-card text-warning me-2"></i>Informasi Pribadi</h6>
                            <div class="p-3 rounded" style="background: var(--slate-50, #f8fafc);">
                                <div class="mb-2"><strong>Nama:</strong> {{ $participant->user->name }}</div>
                                <div class="mb-2"><strong>Email:</strong> {{ $participant->user->email }}</div>
                                <div class="mb-2"><strong>Telepon:</strong> {{ $participant->user->phone ?? '-' }}</div>
                                <div><strong>Organisasi:</strong> {{ $participant->user->organization_name ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-semibold mb-3"><i class="fas fa-clipboard-list text-warning me-2"></i>Detail Pendaftaran</h6>
                            <div class="p-3 rounded" style="background: var(--slate-50, #f8fafc);">
                                <div class="mb-2">
                                    <strong>Status:</strong> 
                                    <span class="status-badge status-{{ $participant->status }}">{{ ucfirst($participant->status) }}</span>
                                </div>
                                <div class="mb-2"><strong>Tanggal Daftar:</strong> {{ \Carbon\Carbon::parse($participant->registered_at ?? $participant->created_at)->format('d M Y H:i') }} WIB</div>
                                <div><strong>Diperbarui:</strong> {{ \Carbon\Carbon::parse($participant->updated_at)->format('d M Y H:i') }} WIB</div>
                            </div>
                        </div>
                    </div>
                    
                    @if($participant->notes)
                        <div class="mt-4">
                            <h6 class="fw-semibold mb-2"><i class="fas fa-sticky-note text-warning me-2"></i>Catatan</h6>
                            <div class="p-3 rounded" style="background: var(--slate-50, #f8fafc);">
                                {{ $participant->notes }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary-modern" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#editModal{{ $participant->id }}">
                        <i class="fas fa-edit me-1"></i>Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Edit Modal -->
@foreach($participants as $participant)
    <div class="modal fade" id="editModal{{ $participant->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="fas fa-edit text-warning me-2"></i>
                        Edit Peserta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('organizer.participants.update', [$participant->id, $participant->status]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_status{{ $participant->id }}" class="form-label fw-semibold">Status</label>
                            <select class="form-select form-select-modern" id="edit_status{{ $participant->id }}" name="status">
                                <option value="registered" {{ $participant->status === 'registered' ? 'selected' : '' }}>Terdaftar</option>
                                <option value="confirmed" {{ $participant->status === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="attended" {{ $participant->status === 'attended' ? 'selected' : '' }}>Hadir</option>
                                <option value="cancelled" {{ $participant->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="edit_notes{{ $participant->id }}" class="form-label fw-semibold">Catatan</label>
                            <textarea class="form-control form-control-modern" id="edit_notes{{ $participant->id }}" name="notes" rows="3" 
                                      placeholder="Catatan tambahan...">{{ $participant->notes }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary-modern">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
<script>
function updateStatus(participantId, newStatus) {
    document.getElementById('newStatus').value = newStatus;
    document.getElementById('statusUpdateForm').action = `/organizer/participants/${participantId}/${newStatus}`;
    document.getElementById('statusUpdateForm').submit();
}
</script>
@endpush
@endsection
