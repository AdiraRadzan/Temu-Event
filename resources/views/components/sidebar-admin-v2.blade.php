<!-- Admin Sidebar - Modern Design -->
<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Menu Utama</div>
</div>

<a href="{{ route('admin.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="fas fa-th-large sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Dashboard</span>
</a>

<a href="{{ route('admin.analytics') }}" class="sidebar-nav-item {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
    <i class="fas fa-chart-line sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Analytics</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Manajemen</div>
</div>

<a href="{{ route('admin.users.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
    <i class="fas fa-users sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Pengguna</span>
</a>

<a href="{{ route('admin.events.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
    <i class="fas fa-calendar-alt sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Event</span>
</a>

<a href="{{ route('admin.organizers.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.organizers.*') ? 'active' : '' }}">
    <i class="fas fa-user-tie sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Organizer</span>
    @php
        $pendingCount = \App\Models\User::where('role', 'event_organizer')->where('organizer_status', 'pending')->count();
    @endphp
    @if($pendingCount > 0)
        <span class="sidebar-nav-badge">{{ $pendingCount }}</span>
    @endif
</a>

<a href="{{ route('admin.ratings.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.ratings.*') ? 'active' : '' }}">
    <i class="fas fa-star sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Rating & Review</span>
</a>

<div class="sidebar-nav-section">
    <div class="sidebar-nav-section-title">Pengaturan</div>
</div>

<a href="{{ route('admin.settings') }}" class="sidebar-nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
    <i class="fas fa-cog sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Pengaturan</span>
</a>

<a href="{{ route('admin.profile') }}" class="sidebar-nav-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
    <i class="fas fa-user-shield sidebar-nav-icon"></i>
    <span class="sidebar-nav-text">Profil Admin</span>
</a>

<div style="border-top: 1px solid rgba(255,255,255,0.08); margin: 1rem 1.25rem;"></div>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="sidebar-nav-item w-100 text-start border-0 bg-transparent" style="cursor: pointer;">
        <i class="fas fa-sign-out-alt sidebar-nav-icon"></i>
        <span class="sidebar-nav-text">Logout</span>
    </button>
</form>
