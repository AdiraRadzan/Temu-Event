<!-- User Sidebar - Modern Design -->
<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Menu Utama</div>
</div>

<a href="{{ route('user.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
    <i class="fas fa-th-large sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Dashboard</span>
</a>

<a href="{{ route('events.index') }}" class="sidebar-nav-item {{ request()->routeIs('events.index') ? 'active' : '' }}">
    <i class="fas fa-compass sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Jelajahi Event</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Event Saya</div>
</div>

<a href="{{ route('user.my-events') }}" class="sidebar-nav-item {{ request()->routeIs('user.my-events') ? 'active' : '' }}">
    <i class="fas fa-ticket-alt sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Tiket Saya</span>
</a>

<a href="{{ route('user.favorites') }}" class="sidebar-nav-item {{ request()->routeIs('user.favorites') ? 'active' : '' }}">
    <i class="fas fa-heart sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Favorit</span>
</a>

<a href="{{ route('user.ratings') }}" class="sidebar-nav-item {{ request()->routeIs('user.ratings') ? 'active' : '' }}">
    <i class="fas fa-star sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Review Saya</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Lainnya</div>
</div>

<a href="#" class="sidebar-nav-item" onclick="alert('Fitur notifikasi akan segera hadir!'); return false;">
    <i class="fas fa-bell sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Notifikasi</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Pengaturan</div>
</div>

<a href="{{ route('user.profile') }}" class="sidebar-nav-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
    <i class="fas fa-user sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Profil Saya</span>
</a>

<a href="{{ route('user.settings') }}" class="sidebar-nav-item {{ request()->routeIs('user.settings') ? 'active' : '' }}">
    <i class="fas fa-cog sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Pengaturan</span>
</a>

<div style="border-top: 1px solid rgba(255,255,255,0.08); margin: 1rem 1.25rem;"></div>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-nav-item w-100 text-start border-0 bg-transparent" style="cursor: pointer;">
        <i class="fas fa-sign-out-alt sidebar-nav-icon"></i>
        <span class="sidebar-nav-text">Logout</span>
    </button>
</form>
