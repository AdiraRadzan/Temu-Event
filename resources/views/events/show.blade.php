<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $event->title }} - TemuEvent</title>
    
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; overflow-x: hidden; }

        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        .navbar-main {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-brand i { color: #fbbf24; }
        .nav-link { color: #475569 !important; font-weight: 500; text-decoration: none; padding: 0.5rem 1rem; transition: 0.3s; }
        .nav-link:hover { color: var(--primary) !important; }
        .btn-nav { padding: 0.75rem 1.75rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: 0.3s; border: none; }
        .btn-nav-outline { border: 2px solid var(--primary); color: var(--primary); background: transparent; }
        .btn-nav-outline:hover { background: var(--primary); color: white; }
        .btn-nav-primary { background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: #1e293b; }
        .btn-nav-primary:hover { box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5); color: #1e293b; }

        .hero-event {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #5b86e5);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            padding: 8rem 0 5rem;
            margin-top: 0;
        }
        .breadcrumb-custom { background: transparent; padding: 0; margin-bottom: 1.5rem; }
        .breadcrumb-custom a { color: rgba(255,255,255,0.8); text-decoration: none; }
        .breadcrumb-custom a:hover { color: white; }
        .breadcrumb-custom .active { color: rgba(255,255,255,0.6); }
        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
        
        .event-title-main { font-size: 2.5rem; font-weight: 800; color: white; margin-bottom: 1rem; }
        .event-meta-hero { display: flex; flex-wrap: wrap; gap: 1rem; }
        .meta-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: white;
            font-size: 0.9rem;
        }

        .content-section { margin-top: -3rem; padding-bottom: 4rem; }
        
        .card-custom {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: none;
            overflow: hidden;
        }
        
        .event-image-main {
            height: 350px;
            background: var(--gradient-1);
            position: relative;
        }
        .event-image-main img { width: 100%; height: 100%; object-fit: cover; }
        .event-image-placeholder { height: 100%; display: flex; align-items: center; justify-content: center; }
        .event-image-placeholder i { font-size: 5rem; color: rgba(255,255,255,0.4); }
        
        .price-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .price-free { color: #10b981; }
        .price-paid { color: var(--primary); }
        
        .section-title { font-weight: 700; font-size: 1.25rem; margin-bottom: 1rem; color: #1e293b; }
        .section-content { color: #64748b; line-height: 1.8; }
        
        .info-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: none;
            position: sticky;
            top: 100px;
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .info-item:last-child { border-bottom: none; }
        .info-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }
        .info-label { font-size: 0.85rem; color: #64748b; }
        .info-value { font-weight: 600; color: #1e293b; }
        
        .progress-custom { height: 8px; border-radius: 10px; background: #e2e8f0; }
        .progress-custom .progress-bar { background: var(--gradient-1); border-radius: 10px; }
        
        .btn-register {
            background: var(--gradient-1);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4); color: white; }
        
        .btn-registered {
            background: #10b981;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
        }
        
        .btn-favorite {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem;
            background: white;
            color: #64748b;
            transition: all 0.3s;
        }
        .btn-favorite:hover { border-color: #ef4444; color: #ef4444; }
        .btn-favorite.active { background: #fef2f2; border-color: #ef4444; color: #ef4444; }
        
        .rating-card { background: #f8fafc; border-radius: 16px; padding: 1.5rem; margin-bottom: 1rem; }
        .rating-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem; }
        .rating-user { font-weight: 600; color: #1e293b; }
        .rating-date { font-size: 0.85rem; color: #94a3b8; }
        .rating-stars { color: #fbbf24; margin-bottom: 0.5rem; }
        .rating-comment { color: #64748b; margin: 0; }
        
        .rating-summary {
            background: var(--gradient-1);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }
        .rating-number { font-size: 3.5rem; font-weight: 800; }
        .rating-stars-summary { font-size: 1.5rem; margin: 0.5rem 0; }
        .rating-count { opacity: 0.9; }
        
        .alert-login {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            border: none;
            border-radius: 12px;
            color: #1e293b;
        }
        .alert-login a { color: var(--primary); font-weight: 600; }

        .footer { background: #0f172a; color: #94a3b8; padding: 5rem 0 2rem; }
        .footer a { color: #94a3b8; text-decoration: none; transition: 0.3s; }
        .footer a:hover { color: white; }
        .footer h5 { color: white; font-weight: 700; margin-bottom: 1.5rem; }
        .footer-brand { font-size: 1.5rem; font-weight: 800; color: white; margin-bottom: 1rem; }
        .footer-brand i { color: #fbbf24; }
        .social-link {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }
        .social-link:hover { background: var(--primary); color: white; }

        .modal-content { border: none; border-radius: 24px; overflow: hidden; }
        .modal-body { padding: 0; }
        .auth-modal-left {
            background: var(--gradient-1);
            padding: 50px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .auth-modal-left h3 { font-weight: 700; margin-bottom: 15px; }
        .auth-modal-left p { opacity: 0.9; font-size: 14px; }
        .auth-modal-right { padding: 50px; }
        .auth-modal-right h4 { font-weight: 700; margin-bottom: 8px; }
        .auth-modal-right .subtitle { color: #666; margin-bottom: 25px; font-size: 14px; }
        .form-control-auth { border-radius: 12px; padding: 14px 18px; border: 2px solid #e9ecef; }
        .form-control-auth:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); }
        .btn-auth { background: var(--gradient-1); border: none; border-radius: 12px; padding: 15px; font-weight: 600; color: white; width: 100%; }
        .btn-auth:hover { box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4); color: white; }
        .auth-link { color: var(--primary); font-weight: 600; cursor: pointer; }
        .role-option { border: 2px solid #e9ecef; border-radius: 16px; padding: 20px 15px; cursor: pointer; transition: 0.3s; text-align: center; }
        .role-option:hover { border-color: var(--primary); background: rgba(99, 102, 241, 0.05); }
        .role-option.selected { border-color: var(--primary); background: rgba(99, 102, 241, 0.1); }
        .role-option i { font-size: 28px; color: var(--primary); margin-bottom: 10px; }
        .role-option h6 { font-weight: 700; margin-bottom: 3px; font-size: 14px; }
        .role-option p { font-size: 11px; color: #666; margin: 0; }
        .auth-illustration { width: 120px; height: 120px; background: rgba(255,255,255,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 25px; }
        .auth-illustration i { font-size: 50px; }

        @media (max-width: 768px) {
            .event-title-main { font-size: 1.75rem; }
            .event-image-main { height: 250px; }
            .auth-modal-left { display: none; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-main">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('welcome') }}" class="navbar-brand">
                    <i class="fas fa-calendar-alt"></i>
                    TemuEvent
                </a>
                <div class="d-none d-md-flex align-items-center gap-4">
                    <a href="{{ route('events.index') }}" class="nav-link">Jelajahi Event</a>
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
                        <button class="btn btn-nav btn-nav-outline" data-bs-toggle="modal" data-bs-target="#authModal" onclick="showLogin()">Masuk</button>
                        <button class="btn btn-nav btn-nav-primary" data-bs-toggle="modal" data-bs-target="#authModal" onclick="showRegister()">Daftar</button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-event">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-custom">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Event</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($event->title, 30) }}</li>
                </ol>
            </nav>
            <h1 class="event-title-main">{{ $event->title }}</h1>
            <div class="event-meta-hero">
                <div class="meta-badge">
                    <i class="fas fa-calendar"></i>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }} WIB
                </div>
                <div class="meta-badge">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $event->location }}
                </div>
                @if($event->category)
                <div class="meta-badge">
                    <i class="fas fa-tag"></i>
                    {{ $event->category->name }}
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 mb-4">
                    <div class="card-custom mb-4">
                        <div class="event-image-main">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}">
                            @else
                                <div class="event-image-placeholder">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            @endif
                            <div class="price-badge {{ $event->price == 0 ? 'price-free' : 'price-paid' }}">
                                @if($event->price == 0)
                                    <i class="fas fa-gift me-1"></i>GRATIS
                                @else
                                    Rp {{ number_format($event->price, 0, ',', '.') }}
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <h5 class="section-title">Deskripsi Event</h5>
                            <div class="section-content">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                            
                            @if($event->requirements)
                            <hr class="my-4">
                            <h5 class="section-title">Persyaratan</h5>
                            <div class="section-content">
                                {!! is_array($event->requirements) ? nl2br(e(implode("\n", $event->requirements))) : nl2br(e($event->requirements)) !!}
                            </div>
                            @endif
                            
                            @if($event->contact_info)
                            <hr class="my-4">
                            <h5 class="section-title">Informasi Kontak</h5>
                            <div class="section-content">
                                {!! is_array($event->contact_info) ? nl2br(e(implode("\n", $event->contact_info))) : nl2br(e($event->contact_info)) !!}
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Ratings Section -->
                    <div class="card-custom p-4">
                        <h5 class="section-title mb-4">Ulasan Event</h5>
                        
                        @if($event->ratings && $event->ratings->count() > 0)
                            @php $avgRating = $event->ratings->avg('rating'); @endphp
                            <div class="rating-summary">
                                <div class="rating-number">{{ number_format($avgRating, 1) }}</div>
                                <div class="rating-stars-summary">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= round($avgRating) ? '' : '-half-alt' }}"></i>
                                    @endfor
                                </div>
                                <div class="rating-count">{{ $event->ratings->count() }} ulasan</div>
                            </div>
                            
                            @foreach($event->ratings as $rating)
                            <div class="rating-card">
                                <div class="rating-header">
                                    <span class="rating-user"><i class="fas fa-user-circle me-2"></i>{{ $rating->user->name }}</span>
                                    <span class="rating-date">{{ $rating->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $rating->rating ? '' : ' text-muted' }}"></i>
                                    @endfor
                                </div>
                                <p class="rating-comment">{{ $rating->comment }}</p>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-comments text-muted mb-3" style="font-size: 3rem;"></i>
                                <p class="text-muted">Belum ada ulasan untuk event ini.</p>
                            </div>
                        @endif
                        
                        @auth
                            @if(auth()->user()->isUser() && $event->participants && $event->participants->contains('user_id', auth()->id()))
                            <hr class="my-4">
                            <h6 class="fw-bold mb-3">Beri Ulasan</h6>
                            <form action="{{ route('user.events.rating', $event->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <select class="form-select form-control-auth" name="rating" required>
                                        <option value="">Pilih Rating</option>
                                        <option value="5">5 - Sangat Baik</option>
                                        <option value="4">4 - Baik</option>
                                        <option value="3">3 - Cukup</option>
                                        <option value="2">2 - Kurang</option>
                                        <option value="1">1 - Sangat Kurang</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control form-control-auth" name="comment" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
                                </div>
                                <button type="submit" class="btn-register">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Ulasan
                                </button>
                            </form>
                            @endif
                        @endauth
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="info-card p-4">
                        <h5 class="section-title">Informasi Event</h5>
                        
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div>
                                <div class="info-label">Tanggal & Waktu</div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }} WIB</div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <div class="info-label">Lokasi</div>
                                <div class="info-value">{{ $event->location }}</div>
                            </div>
                        </div>
                        
                        @if($event->category)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-tag"></i></div>
                            <div>
                                <div class="info-label">Kategori</div>
                                <div class="info-value">{{ $event->category->name }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($event->organizer)
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-user-tie"></i></div>
                            <div>
                                <div class="info-label">Penyelenggara</div>
                                <div class="info-value">{{ $event->organizer->name }}</div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="info-item">
                            <div class="info-icon"><i class="fas fa-users"></i></div>
                            <div>
                                <div class="info-label">Peserta</div>
                                <div class="info-value">{{ $event->participants ? $event->participants->count() : 0 }} / {{ $event->max_participants }}</div>
                            </div>
                        </div>
                        
                        @php
                            $participantsCount = $event->participants ? $event->participants->count() : 0;
                            $percentage = $event->max_participants > 0 ? ($participantsCount / $event->max_participants) * 100 : 0;
                        @endphp
                        <div class="progress-custom mb-4">
                            <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                        </div>
                        
                        @auth
                            @if(auth()->user()->isUser())
                                @php
                                    $isRegistered = $event->participants && $event->participants->contains('user_id', auth()->id());
                                @endphp
                                @if(!$isRegistered)
                                    <form action="{{ route('user.events.register', $event->id) }}" method="POST" class="mb-3">
                                        @csrf
                                        <button type="submit" class="btn-register">
                                            <i class="fas fa-plus-circle me-2"></i>Daftar Event
                                        </button>
                                    </form>
                                @else
                                    <button class="btn-registered mb-3" disabled>
                                        <i class="fas fa-check-circle me-2"></i>Sudah Terdaftar
                                    </button>
                                @endif
                                
                                @if(isset($event->favorites))
                                    @php $isFavorited = $event->favorites->contains('user_id', auth()->id()); @endphp
                                    <form action="{{ route('user.events.favorite', $event->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-favorite w-100 {{ $isFavorited ? 'active' : '' }}">
                                            <i class="fas fa-heart me-2"></i>
                                            {{ $isFavorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                        
                        @guest
                            <div class="alert-login p-3 text-center">
                                <p class="mb-2">Ingin mengikuti event ini?</p>
                                <span class="auth-link" data-bs-toggle="modal" data-bs-target="#authModal" onclick="showLogin()">Masuk</span> atau 
                                <span class="auth-link" data-bs-toggle="modal" data-bs-target="#authModal" onclick="showRegister()">Daftar</span>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand"><i class="fas fa-calendar-alt me-2"></i>TemuEvent</div>
                    <p>Platform event terbaik untuk menemukan dan mengikuti berbagai acara menarik di Indonesia.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('welcome') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('events.index') }}">Jelajahi Event</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5>Bantuan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">FAQ</a></li>
                        <li class="mb-2"><a href="#">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <h5>Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i>hello@temuevent.id</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i>+62 812 3456 7890</li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center"><small>&copy; {{ date('Y') }} TemuEvent. All rights reserved.</small></div>
        </div>
    </footer>

    <!-- Auth Modal -->
    <div class="modal fade" id="authModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-md-5 auth-modal-left">
                            <div class="auth-illustration"><i class="fas fa-calendar-check"></i></div>
                            <h3 id="authModalTitle">Selamat Datang!</h3>
                            <p id="authModalSubtitle">Masuk untuk mengikuti event ini</p>
                        </div>
                        <div class="col-md-7 auth-modal-right">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                            
                            <!-- Login Form -->
                            <div id="loginForm">
                                <h4>Masuk ke Akun</h4>
                                <p class="subtitle">Silakan masukkan email dan kata sandi</p>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Email</label>
                                        <input type="email" class="form-control form-control-auth" name="email" placeholder="contoh@email.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Kata Sandi</label>
                                        <input type="password" class="form-control form-control-auth" name="password" placeholder="Masukkan kata sandi" required>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                                        <label class="form-check-label small" for="remember">Ingat saya</label>
                                    </div>
                                    <button type="submit" class="btn btn-auth mb-3"><i class="fas fa-sign-in-alt me-2"></i>Masuk</button>
                                </form>
                                <p class="text-center small mb-0">Belum punya akun? <span class="auth-link" onclick="showRegister()">Daftar di sini</span></p>
                            </div>

                            <!-- Register Form -->
                            <div id="registerForm" style="display: none;">
                                <h4>Buat Akun Baru</h4>
                                <p class="subtitle">Isi data untuk mendaftar</p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label small fw-semibold">Nama</label>
                                            <input type="text" class="form-control form-control-auth" name="name" placeholder="Nama lengkap" required>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label small fw-semibold">Telepon</label>
                                            <input type="text" class="form-control form-control-auth" name="phone" placeholder="08xxx">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Email</label>
                                        <input type="email" class="form-control form-control-auth" name="email" placeholder="contoh@email.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-semibold">Daftar Sebagai</label>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="role-option" onclick="selectRole('user', this)">
                                                    <i class="fas fa-user"></i>
                                                    <h6>Pengguna</h6>
                                                    <p>Ikuti event</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="role-option" onclick="selectRole('event_organizer', this)">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <h6>Organizer</h6>
                                                    <p>Buat event</p>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="role" id="roleInput" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label class="form-label small fw-semibold">Kata Sandi</label>
                                            <input type="password" class="form-control form-control-auth" name="password" placeholder="Min. 8 karakter" required>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label class="form-label small fw-semibold">Konfirmasi</label>
                                            <input type="password" class="form-control form-control-auth" name="password_confirmation" placeholder="Ulangi sandi" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-auth mb-3"><i class="fas fa-user-plus me-2"></i>Daftar</button>
                                </form>
                                <p class="text-center small mb-0">Sudah punya akun? <span class="auth-link" onclick="showLogin()">Masuk di sini</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showLogin() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registerForm').style.display = 'none';
            document.getElementById('authModalTitle').textContent = 'Selamat Datang!';
            document.getElementById('authModalSubtitle').textContent = 'Masuk untuk mengikuti event ini';
        }

        function showRegister() {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = 'block';
            document.getElementById('authModalTitle').textContent = 'Bergabunglah!';
            document.getElementById('authModalSubtitle').textContent = 'Buat akun untuk memulai';
        }

        function selectRole(role, element) {
            document.getElementById('roleInput').value = role;
            document.querySelectorAll('.role-option').forEach(el => el.classList.remove('selected'));
            element.classList.add('selected');
        }
    </script>
</body>
</html>
