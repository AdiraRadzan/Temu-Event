<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kategori Event - TemuEvent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                <i class="bi bi-calendar-event me-2"></i>TemuEvent
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('categories.index') }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.search') }}">Cari</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.favorites') }}">Favorit</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.my-events') }}">Event Saya</a></li>
                                @if(Auth::user()->role === 'event_organizer')
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('organizer.dashboard') }}">Panel Organizer</a></li>
                                @endif
                                @if(Auth::user()->role === 'admin')
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold text-primary mb-3">
                        <i class="bi bi-grid me-3"></i>Kategori Event
                    </h1>
                    <p class="lead text-muted">Jelajahi berbagai kategori event yang tersedia</p>
                </div>
            </div>
        </div>

        <!-- Categories Grid -->
        @if($categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card h-100 shadow-sm border-0 category-card">
                            <div class="card-body text-center p-4">
                                <div class="category-icon mb-3">
                                    @if($category->name === 'Teknologi')
                                        <i class="bi bi-cpu-fill text-primary" style="font-size: 3rem;"></i>
                                    @elseif($category->name === 'Bisnis')
                                        <i class="bi bi-briefcase-fill text-success" style="font-size: 3rem;"></i>
                                    @elseif($category->name === 'Edukasi')
                                        <i class="bi bi-book-fill text-info" style="font-size: 3rem;"></i>
                                    @elseif($category->name === 'Hiburan')
                                        <i class="bi bi-music-note-beamed text-warning" style="font-size: 3rem;"></i>
                                    @elseif($category->name === 'Kesehatan')
                                        <i class="bi bi-heart-fill text-danger" style="font-size: 3rem;"></i>
                                    @elseif($category->name === 'Olahraga')
                                        <i class="bi bi-trophy-fill text-orange" style="font-size: 3rem;"></i>
                                    @elseif($category->name === 'Kuliner')
                                        <i class="bi bi-cup-hot-fill text-brown" style="font-size: 3rem;"></i>
                                    @elseif($category->name === 'Networking')
                                        <i class="bi bi-people-fill text-purple" style="font-size: 3rem;"></i>
                                    @else
                                        <i class="bi bi-calendar-event text-secondary" style="font-size: 3rem;"></i>
                                    @endif
                                </div>
                                
                                <h4 class="card-title fw-bold mb-2">{{ $category->name }}</h4>
                                
                                @if($category->description)
                                    <p class="card-text text-muted mb-3">{{ $category->description }}</p>
                                @endif
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary rounded-pill">
                                        <i class="bi bi-calendar-event me-1"></i>{{ $category->events_count }} Event
                                    </span>
                                    
                                    <a href="{{ route('events.index') }}?category={{ $category->id }}" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-arrow-right me-1"></i>Lihat Event
                                    </a>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent border-0 text-center pb-4">
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    Terakhir diupdate: {{ $category->updated_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-grid text-muted" style="font-size: 5rem;"></i>
                        <h3 class="mt-3 text-muted">Belum Ada Kategori</h3>
                        <p class="text-muted">Kategori event akan segera ditambahkan.</p>
                        <a href="{{ route('welcome') }}" class="btn btn-primary">
                            <i class="bi bi-house me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistics Section -->
        @if($categories->count() > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card bg-light border-0">
                        <div class="card-body p-4">
                            <h4 class="card-title text-center mb-4">
                                <i class="bi bi-bar-chart me-2"></i>Statistik Kategori
                            </h4>
                            <div class="row text-center">
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="stat-item">
                                        <h2 class="text-primary fw-bold">{{ $categories->count() }}</h2>
                                        <p class="text-muted mb-0">Total Kategori</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="stat-item">
                                        <h2 class="text-success fw-bold">{{ $categories->sum('events_count') }}</h2>
                                        <p class="text-muted mb-0">Total Event</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="stat-item">
                                        <h2 class="text-info fw-bold">{{ round($categories->avg('events_count'), 1) }}</h2>
                                        <p class="text-muted mb-0">Rata-rata per Kategori</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-3">
                                    <div class="stat-item">
                                        <h2 class="text-warning fw-bold">{{ $categories->max('events_count') }}</h2>
                                        <p class="text-muted mb-0">Event Terbanyak</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">
                        <i class="bi bi-calendar-event me-2"></i>TemuEvent
                    </h5>
                    <p class="text-muted">Platform event Indonesia untuk menemukan dan mengikuti berbagai acara menarik.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">Navigasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('welcome') }}" class="text-muted text-decoration-none">Beranda</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-muted text-decoration-none">Event</a></li>
                        <li><a href="{{ route('categories.index') }}" class="text-muted text-decoration-none">Kategori</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">Akun</h6>
                    <ul class="list-unstyled">
                        @auth
                            <li><a href="{{ route('user.dashboard') }}" class="text-muted text-decoration-none">Dashboard</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-muted text-decoration-none p-0">Keluar</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-muted text-decoration-none">Masuk</a></li>
                            <li><a href="{{ route('register') }}" class="text-muted text-decoration-none">Daftar</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted mb-0">&copy; 2025 TemuEvent. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom CSS -->
    <style>
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
        }
        
        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        
        .category-icon {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .stat-item h2 {
            font-size: 2.5rem;
        }
        
        @media (max-width: 768px) {
            .stat-item h2 {
                font-size: 2rem;
            }
        }
    </style>
</body>
</html>