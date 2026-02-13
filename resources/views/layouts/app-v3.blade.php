<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'TemuEvent') - Platform Event Indonesia</title>
    
    <!-- Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Enhanced CSS -->
    <link href="{{ asset('css/app-v2-enhanced.css') }}" rel="stylesheet">
    
    @guest
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .navbar-public {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-link-public {
            color: #475569 !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .nav-link-public:hover { color: var(--primary) !important; }
        .btn-nav {
            padding: 0.625rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-nav-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
        }
        .btn-nav-outline:hover {
            background: var(--primary);
            color: white;
        }
        .btn-nav-primary {
            background: var(--primary);
            color: white;
        }
        .btn-nav-primary:hover {
            background: var(--primary-dark);
            color: white;
        }
        .main-content.guest {
            margin-left: 0 !important;
            padding-top: 0;
        }
        .content-wrapper {
            padding: 2rem;
        }
        .footer-public {
            background: #1e293b;
            color: #94a3b8;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }
        .footer-public a {
            color: #94a3b8;
            text-decoration: none;
        }
        .footer-public a:hover {
            color: white;
        }
    </style>
    @endguest
    
    @stack('styles')
</head>
<body>
    @auth
    <!-- Mobile Menu Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('welcome') }}" class="sidebar-brand">
                <i class="fas fa-calendar-alt"></i>
                TemuEvent
            </a>
        </div>
        
        <div class="sidebar-nav">
            @if(auth()->user()->isUser())
                <!-- User Navigation -->
                <div class="sidebar-nav-item">
                    <a href="{{ route('welcome') }}" class="sidebar-nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('user.dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('events.index') }}" class="sidebar-nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar"></i>
                        <span>Semua Event</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('user.my-events') }}" class="sidebar-nav-link {{ request()->routeIs('user.my-events') ? 'active' : '' }}">
                        <i class="fas fa-list-check"></i>
                        <span>Event Saya</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('user.favorites') }}" class="sidebar-nav-link {{ request()->routeIs('user.favorites') ? 'active' : '' }}">
                        <i class="fas fa-heart"></i>
                        <span>Event Favorit</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('user.search') }}" class="sidebar-nav-link {{ request()->routeIs('user.search') ? 'active' : '' }}">
                        <i class="fas fa-search"></i>
                        <span>Cari Event</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('user.profile') }}" class="sidebar-nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </div>
                
            @elseif(auth()->user()->isEventOrganizer())
                <!-- Event Organizer Navigation -->
                <div class="sidebar-nav-item">
                    <a href="{{ route('welcome') }}" class="sidebar-nav-link {{ request()->routeIs('welcome') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Beranda</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('organizer.dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('organizer.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('organizer.events.index') }}" class="sidebar-nav-link {{ request()->routeIs('organizer.events.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar"></i>
                        <span>Kelola Event</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('organizer.events.create') }}" class="sidebar-nav-link {{ request()->routeIs('organizer.events.create') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i>
                        <span>Buat Event</span>
                    </a>
                </div>
                @if(auth()->user()->status === 'pending')
                <div class="sidebar-nav-item">
                    <a href="{{ route('organizer.pending-verification') }}" class="sidebar-nav-link {{ request()->routeIs('organizer.pending-verification') ? 'active' : '' }}">
                        <i class="fas fa-clock"></i>
                        <span>Menunggu Verifikasi</span>
                    </a>
                </div>
                @endif
                <div class="sidebar-nav-item">
                    <a href="{{ route('organizer.profile') }}" class="sidebar-nav-link {{ request()->routeIs('organizer.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </div>
                
            @elseif(auth()->user()->isAdmin())
                <!-- Admin Navigation -->
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.events.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar"></i>
                        <span>Kelola Event</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.events.featured') }}" class="sidebar-nav-link {{ request()->routeIs('admin.events.featured') ? 'active' : '' }}">
                        <i class="fas fa-star"></i>
                        <span>Event Unggulan</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.organizers.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.organizers.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Kelola Penyelenggara</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.users.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-user-friends"></i>
                        <span>Kelola User</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.ratings.index') }}" class="sidebar-nav-link {{ request()->routeIs('admin.ratings.*') ? 'active' : '' }}">
                        <i class="fas fa-star"></i>
                        <span>Penilaian</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.analytics') }}" class="sidebar-nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.profile') }}" class="sidebar-nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>Profil</span>
                    </a>
                </div>
                <div class="sidebar-nav-item">
                    <a href="{{ route('admin.settings') }}" class="sidebar-nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                </div>
            @endif
            
            <!-- Logout -->
            <div class="sidebar-nav-item mt-4 pt-4 border-top border-gray-200">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-nav-link text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    @endauth

    @guest
    <!-- Public Navbar -->
    <nav class="navbar-public">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('welcome') }}" class="navbar-brand">
                    <i class="fas fa-calendar-alt"></i>
                    TemuEvent
                </a>
                <div class="d-none d-md-flex align-items-center gap-4">
                    <a href="{{ route('events.index') }}" class="nav-link-public {{ request()->routeIs('events.*') ? 'fw-bold' : '' }}">Jelajahi Event</a>
                    <a href="{{ route('welcome') }}#features" class="nav-link-public">Fitur</a>
                    <a href="{{ route('welcome') }}#testimonials" class="nav-link-public">Testimonial</a>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" class="btn btn-nav btn-nav-outline">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-nav btn-nav-primary">Daftar</a>
                </div>
            </div>
        </div>
    </nav>
    @endguest

    <!-- Main Content -->
    <main class="main-content {{ auth()->check() ? 'authenticated' : 'guest' }}">
        @auth
        <!-- Header for authenticated users -->
        <header class="header">
            <div class="header-content">
                <div class="header-left">
                    <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div>
                        <h1 class="header-title mb-0">@yield('page-title', 'Dashboard')</h1>
                        @hasSection('page-description')
                        <p class="text-muted mb-0 mt-1">@yield('page-description')</p>
                        @endif
                    </div>
                </div>
                
                <div class="header-actions">
                    <!-- Search -->
                    <div class="d-none d-md-block">
                        <div class="input-group" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Cari event...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Notifications -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6em;">
                                3
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Notifikasi</h6></li>
                            <li><a class="dropdown-item" href="#">Event baru tersedia</a></li>
                            <li><a class="dropdown-item" href="#">Pendaftaran berhasil</a></li>
                            <li><a class="dropdown-item" href="#">Event dimulai besok</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#">Lihat semua</a></li>
                        </ul>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="dropdown-header">
                                    <strong>{{ auth()->user()->name }}</strong><br>
                                    <small class="text-muted">
                                        @if(auth()->user()->isAdmin())
                                            Administrator
                                        @elseif(auth()->user()->isEventOrganizer())
                                            Event Organizer
                                            @if(auth()->user()->status === 'pending')
                                                <span class="badge bg-warning text-dark ms-1">Pending</span>
                                            @elseif(auth()->user()->status === 'approved')
                                                <span class="badge bg-success ms-1">Approved</span>
                                            @endif
                                        @else
                                            User
                                        @endif
                                    </small>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profile') }}">
                                    <i class="fas fa-user me-2"></i>Profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('user.settings') }}">
                                    <i class="fas fa-cog me-2"></i>Pengaturan
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Keluar
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        @endauth

        <!-- Page Content -->
        <div class="content-wrapper">
            @yield('page-header')
            @yield('content')
        </div>
    </main>

    @guest
    <!-- Public Footer -->
    <footer class="footer-public">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="text-white mb-3">
                        <i class="fas fa-calendar-alt me-2"></i>TemuEvent
                    </h5>
                    <p class="mb-3">Platform event terbaik di Indonesia untuk menemukan dan mengikuti berbagai acara menarik.</p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h6 class="text-white mb-3">Menu</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('welcome') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('events.index') }}">Jelajahi Event</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}">Daftar</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h6 class="text-white mb-3">Bantuan</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">FAQ</a></li>
                        <li class="mb-2"><a href="#">Kontak</a></li>
                        <li class="mb-2"><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <h6 class="text-white mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <small>&copy; {{ date('Y') }} TemuEvent. All rights reserved.</small>
            </div>
        </div>
    </footer>
    @endguest

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @auth
    <script>
        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            function toggleSidebar() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            }
            
            function closeSidebar() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            }
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }
            
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeSidebar);
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        closeSidebar();
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });
        });
    </script>
    @endauth
    
    <script>
        // Add smooth animations to cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card, .stats-card, .event-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in-up');
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
