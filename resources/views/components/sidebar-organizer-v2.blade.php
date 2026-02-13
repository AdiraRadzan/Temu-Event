<!-- Organizer Sidebar - Modern Design -->
<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Menu Utama</div>
</div>

<a href="{{ route('organizer.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('organizer.dashboard') ? 'active' : '' }}">
    <i class="fas fa-th-large sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Dashboard</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Event</div>
</div>

<a href="{{ route('organizer.events.index') }}" class="sidebar-nav-item {{ request()->routeIs('organizer.events.index') || request()->routeIs('organizer.events.show') ? 'active' : '' }}">
    <i class="fas fa-calendar-alt sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Event Saya</span>
</a>

<a href="{{ route('organizer.events.create') }}" class="sidebar-nav-item {{ request()->routeIs('organizer.events.create') ? 'active' : '' }}">
    <i class="fas fa-plus-circle sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Buat Event</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Manajemen</div>
</div>

<a href="#" class="sidebar-nav-item" onclick="alert('Fitur booking management akan segera hadir!'); return false;">
    <i class="fas fa-ticket-alt sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Booking</span>
</a>

<a href="#" class="sidebar-nav-item" onclick="alert('Fitur review management akan segera hadir!'); return false;">
    <i class="fas fa-star sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Review Event</span>
</a>

<a href="#" class="sidebar-nav-item" onclick="alert('Fitur analytics akan segera hadir!'); return false;">
    <i class="fas fa-chart-line sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Analytics</span>
</a>

<a href="#" class="sidebar-nav-item" onclick="alert('Fitur notifikasi akan segera hadir!'); return false;">
    <i class="fas fa-bell sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Notifikasi</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Pengaturan</div>
</div>

<a href="{{ route('organizer.profile') }}" class="sidebar-nav-item {{ request()->routeIs('organizer.profile') ? 'active' : '' }}">
    <i class="fas fa-user sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Profil Organizer</span>
</a>

<a href="{{ route('organizer.settings') }}" class="sidebar-nav-item {{ request()->routeIs('organizer.settings') ? 'active' : '' }}">
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
