@extends('layouts.app-v2')

@section('title', 'Event Favorit - TemuEvent')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb-modern mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Event Favorit</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-1">
                    <span class="title-icon" style="background: rgba(244, 63, 94, 0.2);">
                        <i class="fas fa-heart"></i>
                    </span>
                    Event Favorit
                </h1>
                <p class="page-description mb-0">
                    Event yang telah Anda simpan ke daftar favorit
                </p>
            </div>
            <div>
                <span class="badge badge-glass px-3 py-2">
                    <i class="fas fa-heart me-1"></i>{{ isset($favorites) ? $favorites->total() : 0 }} Event
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
@if(isset($favorites) && $favorites->count() > 0)
    <div class="row g-4">
        @foreach($favorites as $favorite)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 position-relative">
                    <!-- Favorite Button -->
                    <div class="position-absolute top-0 end-0 m-3" style="z-index: 10;">
                        <form action="{{ route('user.events.favorite', $favorite->event) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger rounded-circle shadow" title="Hapus dari favorit">
                                <i class="fas fa-heart"></i>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Event Image -->
                    @if($favorite->event->image)
                        <img src="{{ Storage::url($favorite->event->image) }}" alt="{{ $favorite->event->title }}" 
                             class="card-img-top" style="height: 180px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                            <i class="fas fa-calendar-alt text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <!-- Badges -->
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge badge-secondary">{{ $favorite->event->category->name ?? 'Event' }}</span>
                            @if($favorite->event->is_featured)
                                <span class="badge badge-warning"><i class="fas fa-star me-1"></i>Featured</span>
                            @endif
                        </div>
                        
                        <!-- Title -->
                        <h6 class="card-title fw-semibold mb-2">{{ Str::limit($favorite->event->title, 60) }}</h6>
                        
                        <!-- Description -->
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit($favorite->event->short_description ?? $favorite->event->description, 80) }}
                        </p>
                        
                        <!-- Event Info -->
                        <div class="text-muted small mb-3">
                            <div class="mb-1">
                                <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($favorite->event->start_date)->format('d M Y, H:i') }}
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt me-2"></i>{{ Str::limit($favorite->event->location, 25) }}
                            </div>
                        </div>
                        
                        <!-- Price -->
                        <div class="mb-3">
                            @if($favorite->event->price > 0)
                                <span class="text-primary fw-bold">Rp {{ number_format($favorite->event->price, 0, ',', '.') }}</span>
                            @else
                                <span class="badge badge-success">Gratis</span>
                            @endif
                        </div>
                        
                        <!-- Actions -->
                        <div class="d-flex gap-2 mt-auto">
                            <a href="{{ route('events.show', $favorite->event) }}" class="btn btn-primary btn-sm flex-grow-1">
                                <i class="fas fa-eye me-1"></i>Lihat Detail
                            </a>
                            
                            @php
                                $isRegistered = \App\Models\EventParticipant::where('event_id', $favorite->event->id)
                                    ->where('user_id', Auth::id())
                                    ->exists();
                            @endphp
                            
                            @if(!$isRegistered)
                                <form action="{{ route('user.events.register', $favorite->event) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-ticket-alt me-1"></i>Daftar
                                    </button>
                                </form>
                            @else
                                <span class="badge badge-success align-self-center px-3"><i class="fas fa-check me-1"></i>Terdaftar</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="card-footer bg-transparent">
                        <small class="text-muted">
                            <i class="fas fa-heart me-1 text-danger"></i>
                            Favorit sejak {{ \Carbon\Carbon::parse($favorite->created_at)->format('d M Y') }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $favorites->links() }}
    </div>
@else
    <div class="card">
        <div class="card-body">
            <div class="empty-state py-5">
                <div class="empty-state-icon" style="background: rgba(244, 63, 94, 0.1);">
                    <i class="fas fa-heart text-danger"></i>
                </div>
                <h5 class="text-muted">Belum Ada Event Favorit</h5>
                <p class="text-muted mb-4">
                    Anda belum menyimpan event apapun ke favorit.<br>
                    Klik tombol hati di event yang Anda sukai untuk menyimpannya.
                </p>
                <a href="{{ route('events.index') }}" class="btn btn-primary">
                    <i class="fas fa-compass me-2"></i>Jelajahi Event
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
