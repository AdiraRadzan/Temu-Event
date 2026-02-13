@extends('layouts.app-v2')

@section('title', 'Pencarian Event')

@section('content')
<div class="container py-4">
    <!-- Search Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-3">Pencarian Event</h1>
            
            <!-- Search Form -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('user.search') }}" class="row g-3">
                        <div class="col-md-6">
                            <label for="q" class="form-label">Kata Kunci</label>
                            <input type="text" class="form-control" id="q" name="q" 
                                   value="{{ request('q') }}" 
                                   placeholder="Cari event berdasarkan judul, deskripsi, atau lokasi...">
                        </div>
                        
                        <div class="col-md-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="sort" class="form-label">Urutkan</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Tanggal (Terdekat)</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga (Terendah)</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga (Tertinggi)</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i>Cari Event
                            </button>
                            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Results -->
    @if(request('q') || request('category'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">
                            @if($events->total() > 0)
                                Ditemukan {{ $events->total() }} event
                            @else
                                Tidak ada event yang ditemukan
                            @endif
                        </h5>
                        @if(request('q'))
                            <small class="text-muted">untuk "<strong>{{ request('q') }}</strong>"</small>
                        @endif
                        @if(request('category'))
                            @php
                                $selectedCategory = $categories->firstWhere('id', request('category'));
                            @endphp
                            @if($selectedCategory)
                                <small class="text-muted"> dalam kategori <strong>{{ $selectedCategory->name }}</strong></small>
                            @endif
                        @endif
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <small class="text-muted me-3">Tampilan:</small>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-secondary active" id="gridView">
                                <i class="bi bi-grid"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="listView">
                                <i class="bi bi-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        @if($events->count() > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="mb-2">Filter Tambahan:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ request()->url() }}?{{ http_build_query(array_merge(request()->query(), ['date' => 'today'])) }}" 
                                   class="btn btn-sm {{ request('date') == 'today' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Hari Ini
                                </a>
                                <a href="{{ request()->url() }}?{{ http_build_query(array_merge(request()->query(), ['date' => 'week'])) }}" 
                                   class="btn btn-sm {{ request('date') == 'week' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Minggu Ini
                                </a>
                                <a href="{{ request()->url() }}?{{ http_build_query(array_merge(request()->query(), ['date' => 'month'])) }}" 
                                   class="btn btn-sm {{ request('date') == 'month' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Bulan Ini
                                </a>
                                <a href="{{ request()->url() }}?{{ http_build_query(array_merge(request()->query(), ['type' => 'free'])) }}" 
                                   class="btn btn-sm {{ request('type') == 'free' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Event Gratis
                                </a>
                                <a href="{{ request()->url() }}?{{ http_build_query(array_merge(request()->query(), ['type' => 'paid'])) }}" 
                                   class="btn btn-sm {{ request('type') == 'paid' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Event Berbayar
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            @if(request()->hasAny(['q', 'category', 'date', 'type']))
                                <a href="{{ request()->url() }}" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-x-circle me-1"></i>Hapus Filter
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Events Grid/List -->
        @if($events->count() > 0)
            <div class="row" id="eventsContainer">
                @foreach($events as $event)
                    <div class="col-md-6 col-lg-4 mb-4 event-card" data-view="grid">
                        <div class="card h-100 shadow-sm event-card-hover">
                            <!-- Event Image -->
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" 
                                     class="card-img-top" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <!-- Event Title -->
                                <h5 class="card-title">{{ Str::limit($event->title, 60) }}</h5>
                                
                                <!-- Event Meta -->
                                <div class="mb-2">
                                    <span class="badge bg-secondary me-2">{{ $event->category->name }}</span>
                                    @if($event->is_featured)
                                        <span class="badge bg-warning">
                                            <i class="bi bi-star-fill me-1"></i>Featured
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Event Description -->
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($event->short_description ?? $event->description, 100) }}
                                </p>
                                
                                <!-- Event Info -->
                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted small mb-1">
                                        <i class="bi bi-calendar-event me-2"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                    </div>
                                    <div class="d-flex align-items-center text-muted small mb-1">
                                        <i class="bi bi-clock me-2"></i>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} WIB
                                    </div>
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="bi bi-geo-alt me-2"></i>
                                        {{ Str::limit($event->location, 30) }}
                                    </div>
                                </div>
                                
                                <!-- Price and Action -->
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <div>
                                        @if($event->price > 0)
                                            <span class="text-primary fw-bold">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-success fw-bold">Gratis</span>
                                        @endif
                                    </div>
                                    <a href="{{ route('events.show', $event) }}" class="btn btn-primary btn-sm">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    {{ $events->links() }}
                </div>
            </div>
        @else
            <!-- No Results -->
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 text-muted">Event Tidak Ditemukan</h4>
                    <p class="text-muted mb-4">
                        Tidak ada event yang sesuai dengan pencarian Anda. 
                        Coba gunakan kata kunci yang berbeda atau ubah filter.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('welcome') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                        </a>
                        <a href="{{ request()->url() }}?q=&category=" class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise me-1"></i>Reset Pencarian
                        </a>
                    </div>
                    
                    <!-- Suggestions -->
                    <div class="mt-4">
                        <h6 class="text-muted mb-2">Saran Pencarian:</h6>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ route('user.search') }}?q=workshop" class="btn btn-sm btn-outline-secondary">workshop</a>
                            <a href="{{ route('user.search') }}?q=teknologi" class="btn btn-sm btn-outline-secondary">teknologi</a>
                            <a href="{{ route('user.search') }}?q=bisnis" class="btn btn-sm btn-outline-secondary">bisnis</a>
                            <a href="{{ route('user.search') }}?q=networking" class="btn btn-sm btn-outline-secondary">networking</a>
                            <a href="{{ route('user.search') }}?type=free" class="btn btn-sm btn-outline-secondary">event gratis</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        <!-- No Search Query -->
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3 text-muted">Mulai Pencarian Event</h4>
                <p class="text-muted mb-4">
                    Gunakan form pencarian di atas untuk menemukan event yang Anda cari.
                </p>
                
                <!-- Popular Searches -->
                <div class="mt-4">
                    <h6 class="text-muted mb-2">Pencarian Populer:</h6>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('user.search') }}?q=workshop" class="btn btn-sm btn-outline-primary">workshop</a>
                        <a href="{{ route('user.search') }}?q=teknologi" class="btn btn-sm btn-outline-primary">teknologi</a>
                        <a href="{{ route('user.search') }}?q=bisnis" class="btn btn-sm btn-outline-primary">bisnis</a>
                        <a href="{{ route('user.search') }}?q=networking" class="btn btn-sm btn-outline-primary">networking</a>
                        <a href="{{ route('user.search') }}?type=free" class="btn btn-sm btn-outline-primary">event gratis</a>
                    </div>
                </div>
                
                <!-- Categories -->
                <div class="mt-4">
                    <h6 class="text-muted mb-2">Jelajahi Kategori:</h6>
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        @foreach($categories->take(8) as $category)
                            <a href="{{ route('user.search') }}?category={{ $category->id }}" class="btn btn-sm btn-outline-secondary">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.event-card-hover {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.event-card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

#eventsContainer.list-view .event-card {
    width: 100%;
}

#eventsContainer.list-view .card {
    flex-direction: row;
}

#eventsContainer.list-view .card-img-top {
    width: 200px;
    height: auto;
    object-fit: cover;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View toggle functionality
    const gridViewBtn = document.getElementById('gridView');
    const listViewBtn = document.getElementById('listView');
    const eventsContainer = document.getElementById('eventsContainer');
    
    if (gridViewBtn && listViewBtn && eventsContainer) {
        gridViewBtn.addEventListener('click', function() {
            eventsContainer.className = 'row';
            gridViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
        });
        
        listViewBtn.addEventListener('click', function() {
            eventsContainer.className = 'row list-view';
            listViewBtn.classList.add('active');
            gridViewBtn.classList.remove('active');
        });
    }
});
</script>
@endsection