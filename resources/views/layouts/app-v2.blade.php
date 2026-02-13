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
    
    @stack('styles')
    
    <style>
        /* ========================================
           MODERN DESIGN SYSTEM - TemuEvent
           Professional, Elegant & Responsive
        ======================================== */
        
        :root {
            --primary-50: #eef2ff;
            --primary-100: #e0e7ff;
            --primary-200: #c7d2fe;
            --primary-300: #a5b4fc;
            --primary-400: #818cf8;
            --primary-500: #6366f1;
            --primary-600: #4f46e5;
            --primary-700: #4338ca;
            --primary-800: #3730a3;
            --primary-900: #312e81;
            
            /* Alias colors for compatibility */
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-rgb: 99, 102, 241;
            --primary-soft: rgba(99, 102, 241, 0.1);
            
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            
            --accent-emerald: #10b981;
            --accent-amber: #f59e0b;
            --accent-rose: #f43f5e;
            --accent-cyan: #06b6d4;
            --accent-violet: #8b5cf6;
            
            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
            
            /* Glass & Surface */
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --surface: #f8fafc;
            --border-light: #e2e8f0;
            
            /* Text */
            --text-primary: #1e293b;
            --text-muted: #64748b;
            
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;
            
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            
            --sidebar-width: 280px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: var(--slate-700);
            background: linear-gradient(135deg, var(--slate-50) 0%, var(--slate-100) 100%);
            min-height: 100vh;
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--slate-900) 0%, var(--slate-800) 100%);
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform var(--transition-slow);
            overflow-y: auto;
            box-shadow: var(--shadow-xl);
        }

        .sidebar.show { transform: translateX(0); }

        .sidebar-header {
            padding: 1.75rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            width: 42px;
            height: 42px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .sidebar-brand-text {
            font-size: 1.35rem;
            font-weight: 700;
            color: white;
        }

        .sidebar-nav { padding: 1.25rem 0; }

        .sidebar-nav-section {
            padding: 0.5rem 1.25rem;
            margin-top: 0.75rem;
        }

        .sidebar-nav-section-title {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--slate-500);
            margin-bottom: 0.5rem;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.25rem;
            color: var(--slate-400);
            text-decoration: none;
            transition: all var(--transition-base);
            border-left: 3px solid transparent;
            position: relative;
        }

        .sidebar-nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.15) 0%, transparent 100%);
            transition: width var(--transition-base);
        }

        .sidebar-nav-item:hover {
            color: white;
            border-left-color: var(--primary-400);
        }

        .sidebar-nav-item:hover::before { width: 100%; }

        .sidebar-nav-item.active {
            color: white;
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.2) 0%, transparent 100%);
            border-left-color: var(--primary-500);
        }

        .sidebar-nav-icon {
            width: 20px;
            margin-right: 0.875rem;
            text-align: center;
            font-size: 1rem;
            position: relative;
            z-index: 1;
        }

        .sidebar-nav-text {
            font-weight: 500;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }

        .sidebar-nav-badge {
            margin-left: auto;
            padding: 0.2rem 0.5rem;
            font-size: 0.7rem;
            font-weight: 600;
            border-radius: var(--radius-full);
            background: var(--accent-rose);
            color: white;
            position: relative;
            z-index: 1;
        }

        .sidebar-footer {
            padding: 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
        }

        .sidebar-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-lg);
            background: linear-gradient(135deg, var(--primary-500), var(--accent-violet));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .sidebar-user-name {
            font-weight: 600;
            color: white;
            font-size: 0.875rem;
        }

        .sidebar-user-role {
            font-size: 0.75rem;
            color: var(--slate-400);
        }

        /* MAIN CONTENT */
        .main-content {
            min-height: 100vh;
            transition: margin-left var(--transition-slow);
        }

        .main-content.authenticated { margin-left: 0; }

        /* MOBILE HEADER */
        .mobile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.25rem;
            background: white;
            border-bottom: 1px solid var(--slate-200);
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: var(--shadow-sm);
        }

        .mobile-menu-btn {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--slate-100);
            border: none;
            border-radius: var(--radius-lg);
            color: var(--slate-700);
            font-size: 1.25rem;
            cursor: pointer;
            transition: all var(--transition-base);
        }

        .mobile-menu-btn:hover {
            background: var(--slate-200);
            color: var(--primary-600);
        }

        .mobile-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-600);
            text-decoration: none;
        }

        /* GUEST HEADER */
        .guest-header {
            background: white;
            border-bottom: 1px solid var(--slate-200);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: var(--shadow-sm);
        }

        .guest-header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .guest-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-600);
            text-decoration: none;
        }

        .guest-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .guest-nav-link {
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            color: var(--slate-600);
            text-decoration: none;
            border-radius: var(--radius-lg);
            transition: all var(--transition-base);
        }

        .guest-nav-link:hover {
            color: var(--primary-600);
            background: var(--primary-50);
        }

        .guest-nav-btn {
            padding: 0.625rem 1.5rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            border: none;
            border-radius: var(--radius-lg);
            text-decoration: none;
            transition: all var(--transition-base);
            box-shadow: var(--shadow-md);
        }

        .guest-nav-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        /* CONTENT */
        .content {
            padding: 1.5rem;
            min-height: calc(100vh - 70px);
        }

        .content-container {
            max-width: 1600px;
            margin: 0 auto;
        }

        /* PAGE HEADER */
        .page-header { margin-bottom: 2rem; }

        .page-header-content {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--slate-900);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-title-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            box-shadow: var(--shadow-md);
        }

        .page-subtitle {
            color: var(--slate-500);
            margin: 0.5rem 0 0 0;
        }

        /* CARDS */
        .card {
            background: white;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all var(--transition-base);
        }

        .card:hover { box-shadow: var(--shadow-md); }

        .card-header {
            padding: 1.25rem 1.5rem;
            background: linear-gradient(180deg, var(--slate-50) 0%, white 100%);
            border-bottom: 1px solid var(--slate-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--slate-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-title-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--primary-100), var(--primary-200));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-600);
        }

        .card-body { padding: 1.5rem; }

        /* STAT CARDS */
        .stat-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            border: 1px solid var(--slate-200);
            transition: all var(--transition-base);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--stat-color, var(--primary-500)), var(--stat-color-light, var(--primary-400)));
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--stat-color, var(--primary-500)), var(--stat-color-light, var(--primary-400)));
            color: white;
            box-shadow: 0 8px 16px -4px var(--stat-shadow, rgba(99, 102, 241, 0.3));
        }

        .stat-card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--slate-900);
        }

        .stat-card-label {
            font-size: 0.875rem;
            color: var(--slate-500);
        }

        .stat-card-trend {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-full);
            margin-top: 0.75rem;
        }

        .stat-card-trend.up {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-emerald);
        }

        .stat-card-trend.down {
            background: rgba(244, 63, 94, 0.1);
            color: var(--accent-rose);
        }

        .stat-card.primary { --stat-color: var(--primary-500); --stat-color-light: var(--primary-400); --stat-shadow: rgba(99, 102, 241, 0.3); }
        .stat-card.success { --stat-color: var(--accent-emerald); --stat-color-light: #34d399; --stat-shadow: rgba(16, 185, 129, 0.3); }
        .stat-card.warning { --stat-color: var(--accent-amber); --stat-color-light: #fbbf24; --stat-shadow: rgba(245, 158, 11, 0.3); }
        .stat-card.danger { --stat-color: var(--accent-rose); --stat-color-light: #fb7185; --stat-shadow: rgba(244, 63, 94, 0.3); }
        .stat-card.info { --stat-color: var(--accent-cyan); --stat-color-light: #22d3ee; --stat-shadow: rgba(6, 182, 212, 0.3); }
        .stat-card.violet { --stat-color: var(--accent-violet); --stat-color-light: #a78bfa; --stat-shadow: rgba(139, 92, 246, 0.3); }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: var(--radius-lg);
            border: none;
            cursor: pointer;
            transition: all var(--transition-base);
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--accent-emerald), #059669);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--accent-rose), #dc2626);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--accent-amber), #d97706);
            color: white;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            color: white;
        }

        .btn-outline-primary {
            background: transparent;
            color: var(--primary-600);
            border: 2px solid var(--primary-200);
        }

        .btn-outline-primary:hover {
            background: var(--primary-50);
            border-color: var(--primary-400);
            color: var(--primary-700);
        }

        .btn-outline-secondary {
            background: transparent;
            color: var(--slate-600);
            border: 2px solid var(--slate-200);
        }

        .btn-outline-secondary:hover {
            background: var(--slate-50);
            border-color: var(--slate-300);
        }

        .btn-outline-success {
            background: transparent;
            color: var(--accent-emerald);
            border: 2px solid rgba(16, 185, 129, 0.3);
        }

        .btn-outline-success:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .btn-outline-danger {
            background: transparent;
            color: var(--accent-rose);
            border: 2px solid rgba(244, 63, 94, 0.3);
        }

        .btn-outline-danger:hover {
            background: rgba(244, 63, 94, 0.1);
            color: #dc2626;
        }

        .btn-outline-warning {
            background: transparent;
            color: var(--accent-amber);
            border: 2px solid rgba(245, 158, 11, 0.3);
        }

        .btn-outline-warning:hover {
            background: rgba(245, 158, 11, 0.1);
        }

        .btn-outline-info {
            background: transparent;
            color: var(--accent-cyan);
            border: 2px solid rgba(6, 182, 212, 0.3);
        }

        .btn-outline-info:hover {
            background: rgba(6, 182, 212, 0.1);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .btn-lg {
            padding: 0.875rem 1.75rem;
            font-size: 1rem;
        }

        .btn-icon {
            width: 40px;
            height: 40px;
            padding: 0;
        }

        .btn-icon.btn-sm {
            width: 32px;
            height: 32px;
        }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.35rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: var(--radius-full);
        }

        .badge-primary, .bg-primary {
            background: var(--primary-100) !important;
            color: var(--primary-700) !important;
        }

        .badge-success, .bg-success {
            background: rgba(16, 185, 129, 0.15) !important;
            color: #059669 !important;
        }

        .badge-warning, .bg-warning {
            background: rgba(245, 158, 11, 0.15) !important;
            color: #d97706 !important;
        }

        .badge-danger, .bg-danger {
            background: rgba(244, 63, 94, 0.15) !important;
            color: #dc2626 !important;
        }

        .badge-info, .bg-info {
            background: rgba(6, 182, 212, 0.15) !important;
            color: #0891b2 !important;
        }

        .badge-secondary, .bg-secondary {
            background: var(--slate-100) !important;
            color: var(--slate-600) !important;
        }

        .bg-light {
            background: var(--slate-100) !important;
        }

        /* TABLES */
        .table-modern {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-modern thead th {
            padding: 1rem 1.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--slate-500);
            background: var(--slate-50);
            border-bottom: 1px solid var(--slate-200);
            text-align: left;
        }

        .table-modern tbody td {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--slate-100);
            vertical-align: middle;
        }

        .table-modern tbody tr {
            transition: all var(--transition-base);
        }

        .table-modern tbody tr:hover {
            background: var(--slate-50);
        }

        .table.table-hover tbody tr:hover {
            background: var(--slate-50);
        }

        /* FORMS */
        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--slate-700);
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            border: 2px solid var(--slate-200);
            border-radius: var(--radius-lg);
            transition: all var(--transition-base);
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary-400);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .form-select {
            padding: 0.75rem 2.5rem 0.75rem 1rem;
            font-size: 0.9rem;
            border: 2px solid var(--slate-200);
            border-radius: var(--radius-lg);
            transition: all var(--transition-base);
            background-color: white;
        }

        .form-select:focus {
            border-color: var(--primary-400);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        /* ALERTS */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #065f46;
        }

        .alert-danger {
            background: rgba(244, 63, 94, 0.1);
            border: 1px solid rgba(244, 63, 94, 0.2);
            color: #991b1b;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.2);
            color: #92400e;
        }

        .alert-info {
            background: rgba(6, 182, 212, 0.1);
            border: 1px solid rgba(6, 182, 212, 0.2);
            color: #155e75;
        }

        /* AVATAR */
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary-500), var(--accent-violet));
            color: white;
        }

        .avatar-sm { width: 32px; height: 32px; font-size: 0.75rem; }
        .avatar-lg { width: 56px; height: 56px; font-size: 1.25rem; }
        .avatar-xl { width: 80px; height: 80px; font-size: 1.75rem; }

        /* PROGRESS */
        .progress {
            height: 8px;
            background: var(--slate-200);
            border-radius: var(--radius-full);
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: var(--radius-full);
            background: linear-gradient(90deg, var(--primary-500), var(--accent-violet));
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: var(--slate-100);
            border-radius: var(--radius-2xl);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--slate-400);
        }

        /* ICON CIRCLE */
        .icon-circle {
            width: 64px;
            height: 64px;
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* FOOTER */
        .footer {
            background: var(--slate-900);
            color: var(--slate-300);
            padding: 3rem 2rem 2rem;
            margin-top: auto;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-link {
            color: var(--slate-400);
            text-decoration: none;
            transition: color var(--transition-base);
        }

        .footer-link:hover { color: white; }

        /* UTILITIES */
        .text-primary { color: var(--primary-600) !important; }
        .text-success { color: var(--accent-emerald) !important; }
        .text-warning { color: var(--accent-amber) !important; }
        .text-danger { color: var(--accent-rose) !important; }
        .text-info { color: var(--accent-cyan) !important; }
        .text-muted { color: var(--slate-500) !important; }
        .text-secondary { color: var(--slate-500) !important; }

        .fw-medium { font-weight: 500 !important; }
        .fw-semibold { font-weight: 600 !important; }

        .rounded-xl { border-radius: var(--radius-xl) !important; }
        .rounded-2xl { border-radius: var(--radius-2xl) !important; }

        .shadow-sm { box-shadow: var(--shadow-sm) !important; }
        .shadow-md { box-shadow: var(--shadow-md) !important; }
        .shadow-lg { box-shadow: var(--shadow-lg) !important; }

        /* RESPONSIVE */
        @media (min-width: 768px) {
            .content { padding: 2rem; }
        }

        @media (min-width: 1024px) {
            .mobile-header { display: none; }
            .sidebar { transform: translateX(0); }
            .main-content.authenticated { margin-left: var(--sidebar-width); }
            .content { padding: 2rem 2.5rem; }
        }

        @media (min-width: 1400px) {
            .content { padding: 2.5rem 3rem; }
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity var(--transition-base);
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        @media (min-width: 1024px) {
            .sidebar-overlay { display: none !important; }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in { animation: fadeIn 0.3s ease-out forwards; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--slate-100); }
        ::-webkit-scrollbar-thumb { background: var(--slate-300); border-radius: var(--radius-full); }
        ::-webkit-scrollbar-thumb:hover { background: var(--slate-400); }

        /* List Group */
        .list-group-item {
            border: none;
            border-bottom: 1px solid var(--slate-100);
            padding: 1rem 0;
        }

        .list-group-item:last-child { border-bottom: none; }

        .list-group-item-action:hover {
            background: var(--slate-50);
        }

        /* ========================================
           ADMIN PAGE STYLES
        ======================================== */
        
        /* CSS Variable Aliases */
        :root {
            --gray-50: var(--slate-50);
            --gray-100: var(--slate-100);
            --gray-200: var(--slate-200);
            --gray-300: var(--slate-300);
            --gray-400: var(--slate-400);
            --gray-500: var(--slate-500);
            --gray-600: var(--slate-600);
            --gray-700: var(--slate-700);
            --gray-800: var(--slate-800);
            --gray-900: var(--slate-900);
            
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: 1.875rem;
        }

        /* Admin Content */
        .admin-content {
            animation: fadeIn 0.3s ease-out;
        }

        /* Page Header Modern */
        .page-header-modern {
            margin-bottom: var(--space-6);
            padding-bottom: var(--space-4);
            border-bottom: 1px solid var(--slate-200);
        }

        .page-header-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: var(--space-4);
        }

        .page-title-section {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .page-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: var(--shadow-md);
        }

        .page-title {
            font-size: var(--text-2xl);
            font-weight: 700;
            color: var(--slate-900);
            margin: 0;
        }

        .page-subtitle {
            font-size: var(--text-sm);
            color: var(--slate-500);
            margin: var(--space-1) 0 0 0;
        }

        /* Breadcrumb Modern */
        .breadcrumb-modern {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: var(--text-sm);
        }

        .breadcrumb-modern a {
            color: var(--slate-500);
            text-decoration: none;
            transition: color var(--transition-base);
        }

        .breadcrumb-modern a:hover {
            color: var(--primary-600);
        }

        .breadcrumb-modern .separator {
            color: var(--slate-300);
        }

        .breadcrumb-modern .current {
            color: var(--slate-700);
            font-weight: 500;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: var(--space-4);
            margin-bottom: var(--space-6);
        }

        /* Stat Cards Extended */
        .stat-card-primary { --stat-color: var(--primary-500); --stat-color-light: var(--primary-400); }
        .stat-card-success { --stat-color: var(--accent-emerald); --stat-color-light: #34d399; }
        .stat-card-warning { --stat-color: var(--accent-amber); --stat-color-light: #fbbf24; }
        .stat-card-danger { --stat-color: var(--accent-rose); --stat-color-light: #fb7185; }
        .stat-card-info { --stat-color: var(--accent-cyan); --stat-color-light: #22d3ee; }
        .stat-card-violet { --stat-color: var(--accent-violet); --stat-color-light: #a78bfa; }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--stat-color), var(--stat-color-light));
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: var(--space-3);
        }

        .stat-card .stat-content {
            display: flex;
            flex-direction: column;
        }

        .stat-card .stat-value {
            font-size: var(--text-2xl);
            font-weight: 700;
            color: var(--slate-900);
        }

        .stat-card .stat-label {
            font-size: var(--text-sm);
            color: var(--slate-500);
        }

        /* Content Card */
        .content-card {
            background: white;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            margin-bottom: var(--space-6);
            overflow: hidden;
        }

        .card-header-modern {
            padding: var(--space-4) var(--space-5);
            background: linear-gradient(180deg, var(--slate-50) 0%, white 100%);
            border-bottom: 1px solid var(--slate-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: var(--space-3);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .card-header-modern .card-title {
            font-size: var(--text-base);
            font-weight: 600;
            color: var(--slate-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .card-body-modern {
            padding: var(--space-5);
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: var(--slate-900);
            font-size: var(--text-sm);
        }

        .user-email {
            font-size: var(--text-xs);
            color: var(--slate-500);
        }

        /* Avatar Variants */
        .avatar-primary {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600)) !important;
        }

        .avatar-secondary {
            background: linear-gradient(135deg, var(--slate-500), var(--slate-600)) !important;
        }

        .avatar-success {
            background: linear-gradient(135deg, var(--accent-emerald), #059669) !important;
        }

        .avatar-warning {
            background: linear-gradient(135deg, var(--accent-amber), #d97706) !important;
        }

        .avatar-danger {
            background: linear-gradient(135deg, var(--accent-rose), #dc2626) !important;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .btn-action {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-lg);
            border: none;
            cursor: pointer;
            transition: all var(--transition-base);
            text-decoration: none;
        }

        .btn-action-primary {
            background: var(--primary-50);
            color: var(--primary-600);
        }

        .btn-action-primary:hover {
            background: var(--primary-100);
            color: var(--primary-700);
        }

        .btn-action-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-emerald);
        }

        .btn-action-success:hover {
            background: rgba(16, 185, 129, 0.2);
        }

        .btn-action-warning {
            background: rgba(245, 158, 11, 0.1);
            color: var(--accent-amber);
        }

        .btn-action-warning:hover {
            background: rgba(245, 158, 11, 0.2);
        }

        .btn-action-danger {
            background: rgba(244, 63, 94, 0.1);
            color: var(--accent-rose);
        }

        .btn-action-danger:hover {
            background: rgba(244, 63, 94, 0.2);
        }

        .btn-action-info {
            background: rgba(6, 182, 212, 0.1);
            color: var(--accent-cyan);
        }

        .btn-action-info:hover {
            background: rgba(6, 182, 212, 0.2);
        }

        .btn-action-secondary {
            background: var(--slate-100);
            color: var(--slate-600);
        }

        .btn-action-secondary:hover {
            background: var(--slate-200);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: var(--space-12) var(--space-6);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: var(--slate-100);
            border-radius: var(--radius-2xl);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-4);
            color: var(--slate-400);
        }

        .empty-state h3 {
            font-size: var(--text-lg);
            font-weight: 600;
            color: var(--slate-700);
            margin: 0 0 var(--space-2) 0;
        }

        .empty-state p {
            color: var(--slate-500);
            margin: 0 0 var(--space-4) 0;
        }

        /* Pagination Wrapper */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            padding-top: var(--space-4);
            border-top: 1px solid var(--slate-100);
            margin-top: var(--space-4);
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-3);
            padding: var(--space-4);
            background: var(--slate-50);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-4);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: var(--space-1);
        }

        .filter-label {
            font-size: var(--text-xs);
            font-weight: 600;
            color: var(--slate-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Detail Grid */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--space-6);
        }

        .detail-section {
            background: var(--slate-50);
            border-radius: var(--radius-lg);
            padding: var(--space-5);
        }

        .detail-section-title {
            font-size: var(--text-sm);
            font-weight: 600;
            color: var(--slate-700);
            margin-bottom: var(--space-4);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--slate-200);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: var(--text-sm);
            color: var(--slate-500);
        }

        .detail-value {
            font-size: var(--text-sm);
            font-weight: 600;
            color: var(--slate-900);
        }

        /* Info Cards */
        .info-card {
            background: white;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-lg);
            padding: var(--space-4);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .info-card-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-card-content {
            flex: 1;
        }

        .info-card-label {
            font-size: var(--text-xs);
            color: var(--slate-500);
        }

        .info-card-value {
            font-size: var(--text-base);
            font-weight: 600;
            color: var(--slate-900);
        }

        /* Tab Navigation */
        .tab-nav {
            display: flex;
            gap: var(--space-1);
            border-bottom: 1px solid var(--slate-200);
            margin-bottom: var(--space-4);
        }

        .tab-nav-item {
            padding: var(--space-3) var(--space-4);
            font-size: var(--text-sm);
            font-weight: 500;
            color: var(--slate-500);
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: all var(--transition-base);
        }

        .tab-nav-item:hover {
            color: var(--primary-600);
        }

        .tab-nav-item.active {
            color: var(--primary-600);
            border-bottom-color: var(--primary-600);
        }

        /* Activity Timeline */
        .activity-timeline {
            position: relative;
            padding-left: var(--space-6);
        }

        .activity-timeline::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--slate-200);
        }

        .activity-item {
            position: relative;
            padding-bottom: var(--space-4);
        }

        .activity-item::before {
            content: '';
            position: absolute;
            left: calc(-1 * var(--space-6) + 8px);
            top: 4px;
            width: 8px;
            height: 8px;
            background: var(--primary-500);
            border-radius: 50%;
            border: 2px solid white;
        }

        .activity-content {
            background: var(--slate-50);
            border-radius: var(--radius-md);
            padding: var(--space-3);
        }

        .activity-title {
            font-size: var(--text-sm);
            font-weight: 500;
            color: var(--slate-900);
        }

        .activity-time {
            font-size: var(--text-xs);
            color: var(--slate-500);
        }

        /* Settings Form */
        .settings-section {
            background: white;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-lg);
            padding: var(--space-5);
            margin-bottom: var(--space-4);
        }

        .settings-section-title {
            font-size: var(--text-base);
            font-weight: 600;
            color: var(--slate-900);
            margin-bottom: var(--space-4);
            padding-bottom: var(--space-3);
            border-bottom: 1px solid var(--slate-200);
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: var(--space-3) 0;
            border-bottom: 1px solid var(--slate-100);
        }

        .setting-item:last-child {
            border-bottom: none;
        }

        .setting-info {
            flex: 1;
        }

        .setting-label {
            font-size: var(--text-sm);
            font-weight: 500;
            color: var(--slate-700);
        }

        .setting-description {
            font-size: var(--text-xs);
            color: var(--slate-500);
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            width: 48px;
            height: 24px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--slate-300);
            transition: var(--transition-base);
            border-radius: var(--radius-full);
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: var(--transition-base);
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary-500);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(24px);
        }

        /* Profile Section */
        .profile-header {
            display: flex;
            align-items: center;
            gap: var(--space-5);
            padding: var(--space-6);
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: var(--radius-xl);
            color: white;
            margin-bottom: var(--space-6);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: var(--radius-xl);
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--text-3xl);
            font-weight: 700;
        }

        .profile-info h2 {
            margin: 0 0 var(--space-1) 0;
            font-size: var(--text-xl);
        }

        .profile-info p {
            margin: 0;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .page-header-content {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-title-section {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }
            
            .detail-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
            
            .filter-section {
                flex-direction: column;
            }
        }

        /* Btn Secondary */
        .btn-secondary {
            background: var(--slate-100);
            color: var(--slate-700);
            border: 1px solid var(--slate-200);
        }

        .btn-secondary:hover {
            background: var(--slate-200);
            color: var(--slate-800);
        }

        /* MS-1 helper */
        .ms-1 { margin-left: 0.25rem; }
        .ms-2 { margin-left: 0.5rem; }
        .me-1 { margin-right: 0.25rem; }
        .me-2 { margin-right: 0.5rem; }

        /* ========================================
           PAGE HEADER STYLES
        ======================================== */
        .page-header {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            color: white;
            padding: 1.5rem;
            margin: 0;
            box-shadow: var(--shadow-lg);
            position: relative;
            z-index: 10;
        }

        .page-header .container-fluid {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0;
        }

        .page-header .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .page-header .page-description {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9rem;
            margin: 0;
        }
        
        @media (min-width: 768px) {
            .page-header { padding: 1.75rem 2rem; }
            .page-header .page-title { font-size: 1.75rem; }
        }
        
        @media (min-width: 1024px) {
            .page-header { padding: 2rem 2.5rem; }
        }
        
        @media (min-width: 1400px) {
            .page-header { padding: 2rem 3rem; }
        }

        /* Title Icon in Page Header */
        .page-header .title-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: var(--radius-lg);
            margin-right: 0.875rem;
            backdrop-filter: blur(10px);
        }

        @media (min-width: 768px) {
            .page-header .title-icon {
                width: 48px;
                height: 48px;
                margin-right: 1rem;
            }
        }

        /* Header Actions */
        .page-header .header-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        /* Breadcrumb in Page Header */
        .page-header .breadcrumb-modern {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.85rem;
        }

        .page-header .breadcrumb-modern .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .page-header .breadcrumb-modern .breadcrumb-item a:hover {
            color: white;
        }

        .page-header .breadcrumb-modern .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.9);
        }

        .page-header .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Badge Glass in Page Header */
        .page-header .badge-glass,
        .badge-glass {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .bg-success-glass {
            background: rgba(16, 185, 129, 0.3) !important;
        }

        .page-header .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
        }

        .page-header .page-description {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
        }

        /* Subtle Background Colors */
        .bg-primary-subtle { background-color: rgba(99, 102, 241, 0.1) !important; }
        .bg-success-subtle { background-color: rgba(16, 185, 129, 0.1) !important; }
        .bg-warning-subtle { background-color: rgba(245, 158, 11, 0.1) !important; }
        .bg-danger-subtle { background-color: rgba(239, 68, 68, 0.1) !important; }
        .bg-info-subtle { background-color: rgba(6, 182, 212, 0.1) !important; }
        .bg-secondary-subtle { background-color: rgba(100, 116, 139, 0.1) !important; }

        /* Text Colors with subtle bg */
        .text-primary { color: var(--primary) !important; }
        .text-success { color: var(--success) !important; }
        .text-warning { color: var(--warning) !important; }
        .text-danger { color: var(--danger) !important; }
        .text-info { color: var(--info) !important; }

        /* Min Width Helper */
        .min-w-0 { min-width: 0; }

        /* Card Modern Extended */
        .card-modern {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .card-header-modern {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            background: transparent;
            border-bottom: 1px solid var(--border-light);
        }

        .card-header-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background: var(--primary-soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .card-header-content .card-title {
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .card-header-content .card-subtitle {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* List Group Modern */
        .list-group-modern .list-group-item {
            padding: 1rem 1.5rem;
            border: none;
            border-bottom: 1px solid var(--border-light);
            background: transparent;
            transition: background 0.2s ease;
        }

        .list-group-modern .list-group-item:hover {
            background: rgba(99, 102, 241, 0.03);
        }

        .list-group-modern .list-group-item:last-child {
            border-bottom: none;
        }

        /* Title Icon */
        .title-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.15);
            border-radius: var(--radius-lg);
            margin-right: 1rem;
        }

        /* Badge Glass */
        .badge-glass {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            color: white;
            font-weight: 500;
        }

        /* Breadcrumb Modern Override */
        .breadcrumb-modern {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-modern .breadcrumb-item a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
        }

        .breadcrumb-modern .breadcrumb-item a:hover {
            color: white;
        }

        .breadcrumb-modern .breadcrumb-item.active {
            color: rgba(255,255,255,0.9);
        }

        .breadcrumb-modern .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.5);
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    @auth
    <div class="mobile-header">
        <button class="mobile-menu-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <a href="{{ route('welcome') }}" class="mobile-brand">
            <i class="fas fa-calendar-alt"></i>
            <span>TemuEvent</span>
        </a>
        <div style="width: 44px;"></div>
    </div>
    @endauth

    @auth
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('welcome') }}" class="sidebar-brand">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="sidebar-brand-text">TemuEvent</span>
                </a>
            </div>
            <nav class="sidebar-nav">
                @if(auth()->user()->isAdmin())
                    @include('components.sidebar-admin-v2')
                @elseif(auth()->user()->isEventOrganizer())
                    @include('components.sidebar-organizer-v2')
                @else
                    @include('components.sidebar-user-v2')
                @endif
            </nav>
            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="sidebar-user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="sidebar-user-info">
                        <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                        <div class="sidebar-user-role">
                            @if(auth()->user()->isAdmin())
                                Administrator
                            @elseif(auth()->user()->isEventOrganizer())
                                Event Organizer
                            @else
                                Member
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth

    <div class="main-content {{ auth()->check() ? 'authenticated' : 'guest' }}">
        @guest
            <header class="guest-header">
                <div class="guest-header-content">
                    <a href="{{ route('welcome') }}" class="guest-brand">
                        <i class="fas fa-calendar-alt"></i>
                        <span>TemuEvent</span>
                    </a>
                    <nav class="guest-nav">
                        <a href="{{ route('events.index') }}" class="guest-nav-link">Jelajahi Event</a>
                        <a href="{{ route('login') }}" class="guest-nav-link">Masuk</a>
                        <a href="{{ route('register') }}" class="guest-nav-btn">Daftar Gratis</a>
                    </nav>
                </div>
            </header>
        @endguest

        @auth
            @hasSection('page-header')
                @yield('page-header')
            @endif
        @endauth

        <main class="content">
            <div class="content-container">
                @if(session('success'))
                    <div class="alert alert-success fade-in">
                        <i class="fas fa-check-circle"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger fade-in">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger fade-in">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        @guest
            <footer class="footer">
                <div class="footer-content">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="footer-brand">
                                <i class="fas fa-calendar-alt"></i>
                                TemuEvent
                            </div>
                            <p class="text-slate-400">Platform event terpercaya di Indonesia untuk menemukan dan mengelola acara terbaik.</p>
                        </div>
                        <div class="col-md-2 mb-4">
                            <h6 class="text-white fw-semibold mb-3">Layanan</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="{{ route('events.index') }}" class="footer-link">Jelajahi Event</a></li>
                                <li class="mb-2"><a href="#" class="footer-link">Buat Event</a></li>
                                <li><a href="#" class="footer-link">Promosi</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2 mb-4">
                            <h6 class="text-white fw-semibold mb-3">Perusahaan</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#" class="footer-link">Tentang Kami</a></li>
                                <li class="mb-2"><a href="#" class="footer-link">Karir</a></li>
                                <li><a href="#" class="footer-link">Kontak</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-4">
                            <h6 class="text-white fw-semibold mb-3">Hubungi Kami</h6>
                            <p class="mb-2"><i class="fas fa-envelope me-2"></i>info@temuevent.com</p>
                            <p class="mb-3"><i class="fas fa-phone me-2"></i>+62 21 1234 5678</p>
                            <div class="d-flex gap-3">
                                <a href="#" class="footer-link"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="#" class="footer-link"><i class="fab fa-twitter fa-lg"></i></a>
                                <a href="#" class="footer-link"><i class="fab fa-instagram fa-lg"></i></a>
                                <a href="#" class="footer-link"><i class="fab fa-linkedin fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4" style="border-color: var(--slate-700);">
                    <div class="text-center">
                        <p class="mb-0" style="color: var(--slate-500);">&copy; 2025 TemuEvent. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        @endguest
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = event.target.closest('.mobile-menu-btn');
            
            if (window.innerWidth < 1024 && sidebar) {
                if (!sidebar.contains(event.target) && !menuBtn && sidebar.classList.contains('show')) {
                    toggleSidebar();
                }
            }
        });

        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth >= 1024 && sidebar) {
                sidebar.classList.remove('show');
                if (overlay) overlay.classList.remove('show');
            }
        });

        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
