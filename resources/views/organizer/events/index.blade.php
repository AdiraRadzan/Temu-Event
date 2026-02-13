@extends('layouts.app-v2')

@section('title', 'Kelola Event - TemuEvent')

@push('styles')
<style>
    .modern-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border: none;
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .table-modern {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .table-modern thead th {
        background: var(--slate-50, #f8fafc);
        border: none;
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: var(--slate-600, #475569);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .table-modern tbody td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
        vertical-align: middle;
    }
    
    .table-modern tbody tr:hover {
        background: var(--slate-50, #f8fafc);
    }
    
    .event-title {
        font-weight: 600;
        color: var(--slate-800, #1e293b);
        margin-bottom: 0.25rem;
    }
    
    .event-desc {
        color: var(--slate-500, #64748b);
        font-size: 0.875rem;
    }
    
    .badge-category {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
        color: var(--primary-600, #2563eb);
        padding: 0.375rem 0.75rem;
        border-radius: var(--radius-md, 0.5rem);
        font-weight: 500;
        font-size: 0.8rem;
    }
    
    .badge-participants {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);
        color: var(--primary-700, #1d4ed8);
        padding: 0.375rem 0.75rem;
        border-radius: var(--radius-md, 0.5rem);
        font-weight: 600;
    }
    
    .badge-status-published {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
        color: var(--success-700, #047857);
    }
    
    .badge-status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);
        color: var(--warning-700, #b45309);
    }
    
    .badge-status-draft {
        background: var(--slate-200, #e2e8f0);
        color: var(--slate-600, #475569);
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
    
    .action-btn.view:hover {
        background: rgba(59, 130, 246, 0.1);
        border-color: var(--primary-500, #3b82f6);
        color: var(--primary-600, #2563eb);
    }
    
    .action-btn.edit:hover {
        background: rgba(245, 158, 11, 0.1);
        border-color: var(--warning-500, #f59e0b);
        color: var(--warning-600, #d97706);
    }
    
    .action-btn.participants:hover {
        background: rgba(16, 185, 129, 0.1);
        border-color: var(--success-500, #10b981);
        color: var(--success-600, #059669);
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
    
    .date-info {
        font-size: 0.875rem;
        color: var(--slate-600, #475569);
    }
    
    .date-info .date {
        font-weight: 600;
        color: var(--slate-800, #1e293b);
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
                        <li class="breadcrumb-item active" aria-current="page" style="color: var(--warning-800, #92400e);">Kelola Event</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2" style="color: var(--warning-900, #78350f);">
                    <i class="fas fa-calendar-alt me-3"></i>
                    Kelola Event
                </h1>
                <p class="mb-0" style="color: var(--warning-700, #b45309);">
                    Kelola semua event yang telah Anda buat
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('organizer.events.create') }}" class="btn btn-primary-modern">
                    <i class="fas fa-plus-circle me-2"></i>Buat Event Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    @if($events->count() > 0)
        <div class="modern-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern mb-0">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th class="text-center">Peserta</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($event->image)
                                                <img src="{{ asset('storage/' . $event->image) }}" 
                                                     alt="{{ $event->title }}" 
                                                     class="rounded me-3" 
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="rounded me-3 d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--warning-100, #fef3c7) 0%, var(--orange-100, #ffedd5) 100%);">
                                                    <i class="fas fa-calendar-alt text-warning"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="event-title">{{ $event->title }}</div>
                                                <div class="event-desc">{{ Str::limit($event->short_description, 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-category">{{ $event->category->name ?? 'Uncategorized' }}</span>
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <div class="date">{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</div>
                                            <div>{{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-participants">
                                            <i class="fas fa-users me-1"></i>
                                            {{ $event->participants->count() ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($event->status === 'published')
                                            <span class="badge badge-status-published px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i>Published
                                            </span>
                                        @elseif($event->status === 'pending')
                                            <span class="badge badge-status-pending px-3 py-2">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @else
                                            <span class="badge badge-status-draft px-3 py-2">
                                                <i class="fas fa-file-alt me-1"></i>Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('organizer.events.show', $event) }}" class="action-btn view" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('organizer.events.edit', $event) }}" class="action-btn edit" title="Edit Event">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('organizer.events.participants', $event) }}" class="action-btn participants" title="Kelola Peserta">
                                            <i class="fas fa-users"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($events->hasPages())
                    <div class="p-4 border-top">
                        {{ $events->links() }}
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="modern-card">
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-calendar-alt text-warning fs-1"></i>
                </div>
                <h4 class="mb-2 fw-bold" style="color: var(--slate-800, #1e293b);">Belum Ada Event</h4>
                <p class="text-muted mb-4">Anda belum membuat event apapun. Mulai dengan membuat event pertama Anda!</p>
                <a href="{{ route('organizer.events.create') }}" class="btn btn-primary-modern">
                    <i class="fas fa-plus-circle me-2"></i>Buat Event Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
