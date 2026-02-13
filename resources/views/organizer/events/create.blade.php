@extends('layouts.app-v2')

@section('title', 'Buat Event Baru - TemuEvent')

@push('styles')
<style>
    .modern-card {
        background: white;
        border-radius: var(--radius-xl, 1rem);
        border: 1px solid var(--slate-200, #e2e8f0);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .modern-card .card-header {
        background: transparent;
        border-bottom: 1px solid var(--slate-100, #f1f5f9);
        padding: 1.25rem 1.5rem;
    }
    
    .modern-card .card-body {
        padding: 1.5rem;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        font-weight: 600;
        color: var(--warning-700, #b45309);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--warning-200, #fde68a);
    }
    
    .section-title i {
        margin-right: 0.75rem;
        color: var(--warning-500, #f59e0b);
    }
    
    .form-label-modern {
        font-weight: 600;
        color: var(--slate-700, #334155);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }
    
    .form-control-modern, .form-select-modern {
        border: 2px solid var(--slate-200, #e2e8f0);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    
    .form-control-modern:focus, .form-select-modern:focus {
        border-color: var(--warning-500, #f59e0b);
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
    }
    
    .form-control-modern.is-invalid, .form-select-modern.is-invalid {
        border-color: var(--danger-500, #ef4444);
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
    
    .btn-secondary-modern {
        background: var(--slate-100, #f1f5f9);
        border: 2px solid var(--slate-200, #e2e8f0);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 0.875rem 2rem;
        font-weight: 600;
        color: var(--slate-700, #334155);
        transition: all 0.3s ease;
    }
    
    .btn-secondary-modern:hover {
        background: var(--slate-200, #e2e8f0);
        color: var(--slate-800, #1e293b);
    }
    
    .required-star {
        color: var(--danger-500, #ef4444);
    }
    
    .form-hint {
        font-size: 0.8rem;
        color: var(--slate-500, #64748b);
        margin-top: 0.375rem;
    }
    
    .file-upload-area {
        border: 2px dashed var(--slate-300, #cbd5e1);
        border-radius: var(--radius-lg, 0.75rem);
        padding: 2rem;
        text-align: center;
        background: var(--slate-50, #f8fafc);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .file-upload-area:hover {
        border-color: var(--warning-500, #f59e0b);
        background: rgba(245, 158, 11, 0.05);
    }
    
    .file-upload-area input[type="file"] {
        display: none;
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
                            <a href="{{ route('organizer.events.index') }}" class="text-decoration-none" style="color: var(--warning-700, #b45309);">Event</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: var(--warning-800, #92400e);">Buat Event Baru</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-2" style="color: var(--warning-900, #78350f);">
                    <i class="fas fa-plus-circle me-3"></i>
                    Buat Event Baru
                </h1>
                <p class="mb-0" style="color: var(--warning-700, #b45309);">
                    Isi formulir di bawah untuk membuat event baru
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="modern-card">
                <div class="card-body p-4">
                    <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Basic Information -->
                        <div class="mb-5">
                            <h5 class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Informasi Dasar
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-8">
                                    <label for="title" class="form-label-modern">
                                        Judul Event <span class="required-star">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-modern @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title') }}" 
                                           placeholder="Masukkan judul event yang menarik"
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="category_id" class="form-label-modern">
                                        Kategori <span class="required-star">*</span>
                                    </label>
                                    <select class="form-select form-select-modern @error('category_id') is-invalid @enderror" 
                                            id="category_id" 
                                            name="category_id" 
                                            required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="short_description" class="form-label-modern">
                                        Deskripsi Singkat
                                    </label>
                                    <textarea class="form-control form-control-modern @error('short_description') is-invalid @enderror" 
                                              id="short_description" 
                                              name="short_description" 
                                              rows="2" 
                                              placeholder="Deskripsi singkat event Anda (maksimal 500 karakter)">{{ old('short_description') }}</textarea>
                                    <div class="form-hint">Deskripsi singkat akan ditampilkan di daftar event</div>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="description" class="form-label-modern">
                                        Deskripsi Lengkap <span class="required-star">*</span>
                                    </label>
                                    <textarea class="form-control form-control-modern @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="6" 
                                              placeholder="Jelaskan detail event Anda secara lengkap..."
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Date and Time -->
                        <div class="mb-5">
                            <h5 class="section-title">
                                <i class="fas fa-calendar-alt"></i>
                                Waktu dan Tanggal
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label-modern">
                                        Tanggal & Waktu Mulai <span class="required-star">*</span>
                                    </label>
                                    <input type="datetime-local" 
                                           class="form-control form-control-modern @error('start_date') is-invalid @enderror" 
                                           id="start_date" 
                                           name="start_date" 
                                           value="{{ old('start_date') }}" 
                                           required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label-modern">
                                        Tanggal & Waktu Selesai <span class="required-star">*</span>
                                    </label>
                                    <input type="datetime-local" 
                                           class="form-control form-control-modern @error('end_date') is-invalid @enderror" 
                                           id="end_date" 
                                           name="end_date" 
                                           value="{{ old('end_date') }}" 
                                           required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location -->
                        <div class="mb-5">
                            <h5 class="section-title">
                                <i class="fas fa-map-marker-alt"></i>
                                Lokasi
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="location" class="form-label-modern">
                                        Lokasi <span class="required-star">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-modern @error('location') is-invalid @enderror" 
                                           id="location" 
                                           name="location" 
                                           value="{{ old('location') }}" 
                                           placeholder="Contoh: Jakarta Convention Center"
                                           required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="venue" class="form-label-modern">
                                        Venue/Ruangan
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-modern @error('venue') is-invalid @enderror" 
                                           id="venue" 
                                           name="venue" 
                                           value="{{ old('venue') }}" 
                                           placeholder="Nama venue atau ruangan">
                                    @error('venue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="address" class="form-label-modern">
                                        Alamat Lengkap
                                    </label>
                                    <textarea class="form-control form-control-modern @error('address') is-invalid @enderror" 
                                              id="address" 
                                              name="address" 
                                              rows="2" 
                                              placeholder="Alamat lengkap lokasi event">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Event Details -->
                        <div class="mb-5">
                            <h5 class="section-title">
                                <i class="fas fa-ticket-alt"></i>
                                Detail Event
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label for="event_type" class="form-label-modern">
                                        Tipe Event <span class="required-star">*</span>
                                    </label>
                                    <select class="form-select form-select-modern @error('event_type') is-invalid @enderror" 
                                            id="event_type" 
                                            name="event_type" 
                                            required>
                                        <option value="">Pilih Tipe</option>
                                        <option value="free" {{ old('event_type') == 'free' ? 'selected' : '' }}>Gratis</option>
                                        <option value="paid" {{ old('event_type') == 'paid' ? 'selected' : '' }}>Berbayar</option>
                                    </select>
                                    @error('event_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4" id="price-field" style="display: {{ old('event_type') == 'paid' ? 'block' : 'none' }};">
                                    <label for="price" class="form-label-modern">
                                        Harga (Rp)
                                    </label>
                                    <input type="number" 
                                           class="form-control form-control-modern @error('price') is-invalid @enderror" 
                                           id="price" 
                                           name="price" 
                                           value="{{ old('price') }}" 
                                           min="0" 
                                           step="1000" 
                                           placeholder="0">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="max_participants" class="form-label-modern">
                                        Maksimal Peserta
                                    </label>
                                    <input type="number" 
                                           class="form-control form-control-modern @error('max_participants') is-invalid @enderror" 
                                           id="max_participants" 
                                           name="max_participants" 
                                           value="{{ old('max_participants') }}" 
                                           min="1" 
                                           placeholder="Tidak terbatas">
                                    <div class="form-hint">Kosongkan jika tidak ada batasan</div>
                                    @error('max_participants')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="image" class="form-label-modern">
                                        Gambar Event
                                    </label>
                                    <label for="image" class="file-upload-area d-block">
                                        <input type="file" 
                                               class="@error('image') is-invalid @enderror" 
                                               id="image" 
                                               name="image" 
                                               accept="image/*">
                                        <i class="fas fa-cloud-upload-alt text-warning fs-2 mb-2"></i>
                                        <div class="fw-semibold">Klik untuk upload gambar</div>
                                        <div class="form-hint">Format: JPG, PNG, GIF, SVG. Maksimal 2MB.</div>
                                    </label>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Information -->
                        <div class="mb-5">
                            <h5 class="section-title">
                                <i class="fas fa-clipboard-list"></i>
                                Informasi Tambahan
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="requirements" class="form-label-modern">
                                        Persyaratan
                                    </label>
                                    <textarea class="form-control form-control-modern @error('requirements') is-invalid @enderror" 
                                              id="requirements" 
                                              name="requirements" 
                                              rows="3" 
                                              placeholder="Satu persyaratan per baris">{{ old('requirements') }}</textarea>
                                    <div class="form-hint">Tulis persyaratan peserta, satu per baris</div>
                                    @error('requirements')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="tags" class="form-label-modern">
                                        Tags
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-modern @error('tags') is-invalid @enderror" 
                                           id="tags" 
                                           name="tags" 
                                           value="{{ old('tags') }}" 
                                           placeholder="workshop, networking, technology">
                                    <div class="form-hint">Pisahkan dengan koma</div>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="contact_info" class="form-label-modern">
                                        Informasi Kontak
                                    </label>
                                    <textarea class="form-control form-control-modern @error('contact_info') is-invalid @enderror" 
                                              id="contact_info" 
                                              name="contact_info" 
                                              rows="2" 
                                              placeholder="Email: info@example.com | Phone: +62-xxx-xxxx-xxxx">{{ old('contact_info') }}</textarea>
                                    @error('contact_info')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between pt-4 border-top">
                            <a href="{{ route('organizer.events.index') }}" class="btn btn-secondary-modern">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary-modern">
                                <i class="fas fa-check-circle me-2"></i>Buat Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('event_type').addEventListener('change', function() {
    const priceField = document.getElementById('price-field');
    if (this.value === 'paid') {
        priceField.style.display = 'block';
    } else {
        priceField.style.display = 'none';
    }
});
</script>
@endpush
@endsection
