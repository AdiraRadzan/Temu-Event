@extends('layouts.app-v2')

@section('title', 'Profil Organizer - TemuEvent')

@push('styles')
<style>
    .profile-header-card {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border-radius: var(--radius-xl, 1rem);
        padding: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .profile-header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border: 4px solid rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
    }
    
    .modern-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .modern-card:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }
    
    .modern-card .card-header {
        background: transparent;
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
        padding: 1.25rem 1.5rem;
    }
    
    .modern-card .card-body {
        padding: 1.5rem;
    }
    
    .form-control-modern {
        border: 2px solid var(--slate-200, #e2e8f0);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    
    .form-control-modern:focus {
        border-color: var(--warning-500, #f59e0b);
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    }
    
    .form-label-modern {
        font-weight: 600;
        color: var(--slate-700, #334155);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }
    
    .btn-primary-modern {
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        border: none;
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.875rem 2rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: var(--radius-lg, 0.75rem);
        background: var(--slate-50, #f8fafc);
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        background: var(--slate-100, #f1f5f9);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-lg, 0.75rem);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }
    
    .verification-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: var(--radius-lg, 0.75rem);
        background: var(--slate-50, #f8fafc);
        margin-bottom: 0.75rem;
    }
    
    .verification-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }
    
    .info-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.875rem 0;
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
    }
    
    .info-list-item:last-child {
        border-bottom: none;
    }
    
    .verified-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .alert-modern {
        border-radius: var(--radius-lg, 0.75rem);
        border: none;
        padding: 1rem 1.25rem;
    }
    
    .alert-success-modern {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        color: var(--success-700, #047857);
    }
    
    .alert-info-modern {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.1) 100%);
        color: var(--primary-700, #1d4ed8);
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
                        <li class="breadcrumb-item active" aria-current="page" style="color: var(--warning-800, #92400e);">Profil</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2" style="color: var(--warning-900, #78350f);">
                    <i class="fas fa-user-tie me-3"></i>
                    Profil Event Organizer
                </h1>
                <p class="mb-0" style="color: var(--warning-700, #b45309);">
                    Kelola informasi profil dan akun Event Organizer Anda
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="verified-badge">
                    <i class="fas fa-star"></i>
                    Verified Organizer
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Profile Header Card -->
    <div class="profile-header-card mb-4">
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="profile-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
            <div class="col">
                <h2 class="mb-1 fw-bold">{{ auth()->user()->name }}</h2>
                <p class="mb-2 opacity-75">{{ auth()->user()->email }}</p>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-white bg-opacity-25">
                        <i class="fas fa-building me-1"></i>
                        {{ auth()->user()->organization_name ?? 'Organisasi belum diisi' }}
                    </span>
                    <span class="badge bg-white bg-opacity-25">
                        <i class="fas fa-calendar-check me-1"></i>
                        Bergabung {{ auth()->user()->created_at->format('d M Y') }}
                    </span>
                </div>
            </div>
            <div class="col-auto d-none d-md-block">
                <div class="text-end">
                    <div class="fs-3 fw-bold">{{ \App\Models\Event::where('organizer_id', auth()->id())->count() }}</div>
                    <div class="small opacity-75">Event Dibuat</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Edit Profile Form -->
            <div class="modern-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-edit text-warning me-2"></i>
                        Edit Profil Organizer
                    </h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-modern alert-success-modern mb-4">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('organizer.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label-modern">
                                    <i class="fas fa-user text-warning me-1"></i>
                                    Nama Lengkap
                                </label>
                                <input type="text" 
                                       class="form-control form-control-modern @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', auth()->user()->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label-modern">
                                    <i class="fas fa-envelope text-warning me-1"></i>
                                    Email
                                </label>
                                <input type="email" 
                                       class="form-control form-control-modern @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', auth()->user()->email) }}" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row g-4 mt-1">
                            <div class="col-md-6">
                                <label for="phone" class="form-label-modern">
                                    <i class="fas fa-phone text-warning me-1"></i>
                                    Nomor Telepon
                                </label>
                                <input type="text" 
                                       class="form-control form-control-modern @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', auth()->user()->phone) }}"
                                       placeholder="08xxxxxxxxxx">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="organization_name" class="form-label-modern">
                                    <i class="fas fa-building text-warning me-1"></i>
                                    Nama Organisasi
                                </label>
                                <input type="text" 
                                       class="form-control form-control-modern @error('organization_name') is-invalid @enderror" 
                                       id="organization_name" 
                                       name="organization_name" 
                                       value="{{ old('organization_name', auth()->user()->organization_name) }}"
                                       placeholder="Nama organisasi Anda">
                                @error('organization_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="bio" class="form-label-modern">
                                <i class="fas fa-align-left text-warning me-1"></i>
                                Bio / Deskripsi
                            </label>
                            <textarea class="form-control form-control-modern @error('bio') is-invalid @enderror" 
                                      id="bio" 
                                      name="bio" 
                                      rows="4" 
                                      placeholder="Ceritakan tentang organisasi/event organizer Anda...">{{ old('bio', auth()->user()->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn btn-primary-modern btn-lg w-100">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Verification Status -->
            <div class="modern-card">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-award text-warning me-2"></i>
                        Status Verifikasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="verification-item">
                                <div class="verification-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                    <i class="fas fa-check-circle text-success fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Email Verified</h6>
                                    <span class="badge bg-success">Terverifikasi</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="verification-item">
                                <div class="verification-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                    <i class="fas fa-user-check text-success fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Organizer Verified</h6>
                                    <span class="badge bg-success">Terverifikasi Admin</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-modern alert-info-modern mt-4 mb-0">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-info-circle me-3 mt-1"></i>
                            <div>
                                <strong>Status Akun:</strong>
                                <p class="mb-0 mt-1">Akun Event Organizer Anda sudah terverifikasi penuh dan siap untuk membuat event baru.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Account Info -->
            <div class="modern-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-info-circle text-warning me-2"></i>
                        Informasi Akun
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-list-item">
                        <span class="text-muted">
                            <i class="fas fa-id-badge me-2"></i>ID Akun
                        </span>
                        <span class="fw-semibold">#{{ auth()->id() }}</span>
                    </div>
                    <div class="info-list-item">
                        <span class="text-muted">
                            <i class="fas fa-user-tag me-2"></i>Role
                        </span>
                        <span class="badge bg-warning text-dark">Event Organizer</span>
                    </div>
                    <div class="info-list-item">
                        <span class="text-muted">
                            <i class="fas fa-calendar-plus me-2"></i>Bergabung
                        </span>
                        <span class="fw-semibold">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="info-list-item">
                        <span class="text-muted">
                            <i class="fas fa-clock me-2"></i>Terakhir Update
                        </span>
                        <span class="fw-semibold">{{ auth()->user()->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="modern-card">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-chart-bar text-warning me-2"></i>
                        Statistik Organizer
                    </h5>
                </div>
                <div class="card-body">
                    <div class="stat-item mb-3">
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);">
                            <i class="fas fa-calendar-alt text-primary fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-5">{{ \App\Models\Event::where('organizer_id', auth()->id())->count() }}</div>
                            <div class="text-muted small">Event Dibuat</div>
                        </div>
                    </div>
                    
                    <div class="stat-item mb-3">
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                            <i class="fas fa-ticket-alt text-success fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-5">{{ \App\Models\EventParticipant::whereHas('event', function($q) { $q->where('organizer_id', auth()->id()); })->count() }}</div>
                            <div class="text-muted small">Total Booking</div>
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);">
                            <i class="fas fa-star text-warning fs-5"></i>
                        </div>
                        <div>
                            <div class="fw-bold fs-5">4.8</div>
                            <div class="text-muted small">Rating Rata-rata</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="modern-card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('organizer.events.create') }}" class="btn btn-primary-modern w-100 mb-2">
                        <i class="fas fa-plus-circle me-2"></i>Buat Event Baru
                    </a>
                    <a href="{{ route('organizer.events.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                        <i class="fas fa-list me-2"></i>Kelola Event
                    </a>
                    <a href="{{ route('organizer.settings') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-cog me-2"></i>Pengaturan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
