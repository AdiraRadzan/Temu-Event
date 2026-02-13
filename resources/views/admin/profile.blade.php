@extends('layouts.app-v2')

@section('title', 'Profil Admin - TemuEvent')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-user-shield"></i>
                    </span>
                    Profil Administrator
                </h1>
                <p class="page-description mb-0">
                    Kelola informasi profil dan akun administrator TemuEvent
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="badge badge-glass px-3 py-2">
                    <i class="fas fa-crown me-2"></i>Super Admin
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <!-- Main Profile Form -->
        <div class="col-xl-8">
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Edit Profil</h5>
                        <p class="card-subtitle mb-0">Perbarui informasi profil Anda</p>
                    </div>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-modern alert-success mb-4">
                            <div class="alert-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="alert-content">
                                <span>{{ session('success') }}</span>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="name" class="form-label-modern">Nama Lengkap</label>
                                    <div class="input-group-modern">
                                        <span class="input-icon"><i class="fas fa-user"></i></span>
                                        <input type="text" 
                                               class="form-control form-control-modern @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $user->name) }}" 
                                               required>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="email" class="form-label-modern">Email</label>
                                    <div class="input-group-modern">
                                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                        <input type="email" 
                                               class="form-control form-control-modern @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', $user->email) }}" 
                                               required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-4 mt-1">
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="phone" class="form-label-modern">Nomor Telepon</label>
                                    <div class="input-group-modern">
                                        <span class="input-icon"><i class="fas fa-phone"></i></span>
                                        <input type="text" 
                                               class="form-control form-control-modern @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone', $user->phone) }}"
                                               placeholder="Masukkan nomor telepon">
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-modern">
                                    <label for="role" class="form-label-modern">Role</label>
                                    <div class="input-group-modern">
                                        <span class="input-icon"><i class="fas fa-crown"></i></span>
                                        <input type="text" 
                                               class="form-control form-control-modern" 
                                               value="Administrator" 
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group-modern mt-4">
                            <label for="bio" class="form-label-modern">Bio</label>
                            <textarea class="form-control form-control-modern @error('bio') is-invalid @enderror" 
                                      id="bio" 
                                      name="bio" 
                                      rows="4" 
                                      placeholder="Deskripsi singkat tentang Anda...">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-modern btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Section -->
            <div class="card card-modern mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-warning-subtle">
                        <i class="fas fa-shield-alt text-warning"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Keamanan Akun</h5>
                        <p class="card-subtitle mb-0">Pengaturan keamanan dan autentikasi</p>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="security-item">
                                <div class="security-icon bg-success-subtle">
                                    <i class="fas fa-envelope-circle-check text-success"></i>
                                </div>
                                <div class="security-content">
                                    <h6 class="security-title">Email Verified</h6>
                                    <span class="security-status text-success">
                                        <i class="fas fa-check-circle me-1"></i>Terverifikasi
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="security-item">
                                <div class="security-icon bg-warning-subtle">
                                    <i class="fas fa-mobile-screen text-warning"></i>
                                </div>
                                <div class="security-content">
                                    <h6 class="security-title">Two-Factor Auth</h6>
                                    <span class="security-status text-warning">
                                        <i class="fas fa-exclamation-circle me-1"></i>Tidak Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-3 mt-4 pt-3 border-top">
                        <button class="btn btn-outline-modern btn-outline-primary">
                            <i class="fas fa-key me-2"></i>Ubah Password
                        </button>
                        <button class="btn btn-outline-modern btn-outline-success">
                            <i class="fas fa-mobile-alt me-2"></i>Aktifkan 2FA
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4">
            <!-- Account Info Card -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Informasi Akun</h5>
                        <p class="card-subtitle mb-0">Detail profil Anda</p>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="profile-avatar-section text-center mb-4">
                        <div class="profile-avatar-wrapper">
                            <div class="profile-avatar bg-primary-gradient">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="profile-badge bg-success">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                        <h5 class="profile-name mt-3 mb-1">{{ $user->name }}</h5>
                        <p class="profile-email text-muted mb-2">{{ $user->email }}</p>
                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                            <i class="fas fa-crown me-1"></i>Administrator
                        </span>
                    </div>

                    <div class="profile-info-list">
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">Bergabung</span>
                                <span class="info-value">{{ $user->created_at->format('d F Y') }}</span>
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">Login Terakhir</span>
                                <span class="info-value">{{ $user->updated_at->format('d F Y, H:i') }} WIB</span>
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="info-icon">
                                <i class="fas fa-hashtag"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label">User ID</span>
                                <span class="info-value">#{{ $user->id }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Stats Card -->
            <div class="card card-modern mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-info-subtle">
                        <i class="fas fa-chart-pie text-info"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Aktivitas Admin</h5>
                        <p class="card-subtitle mb-0">Statistik platform</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="activity-stat-list">
                        <div class="activity-stat-item">
                            <div class="stat-icon-small bg-primary-subtle">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Total Users</span>
                                <span class="stat-value">{{ \App\Models\User::count() }}</span>
                            </div>
                        </div>
                        <div class="activity-stat-item">
                            <div class="stat-icon-small bg-success-subtle">
                                <i class="fas fa-calendar-check text-success"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Total Events</span>
                                <span class="stat-value">{{ \App\Models\Event::count() }}</span>
                            </div>
                        </div>
                        <div class="activity-stat-item">
                            <div class="stat-icon-small bg-warning-subtle">
                                <i class="fas fa-hourglass-half text-warning"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Pending Approval</span>
                                <span class="stat-value">{{ \App\Models\User::where('organizer_status', 'pending')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Card Modern */
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

    /* Form Modern */
    .form-group-modern { margin-bottom: 0; }
    .form-label-modern {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }
    .input-group-modern {
        position: relative;
    }
    .input-group-modern .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        z-index: 1;
    }
    .form-control-modern {
        background: var(--surface);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-md);
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .form-control-modern:focus {
        background: white;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(var(--primary-rgb), 0.1);
    }
    textarea.form-control-modern {
        padding-left: 1rem;
    }

    /* Button Modern */
    .btn-modern {
        border-radius: var(--radius-md);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
    }
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }
    .btn-outline-modern {
        border-radius: var(--radius-md);
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        transition: all 0.3s ease;
    }

    /* Alert Modern */
    .alert-modern {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        border-radius: var(--radius-lg);
        border: none;
    }
    .alert-modern.alert-success {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }
    .alert-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        flex-shrink: 0;
    }
    .alert-success .alert-icon { color: var(--success); }

    /* Security Item */
    .security-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: var(--surface);
        border-radius: var(--radius-lg);
    }
    .security-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .security-title {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }
    .security-status {
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Profile Avatar */
    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
    }
    .profile-avatar {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
    }
    .bg-primary-gradient {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    }
    .profile-badge {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
        color: white;
        border: 2px solid white;
    }
    .profile-name { font-weight: 700; color: var(--text-primary); }
    .profile-email { font-size: 0.875rem; }

    /* Profile Info List */
    .profile-info-list { border-top: 1px solid var(--border-light); padding-top: 1rem; }
    .profile-info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 0;
    }
    .profile-info-item:not(:last-child) {
        border-bottom: 1px solid var(--border-light);
    }
    .info-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-md);
        background: var(--surface);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
    }
    .info-content { flex: 1; }
    .info-label { display: block; font-size: 0.75rem; color: var(--text-muted); }
    .info-value { font-weight: 600; color: var(--text-primary); font-size: 0.875rem; }

    /* Activity Stat List */
    .activity-stat-list { }
    .activity-stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-light);
        transition: background 0.2s ease;
    }
    .activity-stat-item:hover { background: rgba(var(--primary-rgb), 0.03); }
    .activity-stat-item:last-child { border-bottom: none; }
    .stat-icon-small {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-info { flex: 1; }
    .stat-info .stat-label { display: block; font-size: 0.8rem; color: var(--text-muted); }
    .stat-info .stat-value { font-size: 1.125rem; font-weight: 700; color: var(--text-primary); }

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
    .badge-glass {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        color: white;
        font-weight: 500;
    }
</style>
@endpush
@endsection
