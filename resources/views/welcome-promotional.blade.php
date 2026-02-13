<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TemuEvent - Platform Event Terbaik di Indonesia</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; overflow-x: hidden; }

        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes sparkle { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
        .float-animation { animation: float 6s ease-in-out infinite; }

        .navbar-main {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }
        .navbar-main.scrolled {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: 800;
            color: white !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .navbar-brand i { color: #fbbf24; }
        .navbar-main.scrolled .navbar-brand { color: var(--primary) !important; }
        .nav-link { color: rgba(255,255,255,0.9) !important; font-weight: 500; text-decoration: none; padding: 0.5rem 1rem; transition: 0.3s; }
        .nav-link:hover { color: white !important; }
        .navbar-main.scrolled .nav-link { color: #475569 !important; }
        .navbar-main.scrolled .nav-link:hover { color: var(--primary) !important; }
        .btn-nav { padding: 0.75rem 1.75rem; border-radius: 50px; font-weight: 600; text-decoration: none; transition: 0.3s; border: none; }
        .btn-nav-outline { border: 2px solid rgba(255,255,255,0.6); color: white; background: transparent; }
        .btn-nav-outline:hover { background: white; color: var(--primary); }
        .navbar-main.scrolled .btn-nav-outline { border-color: var(--primary); color: var(--primary); }
        .btn-nav-primary { background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: #1e293b; }
        .btn-nav-primary:hover { box-shadow: 0 6px 20px rgba(251, 191, 36, 0.5); color: #1e293b; }

        .hero {
            min-height: 100vh;
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #5b86e5);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-particles { position: absolute; top: 0; left: 0; right: 0; bottom: 0; overflow: hidden; }
        .particle {
            position: absolute;
            width: 10px; height: 10px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            animation: float 8s infinite;
        }
        .particle:nth-child(1) { left: 10%; top: 20%; width: 20px; height: 20px; }
        .particle:nth-child(2) { left: 20%; top: 80%; animation-delay: 1s; width: 15px; height: 15px; }
        .particle:nth-child(3) { left: 60%; top: 10%; animation-delay: 2s; width: 25px; height: 25px; }
        .particle:nth-child(4) { left: 80%; top: 50%; animation-delay: 3s; }
        .particle:nth-child(5) { left: 90%; top: 80%; animation-delay: 4s; width: 18px; height: 18px; }
        .hero-content { position: relative; z-index: 10; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .hero-badge i { color: #fbbf24; animation: sparkle 2s infinite; }
        .hero-title { font-size: 4rem; font-weight: 800; color: white; line-height: 1.1; margin-bottom: 1.5rem; }
        .hero-title span { 
            background: linear-gradient(90deg, #fbbf24, #f59e0b, #fbbf24);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient 3s linear infinite;
        }
        .hero-desc { font-size: 1.3rem; color: rgba(255,255,255,0.95); margin-bottom: 2.5rem; max-width: 550px; line-height: 1.7; }
        .hero-buttons { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 3rem; }
        .btn-hero { 
            padding: 1.1rem 2.5rem; 
            border-radius: 50px; 
            font-weight: 700; 
            text-decoration: none; 
            display: inline-flex; 
            align-items: center; 
            gap: 0.5rem; 
            transition: all 0.3s ease;
            font-size: 1.1rem;
            border: none;
        }
        .btn-hero-primary { 
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); 
            color: #1e293b; 
            box-shadow: 0 10px 40px rgba(251, 191, 36, 0.4);
        }
        .btn-hero-primary:hover { transform: translateY(-4px); box-shadow: 0 15px 50px rgba(251, 191, 36, 0.5); color: #1e293b; }
        .btn-hero-outline { background: rgba(255,255,255,0.15); color: white; border: 2px solid rgba(255,255,255,0.5); }
        .btn-hero-outline:hover { background: rgba(255,255,255,0.25); color: white; transform: translateY(-4px); }
        .hero-stats { display: flex; gap: 3rem; }
        .hero-stat { text-align: center; }
        .hero-stat-number { font-size: 2.5rem; font-weight: 800; color: white; }
        .hero-stat-label { font-size: 0.9rem; color: rgba(255,255,255,0.8); font-weight: 500; }
        .hero-image-card {
            background: white;
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
            transform: rotate(3deg);
        }

        .section { padding: 6rem 0; }
        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(236, 72, 153, 0.1));
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .section-title { font-size: 3rem; font-weight: 800; margin-bottom: 1rem; }
        .section-title span { color: var(--primary); }
        .section-subtitle { color: #64748b; max-width: 600px; margin: 0 auto 3rem; font-size: 1.1rem; }
        .feature-card {
            background: white;
            border-radius: 24px;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.4s ease;
            border: 1px solid #f1f5f9;
        }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 25px 50px rgba(0,0,0,0.1); }
        .feature-icon {
            width: 70px; height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            color: white;
        }
        .feature-icon-1 { background: var(--gradient-1); }
        .feature-icon-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .feature-icon-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .feature-card h4 { font-weight: 700; margin-bottom: 0.75rem; font-size: 1.25rem; }
        .feature-card p { color: #64748b; margin: 0; line-height: 1.7; }

        .stats-section {
            background: var(--gradient-1);
            padding: 5rem 0;
        }
        .stat-item { text-align: center; }
        .stat-number { font-size: 3.5rem; font-weight: 800; color: white; margin-bottom: 0.5rem; }
        .stat-label { color: rgba(255,255,255,0.9); font-size: 1.1rem; font-weight: 500; }

        .category-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .category-card:hover { 
            transform: translateY(-8px); 
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
        }
        .category-icon {
            width: 80px; height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
        }
        .category-card h5 { font-weight: 700; margin-bottom: 0.5rem; }
        .category-card p { color: #64748b; font-size: 0.9rem; margin: 0; }

        .cta-section {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #5b86e5);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            padding: 6rem 0;
            text-align: center;
        }
        .cta-section h2 { font-size: 3rem; font-weight: 800; color: white; margin-bottom: 1rem; }
        .cta-section p { color: rgba(255,255,255,0.9); margin-bottom: 2rem; font-size: 1.2rem; }

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
        .form-control-auth {
            border-radius: 12px;
            padding: 14px 18px;
            border: 2px solid #e9ecef;
        }
        .form-control-auth:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        .btn-auth {
            background: var(--gradient-1);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 600;
            color: white;
            width: 100%;
        }
        .btn-auth:hover { box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4); color: white; }
        .auth-link { color: var(--primary); font-weight: 600; cursor: pointer; }
        .role-option {
            border: 2px solid #e9ecef;
            border-radius: 16px;
            padding: 20px 15px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
        }
        .role-option:hover { border-color: var(--primary); background: rgba(99, 102, 241, 0.05); }
        .role-option.selected { border-color: var(--primary); background: rgba(99, 102, 241, 0.1); }
        .role-option i { font-size: 28px; color: var(--primary); margin-bottom: 10px; }
        .role-option h6 { font-weight: 700; margin-bottom: 3px; font-size: 14px; }
        .role-option p { font-size: 11px; color: #666; margin: 0; }
        .auth-illustration { 
            width: 120px; height: 120px; 
            background: rgba(255,255,255,0.15); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin-bottom: 25px;
        }
        .auth-illustration i { font-size: 50px; }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .hero-stats { gap: 1.5rem; flex-wrap: wrap; }
            .section-title { font-size: 2rem; }
            .auth-modal-left { display: none; }
            .stat-number { font-size: 2.5rem; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-main" id="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('welcome') }}" class="navbar-brand">
                    <i class="fas fa-calendar-alt"></i>
                    TemuEvent
                </a>
                <div class="d-none d-md-flex align-items-center gap-4">
                    <a href="{{ route('events.index') }}" class="nav-link">Jelajahi Event</a>
                    <a href="#features" class="nav-link">Fitur</a>
                    <a href="#categories" class="nav-link">Kategori</a>
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
                        <button class="btn btn-nav btn-nav-primary" data-bs-toggle="modal" data-bs-target="#authModal" onclick="showRegister()">Daftar Gratis</button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content" data-aos="fade-right">
                    <div class="hero-badge">
                        <i class="fas fa-fire"></i>
                        Platform Event #1 di Indonesia
                    </div>
                    <h1 class="hero-title">
                        Temukan Event <span>Impianmu</span> Sekarang!
                    </h1>
                    <p class="hero-desc">
                        Jelajahi ribuan event seru mulai dari konser, workshop, seminar hingga festival. 
                        Satu platform untuk semua pengalaman tak terlupakan!
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('events.index') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-compass"></i>
                            Jelajahi Sekarang
                        </a>
                        @guest
                        <button class="btn-hero btn-hero-outline" data-bs-toggle="modal" data-bs-target="#authModal" onclick="showRegister()">
                            <i class="fas fa-rocket"></i>
                            Mulai Gratis
                        </button>
                        @endguest
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="hero-stat-number">500+</div>
                            <div class="hero-stat-label">Event Aktif</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-number">50K+</div>
                            <div class="hero-stat-label">Pengguna</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hero-stat-number">100+</div>
                            <div class="hero-stat-label">Kota</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <div class="float-animation">
                        <div class="hero-image-card">
                            <div class="text-center py-5">
                                <i class="fas fa-calendar-check text-primary" style="font-size: 6rem;"></i>
                                <h4 class="mt-3 mb-2">Event Terbaru</h4>
                                <p class="text-muted mb-0">Temukan event seru setiap hari!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section" id="features">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <div class="section-badge"><i class="fas fa-star"></i> Fitur Unggulan</div>
                <h2 class="section-title">Kenapa Pilih <span>TemuEvent</span>?</h2>
                <p class="section-subtitle">Platform lengkap dengan fitur-fitur canggih untuk pengalaman event terbaik</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon feature-icon-1"><i class="fas fa-search"></i></div>
                        <h4>Pencarian Cerdas</h4>
                        <p>Temukan event berdasarkan kategori, lokasi, tanggal, atau kata kunci dengan mudah</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon feature-icon-2"><i class="fas fa-bolt"></i></div>
                        <h4>Pendaftaran Instan</h4>
                        <p>Daftar event favorit Anda hanya dalam hitungan detik tanpa ribet</p>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon feature-icon-3"><i class="fas fa-bell"></i></div>
                        <h4>Notifikasi Real-time</h4>
                        <p>Dapatkan update dan pengingat tentang event yang Anda ikuti</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3" data-aos="zoom-in">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Event Aktif</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-item">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Pengguna</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Kota</div>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-item">
                        <div class="stat-number">4.9</div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="section bg-light" id="categories">
        <div class="container">
            <div class="text-center" data-aos="fade-up">
                <div class="section-badge"><i class="fas fa-th-large"></i> Kategori Event</div>
                <h2 class="section-title">Eksplorasi <span>Kategori</span></h2>
                <p class="section-subtitle">Temukan event sesuai minat dan passion Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up">
                    <a href="{{ route('events.index') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon" style="background: rgba(99, 102, 241, 0.1);"><i class="fas fa-music text-primary"></i></div>
                            <h5>Musik</h5>
                            <p>50+ Event</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('events.index') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon" style="background: rgba(236, 72, 153, 0.1);"><i class="fas fa-laptop-code" style="color: #ec4899;"></i></div>
                            <h5>Teknologi</h5>
                            <p>80+ Event</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('events.index') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon" style="background: rgba(16, 185, 129, 0.1);"><i class="fas fa-briefcase" style="color: #10b981;"></i></div>
                            <h5>Bisnis</h5>
                            <p>60+ Event</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('events.index') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon" style="background: rgba(245, 158, 11, 0.1);"><i class="fas fa-paint-brush" style="color: #f59e0b;"></i></div>
                            <h5>Seni</h5>
                            <p>40+ Event</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('events.index') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon" style="background: rgba(239, 68, 68, 0.1);"><i class="fas fa-futbol" style="color: #ef4444;"></i></div>
                            <h5>Olahraga</h5>
                            <p>30+ Event</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ route('events.index') }}" class="text-decoration-none">
                        <div class="category-card">
                            <div class="category-icon" style="background: rgba(139, 92, 246, 0.1);"><i class="fas fa-graduation-cap" style="color: #8b5cf6;"></i></div>
                            <h5>Edukasi</h5>
                            <p>70+ Event</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    @guest
    <section class="cta-section">
        <div class="container" data-aos="zoom-in">
            <h2>Siap Menemukan Event Impianmu?</h2>
            <p>Bergabung sekarang dan mulai jelajahi ribuan event seru!</p>
            <button class="btn-hero btn-hero-primary" data-bs-toggle="modal" data-bs-target="#authModal" onclick="showRegister()">
                <i class="fas fa-rocket"></i>
                Daftar Gratis Sekarang
            </button>
        </div>
    </section>
    @endguest

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
                            <p id="authModalSubtitle">Masuk untuk menemukan event menarik</p>
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 800 });

        window.addEventListener('scroll', function() {
            document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 50);
        });

        function showLogin() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registerForm').style.display = 'none';
            document.getElementById('authModalTitle').textContent = 'Selamat Datang!';
            document.getElementById('authModalSubtitle').textContent = 'Masuk untuk menemukan event menarik';
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
