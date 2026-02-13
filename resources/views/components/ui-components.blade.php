<!-- Modern Stats Card Component -->
<div class="stats-card">
    <div class="stats-card-content">
        <div class="stats-icon" style="background: {{ $color ?? 'linear-gradient(135deg, var(--primary-600), var(--primary-400))' }};">
            <i class="{{ $icon ?? 'fas fa-chart-bar' }}"></i>
        </div>
        <div class="stats-info">
            <h3>{{ $value ?? '0' }}</h3>
            <p>{{ $label ?? 'Statistic' }}</p>
            @if(isset($trend))
                <small class="text-{{ $trendColor ?? 'success' }}">
                    <i class="fas fa-arrow-{{ $trendDirection ?? 'up' }} me-1"></i>
                    {{ $trend }}
                </small>
            @endif
        </div>
    </div>
</div>

<!-- Modern Event Card Component -->
<div class="event-card">
    <div class="event-card-image">
        @if(isset($event) && $event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
        @else
            <div class="event-card-placeholder">
                <i class="fas fa-calendar-alt"></i>
            </div>
        @endif
        @if(isset($featured) && $featured)
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-warning text-dark">
                    <i class="fas fa-star me-1"></i>Unggulan
                </span>
            </div>
        @endif
    </div>
    
    <div class="event-card-content">
        <h5 class="event-card-title">{{ $title ?? ($event->title ?? 'Event Title') }}</h5>
        
        @if(isset($description) || (isset($event) && $event->description))
            <p class="event-card-description">
                {{ $description ?? Str::limit($event->description, 100) }}
            </p>
        @endif
        
        <div class="event-card-meta">
            <div class="event-meta-item">
                <i class="fas fa-calendar"></i>
                <span>{{ $date ?? ($event->event_date ?? 'Tanggal') }}</span>
            </div>
            <div class="event-meta-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $location ?? ($event->location ?? 'Lokasi') }}</span>
            </div>
        </div>
        
        @if(isset($price))
            <div class="mb-3">
                <span class="h5 text-primary mb-0">{{ $price }}</span>
                @if(isset($originalPrice))
                    <small class="text-muted text-decoration-line-through ms-2">{{ $originalPrice }}</small>
                @endif
            </div>
        @endif
        
        @if(isset($slots))
            <div class="mb-3">
                <small class="text-muted">
                    <i class="fas fa-users me-1"></i>
                    {{ $slots }} slot tersedia
                </small>
            </div>
        @endif
        
        <div class="d-grid">
            {{ $slot ?? '' }}
        </div>
    </div>
</div>

<!-- Modern Form Card Component -->
<div class="card border-0 shadow-lg">
    @if(isset($header))
        <div class="card-header bg-transparent border-0 pb-0">
            <h4 class="card-title mb-0">{{ $header }}</h4>
            @if(isset($subheader))
                <p class="text-muted mb-0 mt-2">{{ $subheader }}</p>
            @endif
        </div>
    @endif
    
    <div class="card-body {{ !isset($header) ? 'pt-4' : '' }}">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
        <div class="card-footer bg-transparent border-0 pt-0">
            {{ $footer }}
        </div>
    @endif
</div>

<!-- Modern Button Component -->
@php
    $buttonClass = 'btn ';
    switch($variant ?? 'primary') {
        case 'primary':
            $buttonClass .= 'btn-primary';
            break;
        case 'secondary':
            $buttonClass .= 'btn-outline-primary';
            break;
        case 'success':
            $buttonClass .= 'btn-success';
            break;
        case 'danger':
            $buttonClass .= 'btn-danger';
            break;
        case 'warning':
            $buttonClass .= 'btn-warning text-dark';
            break;
        case 'info':
            $buttonClass .= 'btn-info';
            break;
        case 'light':
            $buttonClass .= 'btn-light';
            break;
        case 'dark':
            $buttonClass .= 'btn-dark';
            break;
        default:
            $buttonClass .= 'btn-primary';
    }
    
    if(isset($size)) {
        switch($size) {
            case 'sm':
                $buttonClass .= ' btn-sm';
                break;
            case 'lg':
                $buttonClass .= ' btn-lg';
                break;
        }
    }
    
    if(isset($block) && $block) {
        $buttonClass .= ' w-100';
    }
@endphp

@if(isset($href))
    <a href="{{ $href }}" class="{{ $buttonClass }}" {{ $attributes ?? '' }}>
        @if(isset($icon))
            <i class="{{ $icon }} me-2"></i>
        @endif
        {{ $text ?? $slot }}
    </a>
@else
    <button type="{{ $type ?? 'button' }}" class="{{ $buttonClass }}" {{ $attributes ?? '' }}>
        @if(isset($icon))
            <i class="{{ $icon }} me-2"></i>
        @endif
        {{ $text ?? $slot }}
    </button>
@endif

<!-- Alert Component -->
@if(isset($message))
    <div class="alert alert-{{ $type ?? 'info' }} alert-dismissible fade show d-flex align-items-center" role="alert">
        @if(isset($icon))
            <i class="{{ $icon }} me-2"></i>
        @else
            <i class="fas fa-info-circle me-2"></i>
        @endif
        <div>{{ $message }}</div>
        @if(isset($dismissible) && $dismissible)
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        @endif
    </div>
@endif

<!-- Badge Component -->
@php
    $badgeClass = 'badge ';
    switch($type ?? 'primary') {
        case 'primary':
            $badgeClass .= 'bg-primary';
            break;
        case 'secondary':
            $badgeClass .= 'bg-secondary';
            break;
        case 'success':
            $badgeClass .= 'bg-success';
            break;
        case 'danger':
            $badgeClass .= 'bg-danger';
            break;
        case 'warning':
            $badgeClass .= 'bg-warning text-dark';
            break;
        case 'info':
            $badgeClass .= 'bg-info';
            break;
        case 'light':
            $badgeClass .= 'bg-light text-dark';
            break;
        case 'dark':
            $badgeClass .= 'bg-dark';
            break;
        default:
            $badgeClass .= 'bg-primary';
    }
    
    if(isset($rounded) && $rounded) {
        $badgeClass .= ' rounded-pill';
    }
@endphp

<span class="{{ $badgeClass }}" {{ $attributes ?? '' }}>
    @if(isset($icon))
        <i class="{{ $icon }} me-1"></i>
    @endif
    {{ $text ?? $slot }}
</span>

<!-- Loading Spinner Component -->
<div class="d-flex justify-content-center align-items-center {{ $containerClass ?? '' }}">
    <div class="spinner-border text-primary" role="status" {{ $attributes ?? '' }}>
        <span class="visually-hidden">Loading...</span>
    </div>
    @if(isset($text))
        <span class="ms-3">{{ $text }}</span>
    @endif
</div>

<!-- Empty State Component -->
<div class="text-center py-5">
    <div class="mb-4">
        @if(isset($icon))
            <i class="{{ $icon }} text-muted" style="font-size: 4rem;"></i>
        @else
            <i class="fas fa-inbox text-muted" style="font-size: 4rem;"></i>
        @endif
    </div>
    <h4 class="text-muted mb-3">{{ $title ?? 'Tidak ada data' }}</h4>
    <p class="text-muted mb-4">{{ $description ?? 'Belum ada item untuk ditampilkan.' }}</p>
    @if(isset($action))
        {{ $action }}
    @endif
</div>

<!-- Progress Bar Component -->
@php
    $progressClass = 'progress ';
    if(isset($size)) {
        switch($size) {
            case 'sm':
                $progressClass .= 'progress-sm';
                break;
            case 'lg':
                $progressClass .= 'progress-lg';
                break;
        }
    }
@endphp

<div class="{{ $progressClass }}" style="height: {{ $height ?? '8px' }};">
    <div class="progress-bar {{ $variant ?? 'bg-primary' }}" 
         role="progressbar" 
         style="width: {{ $value ?? 0 }}%" 
         aria-valuenow="{{ $value ?? 0 }}" 
         aria-valuemin="0" 
         aria-valuemax="100">
        @if(isset($showValue) && $showValue)
            {{ $value ?? 0 }}%
        @endif
    </div>
</div>