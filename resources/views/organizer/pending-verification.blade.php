@extends('layouts.app-v2')

@section('title', 'Pending Verification - TemuEvent')

@push('styles')
<style>
    .verification-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .verification-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        padding: 3rem;
        max-width: 800px;
        width: 100%;
    }
    
    .pending-icon {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(249, 115, 22, 0.15) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        animation: pulse 2s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .info-card {
        background: var(--slate-50, #f8fafc);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 1.5rem;
        height: 100%;
        transition: all 0.3s ease;
    }
    
    .info-card:hover {
        background: var(--slate-100, #f1f5f9);
    }
    
    .info-card-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius-lg, 0.75rem);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    
    .status-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
    }
    
    .status-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        font-size: 0.7rem;
    }
    
    .status-completed {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
        color: var(--success-600, #059669);
    }
    
    .status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.2) 0%, rgba(217, 119, 6, 0.2) 100%);
        color: var(--warning-600, #d97706);
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
    
    .btn-outline-modern {
        background: transparent;
        border: 2px solid var(--slate-200, #e2e8f0);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.875rem 2rem;
        font-weight: 600;
        color: var(--slate-700, #334155);
        transition: all 0.3s ease;
    }
    
    .btn-outline-modern:hover {
        border-color: var(--warning-500, #f59e0b);
        color: var(--warning-600, #d97706);
        background: rgba(245, 158, 11, 0.05);
    }
</style>
@endpush

@section('content')
<div class="verification-container">
    <div class="verification-card text-center">
        <div class="pending-icon">
            <i class="fas fa-clock text-warning" style="font-size: 3rem;"></i>
        </div>
        
        <h1 class="fw-bold mb-3" style="color: var(--slate-800, #1e293b);">Verifikasi Akun Pending</h1>
        <p class="text-muted mb-5" style="max-width: 500px; margin: 0 auto;">
            Akun Anda sedang dalam proses verifikasi oleh tim admin TemuEvent. 
            Proses ini biasanya membutuhkan waktu 1-2 hari kerja.
        </p>
        
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="info-card">
                    <div class="info-card-icon" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.2) 0%, rgba(37, 99, 235, 0.2) 100%);">
                        <i class="fas fa-info-circle text-primary fs-5"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Yang sedang terjadi:</h5>
                    <div class="text-start">
                        <div class="status-item">
                            <div class="status-icon status-completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Akun Anda telah didaftarkan</span>
                        </div>
                        <div class="status-item">
                            <div class="status-icon status-completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Dokumen sedang ditinjau</span>
                        </div>
                        <div class="status-item">
                            <div class="status-icon status-pending">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                            <span>Menunggu konfirmasi admin</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="info-card">
                    <div class="info-card-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);">
                        <i class="fas fa-tasks text-success fs-5"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Yang bisa Anda lakukan:</h5>
                    <div class="text-start">
                        <div class="status-item">
                            <div class="status-icon status-completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Memperbarui profil organizer</span>
                        </div>
                        <div class="status-item">
                            <div class="status-icon status-completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Menunggu email konfirmasi</span>
                        </div>
                        <div class="status-item">
                            <div class="status-icon status-completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Hubungi support jika ada pertanyaan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
            <a href="{{ route('organizer.profile') }}" class="btn btn-primary-modern">
                <i class="fas fa-user-edit me-2"></i>
                Perbarui Profil
            </a>
            <a href="mailto:support@temuanevent.com" class="btn btn-outline-modern">
                <i class="fas fa-envelope me-2"></i>
                Hubungi Support
            </a>
        </div>
        
        <div class="mt-4">
            <p class="text-muted small mb-0">
                <i class="fas fa-clock me-1"></i>
                Terakhir diperbarui: {{ now()->format('d M Y H:i') }} WIB
            </p>
        </div>
    </div>
</div>
@endsection
