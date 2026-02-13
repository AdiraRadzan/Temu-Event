@extends('layouts.app-v2')

@section('title', 'Pengaturan Organizer - TemuEvent')

@push('styles')
<style>
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
    
    .setting-item {
        display: flex;
        align-items: flex-start;
        padding: 1.25rem;
        border-radius: var(--radius-lg, 0.75rem);
        background: var(--slate-50, #f8fafc);
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .setting-item:hover {
        background: var(--slate-100, #f1f5f9);
    }
    
    .setting-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-lg, 0.75rem);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .setting-content {
        flex: 1;
    }
    
    .setting-toggle {
        flex-shrink: 0;
        margin-left: 1rem;
    }
    
    .form-check-input {
        width: 3rem;
        height: 1.5rem;
        cursor: pointer;
    }
    
    .form-check-input:checked {
        background-color: var(--warning-500, #f59e0b);
        border-color: var(--warning-500, #f59e0b);
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.2);
        border-color: var(--warning-500, #f59e0b);
    }
    
    .form-select-modern {
        border: 2px solid var(--slate-200, #e2e8f0);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    
    .form-select-modern:focus {
        border-color: var(--warning-500, #f59e0b);
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
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
        margin-bottom: 0.75rem;
    }
    
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-lg, 0.75rem);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }
    
    .tool-btn {
        display: flex;
        align-items: center;
        padding: 0.875rem 1rem;
        border-radius: var(--radius-lg, 0.75rem);
        border: 2px solid var(--slate-200, #e2e8f0);
        background: white;
        color: var(--slate-700, #334155);
        text-decoration: none;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .tool-btn:hover {
        border-color: var(--warning-500, #f59e0b);
        background: rgba(245, 158, 11, 0.05);
        color: var(--warning-600, #d97706);
        transform: translateX(4px);
    }
    
    .tool-btn i {
        width: 20px;
        margin-right: 0.75rem;
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
                        <li class="breadcrumb-item active" aria-current="page" style="color: var(--warning-800, #92400e);">Pengaturan</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2" style="color: var(--warning-900, #78350f);">
                    <i class="fas fa-cog me-3"></i>
                    Pengaturan Organizer
                </h1>
                <p class="mb-0" style="color: var(--warning-700, #b45309);">
                    Kelola pengaturan khusus untuk akun Event Organizer Anda
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="badge px-3 py-2" style="background: linear-gradient(135deg, var(--warning-500, #f59e0b) 0%, var(--orange-500, #f97316) 100%); font-size: 0.875rem;">
                    <i class="fas fa-user-tie me-1"></i>
                    Event Organizer
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <form action="{{ route('organizer.settings') }}" method="POST" onsubmit="event.preventDefault(); alert('Fitur simpan pengaturan akan segera hadir!'); return false;">
        @csrf
        
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Notification Settings -->
                <div class="modern-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-bell text-warning me-2"></i>
                            Pengaturan Notifikasi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="setting-item">
                            <div class="setting-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);">
                                <i class="fas fa-envelope text-primary fs-5"></i>
                            </div>
                            <div class="setting-content">
                                <h6 class="mb-1 fw-semibold">Notifikasi Email</h6>
                                <p class="text-muted small mb-0">Terima notifikasi booking dan inquiries melalui email</p>
                            </div>
                            <div class="setting-toggle">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="email_notifications" id="email_notifications" {{ $settings['email_notifications'] ?? true ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                <i class="fas fa-sms text-success fs-5"></i>
                            </div>
                            <div class="setting-content">
                                <h6 class="mb-1 fw-semibold">Notifikasi SMS</h6>
                                <p class="text-muted small mb-0">Notifikasi urgent melalui SMS</p>
                            </div>
                            <div class="setting-toggle">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="sms_notifications" id="sms_notifications" {{ $settings['sms_notifications'] ?? false ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-icon" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.2) 0%, rgba(124, 58, 237, 0.2) 100%);">
                                <i class="fas fa-bullhorn text-purple fs-5" style="color: #8b5cf6;"></i>
                            </div>
                            <div class="setting-content">
                                <h6 class="mb-1 fw-semibold">Email Marketing</h6>
                                <p class="text-muted small mb-0">Promo dan penawaran khusus untuk organizer</p>
                            </div>
                            <div class="setting-toggle">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="marketing_emails" id="marketing_emails" {{ $settings['marketing_emails'] ?? true ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Settings -->
                <div class="modern-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-ticket-alt text-warning me-2"></i>
                            Pengaturan Booking
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="setting-item">
                            <div class="setting-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                <i class="fas fa-check-circle text-success fs-5"></i>
                            </div>
                            <div class="setting-content">
                                <h6 class="mb-1 fw-semibold">Auto Approve Booking</h6>
                                <p class="text-muted small mb-0">Setujui booking dari peserta secara otomatis tanpa perlu konfirmasi manual</p>
                            </div>
                            <div class="setting-toggle">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="auto_approve_bookings" id="auto_approve_bookings" {{ $settings['auto_approve_bookings'] ?? false ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analytics & Dashboard -->
                <div class="modern-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-chart-line text-warning me-2"></i>
                            Analytics & Dashboard
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="setting-item">
                            <div class="setting-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);">
                                <i class="fas fa-chart-bar text-primary fs-5"></i>
                            </div>
                            <div class="setting-content">
                                <h6 class="mb-1 fw-semibold">Tampilkan Analytics</h6>
                                <p class="text-muted small mb-0">Aktifkan dashboard analytics di organizer panel</p>
                            </div>
                            <div class="setting-toggle">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="show_analytics" id="show_analytics" {{ $settings['show_analytics'] ?? true ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item mb-0">
                            <div class="setting-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                <i class="fas fa-user-friends text-success fs-5"></i>
                            </div>
                            <div class="setting-content">
                                <h6 class="mb-1 fw-semibold">Profil Organisasi Publik</h6>
                                <p class="text-muted small mb-0">Biarkan event-goers melihat profil organisasi Anda</p>
                            </div>
                            <div class="setting-toggle">
                                <div class="form-check form-switch mb-0">
                                    <input class="form-check-input" type="checkbox" name="public_profile" id="public_profile" {{ $settings['public_profile'] ?? true ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Limits & Quotas -->
                <div class="modern-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-tasks text-warning me-2"></i>
                            Batasan & Kuota
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="max_events_per_month" class="form-label fw-semibold mb-2">
                                    <i class="fas fa-calendar-alt text-warning me-1"></i>
                                    Maksimal Event per Bulan
                                </label>
                                <select class="form-select form-select-modern" id="max_events_per_month" name="max_events_per_month">
                                    <option value="5" {{ ($settings['max_events_per_month'] ?? 10) == 5 ? 'selected' : '' }}>5 Event</option>
                                    <option value="10" {{ ($settings['max_events_per_month'] ?? 10) == 10 ? 'selected' : '' }}>10 Event</option>
                                    <option value="20" {{ ($settings['max_events_per_month'] ?? 10) == 20 ? 'selected' : '' }}>20 Event</option>
                                    <option value="unlimited" {{ ($settings['max_events_per_month'] ?? 10) == 'unlimited' ? 'selected' : '' }}>Unlimited</option>
                                </select>
                                <p class="text-muted small mt-2 mb-0">Batasan jumlah event yang bisa dibuat per bulan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn btn-primary-modern btn-lg w-100">
                    <i class="fas fa-save me-2"></i>Simpan Pengaturan
                </button>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Status Organizer -->
                <div class="modern-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-info-circle text-warning me-2"></i>
                            Status Organizer
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="stat-item">
                            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);">
                                <i class="fas fa-user-tie text-warning fs-5"></i>
                            </div>
                            <div>
                                <div class="small text-muted">Status Verifikasi</div>
                                <span class="badge bg-success">Terverifikasi</span>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                                <i class="fas fa-calendar text-success fs-5"></i>
                            </div>
                            <div>
                                <div class="small text-muted">Event Dibuat</div>
                                <div class="fw-bold">{{ \App\Models\Event::where('organizer_id', auth()->id())->count() }} Event</div>
                            </div>
                        </div>
                        
                        <div class="stat-item">
                            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);">
                                <i class="fas fa-ticket-alt text-primary fs-5"></i>
                            </div>
                            <div>
                                <div class="small text-muted">Total Booking</div>
                                <div class="fw-bold">{{ \App\Models\EventParticipant::whereHas('event', function($q) { $q->where('organizer_id', auth()->id()); })->count() }} Booking</div>
                            </div>
                        </div>
                        
                        <div class="stat-item mb-0">
                            <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);">
                                <i class="fas fa-star text-warning fs-5"></i>
                            </div>
                            <div>
                                <div class="small text-muted">Rating Rata-rata</div>
                                <div class="fw-bold">4.8 / 5.0</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tools Organizer -->
                <div class="modern-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-tools text-warning me-2"></i>
                            Tools Organizer
                        </h5>
                    </div>
                    <div class="card-body">
                        <a href="#" class="tool-btn">
                            <i class="fas fa-download text-primary"></i>
                            <span>Export Data Event</span>
                        </a>
                        <a href="#" class="tool-btn">
                            <i class="fas fa-chart-pie text-success"></i>
                            <span>Laporan Analytics</span>
                        </a>
                        <a href="#" class="tool-btn">
                            <i class="fas fa-envelope text-warning"></i>
                            <span>Template Email</span>
                        </a>
                        <a href="#" class="tool-btn mb-0">
                            <i class="fas fa-plug text-info"></i>
                            <span>Integrasi API</span>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="modern-card mt-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0 fw-semibold">
                            <i class="fas fa-link text-warning me-2"></i>
                            Quick Links
                        </h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('organizer.profile') }}" class="tool-btn">
                            <i class="fas fa-user text-warning"></i>
                            <span>Edit Profil</span>
                        </a>
                        <a href="{{ route('organizer.events.index') }}" class="tool-btn">
                            <i class="fas fa-calendar-alt text-primary"></i>
                            <span>Kelola Event</span>
                        </a>
                        <a href="{{ route('organizer.dashboard') }}" class="tool-btn mb-0">
                            <i class="fas fa-home text-success"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
