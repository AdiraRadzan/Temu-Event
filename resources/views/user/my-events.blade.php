@extends('layouts.app-v2')

@section('title', 'Tiket Saya - TemuEvent')

@section('page-header')
<div class="page-header">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb-modern mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active">Tiket Saya</li>
                    </ol>
                </nav>
                <h1 class="page-title mb-1">
                    <span class="title-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </span>
                    Tiket Saya
                </h1>
                <p class="page-description mb-0">
                    Daftar event yang telah Anda daftarkan
                </p>
            </div>
            <div>
                <a href="{{ route('events.index') }}" class="btn btn-light">
                    <i class="fas fa-compass me-2"></i>Jelajahi Event
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card primary">
            <div class="stat-card-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-card-value">{{ $stats['total_events'] ?? 0 }}</div>
            <div class="stat-card-label">Total Event</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card success">
            <div class="stat-card-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-card-value">{{ $stats['upcoming_events'] ?? 0 }}</div>
            <div class="stat-card-label">Event Mendatang</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card info">
            <div class="stat-card-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-card-value">{{ $stats['completed_events'] ?? 0 }}</div>
            <div class="stat-card-label">Event Selesai</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card danger">
            <div class="stat-card-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-card-value">{{ $stats['favorites'] ?? 0 }}</div>
            <div class="stat-card-label">Event Favorit</div>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card mb-4">
    <div class="card-body py-2">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button">
                    <i class="fas fa-list me-1"></i>Semua Event
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="upcoming-tab" data-bs-toggle="pill" data-bs-target="#upcoming" type="button">
                    <i class="fas fa-clock me-1"></i>Event Mendatang
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="completed-tab" data-bs-toggle="pill" data-bs-target="#completed" type="button">
                    <i class="fas fa-check me-1"></i>Event Selesai
                </button>
            </li>
        </ul>
    </div>
</div>

<!-- Events Content -->
<div class="tab-content">
    <!-- All Events Tab -->
    <div class="tab-pane fade show active" id="all">
        @if(isset($myEvents) && $myEvents->count() > 0)
            <div class="row g-4">
                @foreach($myEvents as $participation)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            @if($participation->event->image)
                                <img src="{{ Storage::url($participation->event->image) }}" alt="{{ $participation->event->title }}" 
                                     class="card-img-top" style="height: 160px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 160px;">
                                    <i class="fas fa-calendar-alt text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <div class="d-flex gap-2 mb-2">
                                    <span class="badge badge-secondary">{{ $participation->event->category->name ?? 'Event' }}</span>
                                    @if($participation->status === 'confirmed')
                                        <span class="badge badge-success"><i class="fas fa-check me-1"></i>Terdaftar</span>
                                    @elseif($participation->status === 'cancelled')
                                        <span class="badge badge-danger"><i class="fas fa-times me-1"></i>Dibatalkan</span>
                                    @else
                                        <span class="badge badge-warning"><i class="fas fa-clock me-1"></i>Pending</span>
                                    @endif
                                </div>
                                
                                <h6 class="card-title fw-semibold mb-2">{{ Str::limit($participation->event->title, 50) }}</h6>
                                
                                <div class="text-muted small mb-3">
                                    <div class="mb-1">
                                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($participation->event->start_date)->format('d M Y, H:i') }}
                                    </div>
                                    <div>
                                        <i class="fas fa-map-marker-alt me-2"></i>{{ Str::limit($participation->event->location, 30) }}
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="{{ route('events.show', $participation->event) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    
                                    @if($participation->status === 'confirmed' && \Carbon\Carbon::parse($participation->event->start_date) > now())
                                        <form action="{{ route('user.events.cancel', $participation->event) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Yakin ingin membatalkan pendaftaran?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $myEvents->links() }}
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="empty-state py-5">
                        <div class="empty-state-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h5 class="text-muted">Belum Ada Event</h5>
                        <p class="text-muted mb-4">Anda belum mendaftar event apapun.</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary">
                            <i class="fas fa-compass me-2"></i>Jelajahi Event
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Upcoming Events Tab -->
    <div class="tab-pane fade" id="upcoming">
        @php
            $upcomingEvents = isset($myEvents) ? $myEvents->filter(function($participation) {
                return \Carbon\Carbon::parse($participation->event->start_date) >= now() && $participation->status === 'confirmed';
            }) : collect([]);
        @endphp
        
        @if($upcomingEvents->count() > 0)
            <div class="row g-4">
                @foreach($upcomingEvents as $participation)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-success">
                            <div class="card-header bg-success text-white py-2">
                                <small><i class="fas fa-clock me-1"></i>Event Mendatang</small>
                            </div>
                            
                            @if($participation->event->image)
                                <img src="{{ Storage::url($participation->event->image) }}" alt="{{ $participation->event->title }}" 
                                     class="card-img-top" style="height: 140px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 140px;">
                                    <i class="fas fa-calendar-alt text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h6 class="card-title fw-semibold mb-2">{{ Str::limit($participation->event->title, 50) }}</h6>
                                
                                <div class="text-muted small mb-3">
                                    <div class="mb-1">
                                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($participation->event->start_date)->format('d M Y, H:i') }} WIB
                                    </div>
                                    <div>
                                        <i class="fas fa-map-marker-alt me-2"></i>{{ Str::limit($participation->event->location, 30) }}
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="{{ route('events.show', $participation->event) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    <form action="{{ route('user.events.cancel', $participation->event) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Yakin ingin membatalkan pendaftaran?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="empty-state py-5">
                        <div class="empty-state-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h5 class="text-muted">Tidak Ada Event Mendatang</h5>
                        <p class="text-muted mb-4">Anda tidak memiliki event yang dikonfirmasi untuk tanggal mendatang.</p>
                        <a href="{{ route('events.index') }}" class="btn btn-primary">
                            <i class="fas fa-compass me-2"></i>Cari Event
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
    <!-- Completed Events Tab -->
    <div class="tab-pane fade" id="completed">
        @php
            $completedEvents = isset($myEvents) ? $myEvents->filter(function($participation) {
                return \Carbon\Carbon::parse($participation->event->end_date) < now();
            }) : collect([]);
        @endphp
        
        @if($completedEvents->count() > 0)
            <div class="row g-4">
                @foreach($completedEvents as $participation)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <div class="card-header bg-light py-2">
                                <small class="text-muted"><i class="fas fa-check-circle me-1"></i>Event Selesai</small>
                            </div>
                            
                            @if($participation->event->image)
                                <img src="{{ Storage::url($participation->event->image) }}" alt="{{ $participation->event->title }}" 
                                     class="card-img-top" style="height: 140px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 140px;">
                                    <i class="fas fa-calendar-alt text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h6 class="card-title fw-semibold mb-2">{{ Str::limit($participation->event->title, 50) }}</h6>
                                
                                <div class="text-muted small mb-3">
                                    <div class="mb-1">
                                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($participation->event->start_date)->format('d M Y') }}
                                    </div>
                                    <div>
                                        <i class="fas fa-map-marker-alt me-2"></i>{{ Str::limit($participation->event->location, 30) }}
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2">
                                    <a href="{{ route('events.show', $participation->event) }}" class="btn btn-sm btn-outline-primary flex-grow-1">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                    
                                    @php
                                        $hasRating = \App\Models\EventRating::where('event_id', $participation->event->id)
                                            ->where('user_id', Auth::id())
                                            ->exists();
                                    @endphp
                                    
                                    @if(!$hasRating)
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ratingModal{{ $participation->event->id }}">
                                            <i class="fas fa-star me-1"></i>Review
                                        </button>
                                    @else
                                        <span class="badge badge-success align-self-center"><i class="fas fa-check me-1"></i>Reviewed</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="empty-state py-5">
                        <div class="empty-state-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <h5 class="text-muted">Belum Ada Event Selesai</h5>
                        <p class="text-muted mb-0">Event yang Anda ikuti belum ada yang selesai.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
