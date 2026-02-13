@extends('layouts.app-v2')

@section('title', 'Pengaturan Akun - TemuEvent')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb-modern mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-1">
                    <span class="title-icon">
                        <i class="fas fa-cog"></i>
                    </span>
                    Pengaturan Akun
                </h1>
                <p class="page-description mb-0">
                    Kelola preferensi dan pengaturan akun TemuEvent Anda
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<form onsubmit="event.preventDefault(); alert('Fitur simpan pengaturan akan segera hadir!'); return false;">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Notification Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <div class="card-title-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(59, 130, 246, 0.1)); color: #3b82f6;">
                            <i class="fas fa-bell"></i>
                        </div>
                        Pengaturan Notifikasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="setting-item p-3 bg-light rounded-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-semibold mb-1">
                                            <i class="fas fa-envelope text-primary me-2"></i>Notifikasi Email
                                        </h6>
                                        <p class="text-muted small mb-0">Terima notifikasi event baru dan pembaruan</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="email_notifications" {{ ($settings['email_notifications'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="setting-item p-3 bg-light rounded-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-semibold mb-1">
                                            <i class="fas fa-sms text-success me-2"></i>Notifikasi SMS
                                        </h6>
                                        <p class="text-muted small mb-0">Terima notifikasi penting via SMS</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="sms_notifications" {{ ($settings['sms_notifications'] ?? false) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="setting-item p-3 bg-light rounded-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-semibold mb-1">
                                            <i class="fas fa-star text-warning me-2"></i>Rekomendasi Event
                                        </h6>
                                        <p class="text-muted small mb-0">Rekomendasi sesuai minat Anda</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="event_recommendations" {{ ($settings['event_recommendations'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="setting-item p-3 bg-light rounded-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-semibold mb-1">
                                            <i class="fas fa-bullhorn text-info me-2"></i>Email Marketing
                                        </h6>
                                        <p class="text-muted small mb-0">Newsletter dan promo khusus</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="marketing_emails" {{ ($settings['marketing_emails'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Privacy Settings -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <div class="card-title-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1)); color: #10b981;">
                            <i class="fas fa-eye"></i>
                        </div>
                        Pengaturan Privasi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="setting-item p-3 bg-light rounded-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-semibold mb-1">
                                            <i class="fas fa-user-friends text-primary me-2"></i>Profil Publik
                                        </h6>
                                        <p class="text-muted small mb-0">Pengguna lain dapat melihat profil Anda</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="public_profile" {{ ($settings['public_profile'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="setting-item p-3 bg-light rounded-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="fw-semibold mb-1">
                                            <i class="fas fa-calendar-check text-success me-2"></i>Tampilkan Event
                                        </h6>
                                        <p class="text-muted small mb-0">Tampilkan event yang pernah diikuti</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="show_attended_events" {{ ($settings['show_attended_events'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Button -->
            <button type="submit" class="btn btn-primary btn-lg w-100">
                <i class="fas fa-save me-2"></i>Simpan Pengaturan
            </button>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Account Info -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <div class="card-title-icon" style="width: 28px; height: 28px;">
                            <i class="fas fa-info-circle" style="font-size: 0.75rem;"></i>
                        </div>
                        Informasi Akun
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                        <div class="avatar avatar-sm me-3" style="background: linear-gradient(135deg, var(--primary-500), var(--primary-600));">
                            <i class="fas fa-user" style="font-size: 0.75rem;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Status Akun</small>
                            <span class="badge badge-success">Aktif</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                        <div class="avatar avatar-sm me-3" style="background: linear-gradient(135deg, var(--accent-emerald), #059669);">
                            <i class="fas fa-calendar" style="font-size: 0.75rem;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Event Diikuti</small>
                            <span class="fw-semibold">{{ auth()->user()->events_attended_count ?? 0 }} Event</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3 p-2 bg-light rounded">
                        <div class="avatar avatar-sm me-3" style="background: linear-gradient(135deg, var(--accent-amber), #d97706);">
                            <i class="fas fa-star" style="font-size: 0.75rem;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Review Dibuat</small>
                            <span class="fw-semibold">{{ auth()->user()->reviews_count ?? 0 }} Review</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center p-2 bg-light rounded">
                        <div class="avatar avatar-sm me-3" style="background: linear-gradient(135deg, var(--accent-cyan), #0891b2);">
                            <i class="fas fa-clock" style="font-size: 0.75rem;"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Bergabung</small>
                            <span class="fw-semibold">{{ auth()->user()->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <div class="card-title-icon" style="width: 28px; height: 28px; background: linear-gradient(135deg, rgba(139, 92, 246, 0.2), rgba(139, 92, 246, 0.1)); color: #8b5cf6;">
                            <i class="fas fa-shield-alt" style="font-size: 0.75rem;"></i>
                        </div>
                        Keamanan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="alert('Fitur ubah password akan segera hadir!')">
                            <i class="fas fa-key me-2"></i>Ubah Password
                        </button>
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="alert('Fitur 2FA akan segera hadir!')">
                            <i class="fas fa-mobile-alt me-2"></i>Verifikasi 2FA
                        </button>
                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="alert('Fitur download data akan segera hadir!')">
                            <i class="fas fa-download me-2"></i>Download Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
