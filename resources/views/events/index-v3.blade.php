<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jelajahi Event - TemuEvent</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; background: #f8fafc; }

        /* Navbar */
        .navbar-main {
            background: var(--gradient-1);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-brand i { color: #fbbf24; }
        .nav-link { 
            color: rgba(255,255,255,0.9) !important; 
            font-weight: 500; 
            text-decoration: none; 
            padding: 0.5rem 1rem; 
            transition: 0.3s; 
        }
        .nav-link:hover { color: white !important; }
        .btn-nav { 
            padding: 0.6rem 1.5rem; 
            border-radius: 50px; 
            font-weight: 600; 
            text-decoration: none; 
            transition: 0.3s; 
            border: none;
        }
        .btn-nav-outline { 
            border: 2px solid rgba(255,255,255,0.6); 
            color: white; 
            background: transparent; 
        }
        .btn-nav-outline:hover { background: white; color: var(--primary); }
        .btn-nav-primary { 
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); 
            color: #1e293b; 
        }
        .btn-nav-primary:hover { box-shadow: 0 4px 15px rgba(251, 191, 36, 0.4); color: #1e293b; }

        /* Hero */
        .hero-section {
            background: var(--gradient-1);
            padding: 4rem 0;
            text-align: center;
            color: white;
        }
        .hero-section h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem; }
        .hero-section p { opacity: 0.9; font-size: 1.1rem; max-width: 600px; margin: 0 auto; }

        /* Search */
        .search-section {
            margin-top: -2rem;
            padding: 0 0 2rem;
        }
        .search-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        .search-input {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            width: 100%;
        }
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }
        .btn-search {
            background: var(--gradient-1);
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-search:hover { 
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4); 
            color: white; 
        }

        /* Events */
        .events-section { padding: 2rem 0 4rem; }
        .results-info { margin-bottom: 1.5rem; color: #64748b; }
        .results-info strong { color: #1e293b; }

        .event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }
        .event-image {
            height: 200px;
            position: relative;
            overflow: hidden;
            background: var(--gradient-1);
        }
        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .event-card:hover .event-image img { transform: scale(1.05); }
        .event-placeholder {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .event-placeholder i { font-size: 4rem; color: rgba(255,255,255,0.4); }
        .price-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
        }
        .price-free { background: #10b981; color: white; }
        .price-paid { background: white; color: var(--primary); box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .event-content { padding: 1.5rem; }
        .event-title {
            font-weight: 700;
            font-size: 1.15rem;
            margin-bottom: 0.75rem;
            color: #1e293b;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .event-desc {
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #64748b;
        }
        .meta-item i { color: var(--primary); width: 16px; }
        .event-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #f1f5f9;
        }
        .participants { font-size: 0.85rem; color: #64748b; }
        .participants i { color: var(--primary); }
        .btn-detail {
            background: var(--gradient-1);
            color: white;
            padding: 0.6rem 1.25rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: 0.3s;
        }
        .btn-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 20px;
        }
        .empty-state i { font-size: 4rem; color: #cbd5e1; margin-bottom: 1rem; }

        /* Footer */
        .footer { background: #0f172a; color: #94a3b8; padding: 3rem 0 1.5rem; }
        .footer a { color: #94a3b8; text-decoration: none; }
        .footer a:hover { color: white; }
        .footer-brand { font-size: 1.25rem; font-weight: 800; color: white; }
        .footer-brand i { color: #fbbf24; }

        @media (max-width: 768px) {
            .hero-section h1 { font-size: 1.75rem; }
            .event-image { height: 180px; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-main">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('welcome') }}" class="navbar-brand">
                    <i class="fas fa-calendar-alt"></i> TemuEvent
                </a>
                <div class="d-none d-md-flex align-items-center gap-3">
                    <a href="{{ route('welcome') }}" class="nav-link">Beranda</a>
                </div>
                <div class="d-flex gap-2">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-nav btn-nav-primary">Dashboard</a>
                        @elseif(auth()->user()->isEventOrganizer())
                            <a href="{{ route('organizer.dashboard') }}" class="btn btn-nav btn-nav-primary">Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-nav btn-nav-primary">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-nav btn-nav-outline">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-nav btn-nav-primary">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero-section">
        <div class="container">
            <h1><i class="fas fa-compass me-2"></i>Jelajahi Event</h1>
            <p>Temukan event menarik yang sesuai dengan minat dan passion Anda</p>
        </div>
    </section>

    <!-- Search -->
    <section class="search-section">
        <div class="container">
            <div class="search-card">
                <div class="row align-items-center">
                    <div class="col-lg-9 mb-3 mb-lg-0">
                        <div class="input-group">
                            <input type="text" class="search-input" placeholder="Cari event berdasarkan judul atau lokasi..." id="searchEvent">
                            <button class="btn-search" type="button">
                                <i class="fas fa-search me-2"></i>Cari
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-3 text-lg-end">
                        <span class="results-info">Menampilkan <strong id="eventCount">{{ $events->count() }}</strong> event</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="events-section">
        <div class="container">
            <div class="row g-4" id="eventsGrid">
                @forelse($events as $event)
                <div class="col-lg-4 col-md-6 event-item">
                    <div class="event-card">
                        <div class="event-image">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            @else
                                <div class="event-placeholder">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            @endif
                            @if($event->price == 0)
                                <span class="price-badge price-free"><i class="fas fa-gift me-1"></i>GRATIS</span>
                            @else
                                <span class="price-badge price-paid">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                            @endif
                        </div>
                        <div class="event-content">
                            <h5 class="event-title">{{ $event->title }}</h5>
                            <p class="event-desc">{{ Str::limit($event->description, 100) }}</p>
                            <div class="event-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }} WIB</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ Str::limit($event->location, 30) }}</span>
                                </div>
                            </div>
                            <div class="event-footer">
                                <span class="participants">
                                    <i class="fas fa-users me-1"></i>{{ $event->participants_count ?? 0 }} peserta
                                </span>
                                <a href="{{ route('events.show', $event->id) }}" class="btn-detail">
                                    <i class="fas fa-arrow-right me-1"></i>Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-calendar-times d-block"></i>
                        <h4 class="text-muted mb-2">Belum Ada Event</h4>
                        <p class="text-muted mb-3">Event akan segera tersedia. Silakan cek kembali nanti.</p>
                        <a href="{{ route('welcome') }}" class="btn-detail"><i class="fas fa-home me-2"></i>Kembali ke Beranda</a>
                    </div>
                </div>
                @endforelse
            </div>

            @if(method_exists($events, 'hasPages') && $events->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $events->links() }}
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <span class="footer-brand"><i class="fas fa-calendar-alt me-2"></i>TemuEvent</span>
                    <p class="mb-0 mt-2">Platform event terbaik di Indonesia</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('welcome') }}" class="me-3">Beranda</a>
                    <a href="{{ route('events.index') }}" class="me-3">Event</a>
                    <a href="#">FAQ</a>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1); margin: 1.5rem 0;">
            <div class="text-center">
                <small>&copy; {{ date('Y') }} TemuEvent. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('searchEvent').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const eventItems = document.querySelectorAll('.event-item');
            let visibleCount = 0;
            
            eventItems.forEach(item => {
                const title = item.querySelector('.event-title').textContent.toLowerCase();
                const desc = item.querySelector('.event-desc').textContent.toLowerCase();
                const location = item.querySelector('.meta-item:last-child span').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || desc.includes(searchTerm) || location.includes(searchTerm)) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            document.getElementById('eventCount').textContent = visibleCount;
        });
    </script>
</body>
</html>
