@extends('layouts.app-v2')

@section('title', 'Review Saya - TemuEvent')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb-modern mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Review Saya</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-1">
                    <span class="title-icon" style="background: rgba(245, 158, 11, 0.2);">
                        <i class="fas fa-star"></i>
                    </span>
                    Review Saya
                </h1>
                <p class="page-description mb-0">
                    Ulasan dan rating yang telah Anda berikan
                </p>
            </div>
            <div>
                <span class="badge badge-glass px-3 py-2">
                    <i class="fas fa-star me-1"></i>{{ isset($ratings) ? $ratings->total() : 0 }} Review
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@if(isset($ratings) && $ratings->count() > 0)
    <div class="row g-4">
        @foreach($ratings as $rating)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Event Image -->
                            <div class="col-md-3">
                                @if($rating->event->image)
                                    <img src="{{ Storage::url($rating->event->image) }}" alt="{{ $rating->event->title }}" 
                                         class="img-fluid rounded-3" style="width: 100%; height: 160px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded-3" style="height: 160px;">
                                        <i class="fas fa-calendar-alt text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Rating Content -->
                            <div class="col-md-9">
                                <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-3">
                                    <div>
                                        <h5 class="fw-semibold mb-2">{{ $rating->event->title }}</h5>
                                        <div class="d-flex flex-wrap gap-3 text-muted small">
                                            <span><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($rating->event->start_date)->format('d M Y') }}</span>
                                            <span><i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($rating->event->location, 30) }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end">
                                        <!-- Star Rating -->
                                        <div class="d-flex gap-1 mb-2 justify-content-end">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 1.1rem;"></i>
                                            @endfor
                                        </div>
                                        
                                        <!-- Status Badge -->
                                        @if($rating->is_approved)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle me-1"></i>Diverifikasi
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock me-1"></i>Menunggu Verifikasi
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Review Text -->
                                @if($rating->review)
                                    <div class="bg-light rounded-3 p-3 mb-3">
                                        <p class="mb-0">{{ $rating->review }}</p>
                                    </div>
                                @endif
                                
                                <!-- Sub Ratings -->
                                @if($rating->content_rating || $rating->management_rating)
                                    <div class="row g-3 mb-3">
                                        @if($rating->content_rating)
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="text-muted small">Konten:</span>
                                                    <div class="d-flex gap-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $rating->content_rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.75rem;"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($rating->management_rating)
                                            <div class="col-sm-6">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="text-muted small">Manajemen:</span>
                                                    <div class="d-flex gap-1">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $rating->management_rating ? 'text-warning' : 'text-muted' }}" style="font-size: 0.75rem;"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                
                                <!-- Footer -->
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 pt-3 border-top">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        Diberikan: {{ \Carbon\Carbon::parse($rating->created_at)->format('d M Y, H:i') }}
                                    </small>
                                    
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('events.show', $rating->event) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Lihat Event
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $ratings->links() }}
    </div>
@else
    <div class="card">
        <div class="card-body">
            <div class="empty-state py-5">
                <div class="empty-state-icon" style="background: rgba(245, 158, 11, 0.1);">
                    <i class="fas fa-star text-warning"></i>
                </div>
                <h5 class="text-muted">Belum Ada Review</h5>
                <p class="text-muted mb-4">
                    Anda belum memberikan review untuk event apapun.<br>
                    Berikan review setelah mengikuti event untuk membantu penyelenggara dan peserta lain.
                </p>
                <a href="{{ route('user.my-events') }}" class="btn btn-primary">
                    <i class="fas fa-ticket-alt me-2"></i>Lihat Tiket Saya
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
