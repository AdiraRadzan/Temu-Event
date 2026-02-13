@extends('layouts.app-v2')

@section('title', 'Pengaturan Admin')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-2">
                    <ol class="breadcrumb breadcrumb-modern">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2">
                    <span class="title-icon">
                        <i class="fas fa-cog"></i>
                    </span>
                    Pengaturan Sistem
                </h1>
                <p class="page-description mb-0">
                    Kelola konfigurasi dan pengaturan platform TemuEvent
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="badge badge-glass bg-success-glass px-3 py-2">
                    <i class="fas fa-check-circle me-2"></i>Sistem Aktif
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        <!-- Main Settings -->
        <div class="col-xl-8">
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon">
                        <i class="fas fa-sliders-h"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Pengaturan Umum</h5>
                        <p class="card-subtitle mb-0">Konfigurasi dasar platform</p>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form>
                        <div class="settings-section">
                            <h6 class="settings-section-title">
                                <i class="fas fa-globe me-2"></i>Informasi Website
                            </h6>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label for="site_name" class="form-label-modern">Nama Website</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="fas fa-heading"></i></span>
                                            <input type="text" class="form-control form-control-modern" id="site_name" value="{{ $settings['site_name'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label for="notification_email" class="form-label-modern">Email Notifikasi</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control form-control-modern" id="notification_email" value="{{ $settings['notification_email'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-modern mt-4">
                                <label for="site_description" class="form-label-modern">Deskripsi Website</label>
                                <textarea class="form-control form-control-modern" id="site_description" rows="3">{{ $settings['site_description'] }}</textarea>
                            </div>
                        </div>

                        <div class="settings-section mt-5">
                            <h6 class="settings-section-title">
                                <i class="fas fa-headset me-2"></i>Kontak & Support
                            </h6>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label for="support_phone" class="form-label-modern">Telepon Support</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="fas fa-phone"></i></span>
                                            <input type="text" class="form-control form-control-modern" id="support_phone" value="{{ $settings['support_phone'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label for="max_events" class="form-label-modern">Maksimal Event per Organizer</label>
                                        <div class="input-group-modern">
                                            <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="number" class="form-control form-control-modern" id="max_events" value="{{ $settings['max_events_per_organizer'] }}" min="1" max="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="settings-section mt-5">
                            <h6 class="settings-section-title">
                                <i class="fas fa-toggle-on me-2"></i>Fitur Platform
                            </h6>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="toggle-card">
                                        <div class="toggle-info">
                                            <div class="toggle-icon bg-primary-subtle">
                                                <i class="fas fa-check-double text-primary"></i>
                                            </div>
                                            <div class="toggle-content">
                                                <h6 class="toggle-title">Persetujuan Event</h6>
                                                <p class="toggle-description">Aktifkan moderasi event sebelum publish</p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-switch-lg">
                                            <input class="form-check-input" type="checkbox" id="enable_approval" {{ $settings['enable_event_approval'] ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="toggle-card">
                                        <div class="toggle-info">
                                            <div class="toggle-icon bg-success-subtle">
                                                <i class="fas fa-user-plus text-success"></i>
                                            </div>
                                            <div class="toggle-content">
                                                <h6 class="toggle-title">Registrasi User</h6>
                                                <p class="toggle-description">Izinkan pengguna baru mendaftar</p>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-switch-lg">
                                            <input class="form-check-input" type="checkbox" id="enable_registration" {{ $settings['enable_user_registration'] ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-top">
                            <button type="submit" class="btn btn-primary btn-modern btn-lg">
                                <i class="fas fa-save me-2"></i>Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4">
            <!-- System Info Card -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-info-subtle">
                        <i class="fas fa-server text-info"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Informasi Sistem</h5>
                        <p class="card-subtitle mb-0">Status server & framework</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="system-info-list">
                        <div class="system-info-item">
                            <div class="system-icon bg-primary-subtle">
                                <i class="fab fa-laravel text-primary"></i>
                            </div>
                            <div class="system-content">
                                <span class="system-label">Laravel Framework</span>
                                <span class="system-value">v{{ app()->version() }}</span>
                            </div>
                            <span class="system-status status-success">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        </div>
                        <div class="system-info-item">
                            <div class="system-icon bg-success-subtle">
                                <i class="fas fa-database text-success"></i>
                            </div>
                            <div class="system-content">
                                <span class="system-label">Database</span>
                                <span class="system-value">MySQL Connected</span>
                            </div>
                            <span class="system-status status-success">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        </div>
                        <div class="system-info-item">
                            <div class="system-icon bg-warning-subtle">
                                <i class="fas fa-shield-alt text-warning"></i>
                            </div>
                            <div class="system-content">
                                <span class="system-label">Security</span>
                                <span class="system-value">CSRF Protection</span>
                            </div>
                            <span class="system-status status-success">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        </div>
                        <div class="system-info-item">
                            <div class="system-icon bg-info-subtle">
                                <i class="fas fa-clock text-info"></i>
                            </div>
                            <div class="system-content">
                                <span class="system-label">Server Time</span>
                                <span class="system-value">{{ now()->format('H:i:s') }} WIB</span>
                            </div>
                            <span class="system-status status-success">
                                <i class="fas fa-sync-alt"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card card-modern mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-primary-subtle">
                        <i class="fas fa-tools text-primary"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0">Aksi Cepat</h5>
                        <p class="card-subtitle mb-0">Tools & maintenance</p>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="quick-tools-grid">
                        <button class="quick-tool-btn" onclick="clearCache()">
                            <div class="tool-icon bg-primary-subtle">
                                <i class="fas fa-broom text-primary"></i>
                            </div>
                            <span class="tool-label">Clear Cache</span>
                        </button>
                        <button class="quick-tool-btn" onclick="exportData()">
                            <div class="tool-icon bg-success-subtle">
                                <i class="fas fa-download text-success"></i>
                            </div>
                            <span class="tool-label">Export Data</span>
                        </button>
                        <button class="quick-tool-btn" onclick="cleanupLogs()">
                            <div class="tool-icon bg-warning-subtle">
                                <i class="fas fa-trash-alt text-warning"></i>
                            </div>
                            <span class="tool-label">Cleanup Logs</span>
                        </button>
                        <button class="quick-tool-btn" onclick="generateReport()">
                            <div class="tool-icon bg-info-subtle">
                                <i class="fas fa-file-chart-line text-info"></i>
                            </div>
                            <span class="tool-label">Generate Report</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="card card-modern card-danger mt-4">
                <div class="card-header card-header-modern">
                    <div class="card-header-icon bg-danger-subtle">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                    </div>
                    <div class="card-header-content">
                        <h5 class="card-title mb-0 text-danger">Zona Berbahaya</h5>
                        <p class="card-subtitle mb-0">Aksi yang tidak dapat dibatalkan</p>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="danger-action">
                        <div class="danger-info">
                            <h6 class="danger-title">Reset Semua Data</h6>
                            <p class="danger-description">Menghapus semua data event dan pengguna</p>
                        </div>
                        <button class="btn btn-outline-danger btn-sm" disabled>
                            <i class="fas fa-trash me-1"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function clearCache() {
    if(confirm('Apakah Anda yakin ingin membersihkan cache?')) {
        alert('Cache berhasil dibersihkan!');
    }
}
function exportData() {
    alert('Mengekspor data...');
}
function cleanupLogs() {
    if(confirm('Apakah Anda yakin ingin menghapus logs lama?')) {
        alert('Logs berhasil dibersihkan!');
    }
}
function generateReport() {
    alert('Membuat laporan...');
}
</script>

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
    .card-modern.card-danger {
        border-color: rgba(239, 68, 68, 0.2);
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

    /* Settings Section */
    .settings-section { }
    .settings-section-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-light);
        display: flex;
        align-items: center;
    }

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

    /* Toggle Card */
    .toggle-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-light);
    }
    .toggle-info { display: flex; align-items: center; gap: 1rem; }
    .toggle-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        flex-shrink: 0;
    }
    .toggle-title { font-weight: 600; color: var(--text-primary); margin: 0 0 0.25rem; font-size: 0.9rem; }
    .toggle-description { font-size: 0.75rem; color: var(--text-muted); margin: 0; }
    .form-switch-lg .form-check-input {
        width: 48px;
        height: 26px;
        cursor: pointer;
    }

    /* System Info List */
    .system-info-list { }
    .system-info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-light);
        transition: background 0.2s ease;
    }
    .system-info-item:hover { background: rgba(var(--primary-rgb), 0.03); }
    .system-info-item:last-child { border-bottom: none; }
    .system-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 1.125rem;
    }
    .system-content { flex: 1; }
    .system-label { display: block; font-size: 0.8rem; color: var(--text-muted); }
    .system-value { font-weight: 600; color: var(--text-primary); font-size: 0.875rem; }
    .system-status { font-size: 1rem; }
    .system-status.status-success { color: var(--success); }

    /* Quick Tools Grid */
    .quick-tools-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    .quick-tool-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1.25rem 1rem;
        background: var(--surface);
        border: 1px solid var(--border-light);
        border-radius: var(--radius-lg);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .quick-tool-btn:hover {
        background: var(--primary);
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }
    .quick-tool-btn:hover .tool-icon { background: rgba(255,255,255,0.2); }
    .quick-tool-btn:hover .tool-icon i { color: white; }
    .quick-tool-btn:hover .tool-label { color: white; }
    .tool-icon {
        width: 44px;
        height: 44px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        transition: all 0.3s ease;
    }
    .tool-label { font-size: 0.8rem; font-weight: 600; color: var(--text-primary); transition: color 0.3s ease; }

    /* Danger Zone */
    .danger-action {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }
    .danger-title { font-weight: 600; color: var(--danger); margin: 0 0 0.25rem; font-size: 0.9rem; }
    .danger-description { font-size: 0.75rem; color: var(--text-muted); margin: 0; }

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
    .bg-success-glass {
        background: rgba(16, 185, 129, 0.3);
    }
</style>
@endpush
@endsection
