@extends('layouts.app-v2')

@section('title', 'Profil Saya - TemuEvent')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb-modern mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-1">
                    <span class="title-icon">
                        <i class="fas fa-user"></i>
                    </span>
                    Profil Saya
                </h1>
                <p class="page-description mb-0">
                    Kelola informasi profil dan akun Anda
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row g-4">
    <!-- Main Form -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <div class="card-title-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                    Informasi Pribadi
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}" 
                                   placeholder="+62-xxx-xxxx-xxxx">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="role" class="form-label">Peran</label>
                            <input type="text" class="form-control bg-light" 
                                   value="{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}" readonly>
                        </div>
                        
                        <div class="col-12">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      id="bio" name="bio" rows="4" 
                                      placeholder="Ceritakan tentang diri Anda...">{{ old('bio', Auth::user()->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Profile Card -->
        <div class="card mb-4">
            <div class="card-body text-center py-4">
                <div class="avatar avatar-xl mx-auto mb-3">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h5 class="mb-1 fw-semibold">{{ Auth::user()->name }}</h5>
                <p class="text-muted mb-2">{{ Auth::user()->email }}</p>
                <span class="badge badge-primary">
                    <i class="fas fa-user me-1"></i>{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                </span>
                
                <div class="row mt-4 pt-3 border-top">
                    <div class="col-6 border-end">
                        <h5 class="text-primary mb-0">{{ $stats['total_events'] ?? 0 }}</h5>
                        <small class="text-muted">Event Diikuti</small>
                    </div>
                    <div class="col-6">
                        <h5 class="text-danger mb-0">{{ $stats['favorites'] ?? 0 }}</h5>
                        <small class="text-muted">Favorit</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <div class="card-title-icon" style="width: 28px; height: 28px;">
                        <i class="fas fa-bolt" style="font-size: 0.75rem;"></i>
                    </div>
                    Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('user.my-events') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-ticket-alt me-2"></i>Tiket Saya
                    </a>
                    <a href="{{ route('user.favorites') }}" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-heart me-2"></i>Event Favorit
                    </a>
                    <a href="{{ route('user.ratings') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-star me-2"></i>Review Saya
                    </a>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-compass me-2"></i>Jelajahi Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
