<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Casting.net</title>
    <meta name="turbo-cache-control" content="no-cache">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/@hotwired/turbo@8.0.4/dist/turbo.es2017-umd.js" crossorigin="anonymous"></script>
</head>

<body>

<div class="app">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('img/castinglogo.svg') }}" alt="Casting.net">
            </div>
            <span class="sidebar-brand-text">CASTING<span class="sidebar-brand-accent">.NET</span></span>
        </div>

        <nav class="sidebar-nav">
            <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <div class="nav-label">Gestion</div>

            <a class="nav-item {{ request()->routeIs('admin.castings*') ? 'active' : '' }}"
               href="{{ route('admin.castings') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                    <circle cx="12" cy="13" r="4"/>
                </svg>
                <span>Castings</span>
            </a>

            <a class="nav-item {{ request()->routeIs('admin.subscriptions*') ? 'active' : '' }}"
               href="{{ route('admin.subscriptions') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Inscriptions</span>
            </a>

            <a class="nav-item {{ request()->routeIs('admin.payments*') ? 'active' : '' }}"
               href="{{ route('admin.payments') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
                <span>Paiements</span>
            </a>

            <div class="nav-label">Historique</div>

            <a class="nav-item {{ request()->routeIs('admin.history.castings*') ? 'active' : '' }}"
               href="{{ route('admin.history.castings') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <span>Hist. Castings</span>
            </a>

            <a class="nav-item {{ request()->routeIs('admin.history.subscriptions*') ? 'active' : '' }}"
               href="{{ route('admin.history.subscriptions') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
                <span>Hist. Inscriptions</span>
            </a>

            <div class="nav-label">Systeme</div>

            <a class="nav-item {{ request()->routeIs('admin.archives*') ? 'active' : '' }}"
               href="{{ route('admin.archives') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/>
                </svg>
                <span>Archives</span>
            </a>

            <a class="nav-item {{ request()->routeIs('admin.notifications*') ? 'active' : '' }}"
               href="{{ route('admin.notifications') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                <span>Notifications</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST" data-turbo="false">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span>Deconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button class="topbar-toggle" id="sidebarToggle" aria-label="Menu" type="button">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                <span class="topbar-current">@yield('title', 'Dashboard')</span>
            </div>

            <div class="topbar-search">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" class="topbar-search-input" placeholder="Rechercher...">
            </div>

            <div class="topbar-infos">
                <a href="{{ route('admin.notifications') }}" class="topbar-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    @if(($notificationsCount ?? 0) > 0)
                        <span class="notif-count">{{ $notificationsCount }}</span>
                    @endif
                </a>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </main>
</div>

<div class="grain"></div>

<style>
:root {
    --red: #e50914;
    --red-dark: #b20710;
    --red-glow: rgba(229, 9, 20, 0.3);
    --bg: #0a0a0a;
    --elevated: #141414;
    --glass: rgba(255,255,255,0.03);
    --glass-border: rgba(255,255,255,0.06);
    --glass-hover: rgba(255,255,255,0.06);
    --text: #ffffff;
    --text-dim: #808080;
    --text-muted: #9ca3af;
    --radius: 12px;
    --radius-card: 16px;
    --shadow: 0 2px 8px rgba(0,0,0,0.3);
    --shadow-md: 0 4px 20px rgba(0,0,0,0.5);
    --shadow-glow: 0 0 30px rgba(229, 9, 20, 0.3);
    --ease: cubic-bezier(0.4, 0, 0.2, 1);
    --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    --font-heading: 'EB Garamond', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', serif;
}

*, *::before, *::after { box-sizing: border-box; }

body {
    margin: 0;
    font-family: var(--font);
    background: var(--bg);
    color: var(--text);
    -webkit-font-smoothing: antialiased;
    overflow: hidden;
}

.grain {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 9999;
    opacity: 0.03;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-repeat: repeat;
    background-size: 256px 256px;
}

.app {
    display: flex;
    height: 100vh;
}

/* ===========================
   SIDEBAR
   =========================== */
.sidebar {
    width: 260px;
    background: var(--elevated);
    border-right: 1px solid var(--glass-border);
    display: flex;
    flex-direction: column;
    flex-shrink: 0;
    position: relative;
    z-index: 10;
}

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 0.65rem;
    padding: 20px 20px 16px;
    position: relative;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.sidebar-brand:hover {
    transform: scale(1.05);
}

.sidebar-brand-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    overflow: hidden;
    flex-shrink: 0;
}

.sidebar-brand-icon img {
    width: 200%;
    height: 200%;
    object-fit: contain;
    transform: scale(2);
    filter: brightness(0) saturate(100%) invert(13%) sepia(94%) saturate(7466%) hue-rotate(356deg) brightness(91%) contrast(119%) drop-shadow(0 0 0.5px #e50914) drop-shadow(0 0 0.5px #e50914);
}

.sidebar-brand-text {
    font-size: 1.2rem;
    font-weight: 900;
    color: #fff;
    letter-spacing: -0.5px;
}

.sidebar-brand-accent {
    color: #e50914;
}

.sidebar-nav {
    flex: 1;
    padding: 8px 12px;
    display: flex;
    flex-direction: column;
    gap: 1px;
    overflow-y: auto;
}

.nav-label {
    font-size: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: var(--text-dim);
    padding: 16px 14px 6px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 9px 14px;
    border-radius: 8px;
    color: var(--text-dim);
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s var(--ease);
    position: relative;
}

.nav-item:hover {
    color: var(--text);
    background: var(--glass-hover);
}

.nav-item.active {
    color: #fff;
    background: linear-gradient(135deg, rgba(229,9,20,0.15), rgba(229,9,20,0.05));
    font-weight: 600;
}

.nav-item.active::before {
    content: '';
    position: absolute;
    left: -12px;
    top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 20px;
    border-radius: 0 3px 3px 0;
    background: var(--red);
    box-shadow: 0 0 10px var(--red-glow);
}

.nav-item svg { flex-shrink: 0; opacity: 0.6; }
.nav-item.active svg { opacity: 1; color: var(--red); }
.nav-item:hover svg { opacity: 0.9; }

.sidebar-footer {
    padding: 12px;
    border-top: 1px solid var(--glass-border);
}

.btn-logout {
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 9px 14px;
    border: none;
    border-radius: 8px;
    background: transparent;
    color: var(--text-dim);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s var(--ease);
    font-family: inherit;
}

.btn-logout:hover {
    color: var(--red);
    background: rgba(229,9,20,0.08);
}

.btn-logout svg { flex-shrink: 0; }

/* ===========================
   MAIN
   =========================== */
.main {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-width: 0;
    background: var(--bg);
    position: relative;
}

.topbar {
    background: rgba(20,20,20,0.8);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    padding: 14px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--glass-border);
    position: sticky;
    top: 0;
    z-index: 50;
}

.topbar-left {
    display: flex;
    align-items: center;
}

.topbar-current {
    color: var(--text);
    font-weight: 600;
    font-size: 15px;
}

.topbar-search {
    flex: 1;
    max-width: 360px;
    margin: 0 24px;
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 10px;
    padding: 0 14px;
    transition: all 0.2s ease;
}

.topbar-search:focus-within {
    border-color: rgba(229,9,20,0.3);
    background: rgba(229,9,20,0.03);
    box-shadow: 0 0 0 3px rgba(229,9,20,0.06);
}

.topbar-search svg {
    color: var(--text-dim);
    flex-shrink: 0;
}

.topbar-search:focus-within svg {
    color: var(--red);
}

.topbar-search-input {
    flex: 1;
    padding: 9px 0;
    border: none;
    background: transparent;
    font-size: 13px;
    font-family: inherit;
    color: #fff;
    outline: none;
}

.topbar-search-input::placeholder {
    color: var(--text-dim);
    opacity: 0.5;
}

.topbar-infos { display: flex; align-items: center; gap: 12px; }

.topbar-btn {
    position: relative;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--glass);
    border: 1px solid var(--glass-border);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-dim);
    cursor: pointer;
    transition: all 0.2s var(--ease);
    text-decoration: none;
}

.topbar-btn:hover {
    background: var(--glass-hover);
    color: var(--text);
    border-color: rgba(255,255,255,0.12);
}

.notif-count {
    position: absolute;
    top: -3px;
    right: -3px;
    background: var(--red);
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    min-width: 16px;
    height: 16px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
}

/* ===========================
   CONTENT
   =========================== */
.content {
    padding: 28px;
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
    animation: fadeSlideIn 0.25s ease both;
}

@keyframes fadeSlideIn {
    from { opacity: 0; transform: translateY(6px); }
    to   { opacity: 1; transform: translateY(0); }
}

.content::-webkit-scrollbar { width: 6px; }
.content::-webkit-scrollbar-track { background: transparent; }
.content::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }
.content::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.15); }

/* ===========================
   FONT HEADINGS
   =========================== */
.page-title,
h1, h2, h3, h4, h5, h6,
.sidebar-brand-text,
.stat-value,
.table-card-header h3 {
    font-family: var(--font-heading);
}

.page-title {
    font-weight: 700;
}

/* ===========================
   SIDEBAR TOGGLE
   =========================== */
.topbar-toggle {
    display: none;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--glass);
    border: 1px solid var(--glass-border);
    color: var(--text-dim);
    cursor: pointer;
    align-items: center;
    justify-content: center;
    transition: all 0.2s var(--ease);
    flex-shrink: 0;
    padding: 0;
    margin-right: 8px;
}

.topbar-toggle:hover {
    background: var(--glass-hover);
    color: var(--text);
    border-color: rgba(255,255,255,0.12);
}

/* ===========================
   SIDEBAR OVERLAY
   =========================== */
.sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    z-index: 9;
    opacity: 0;
    transition: opacity 0.3s var(--ease);
}

.sidebar-overlay.visible {
    opacity: 1;
}

/* ===========================
   ENTRY ANIMATIONS
   =========================== */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { opacity: 0; transform: scale(0.92); }
    to   { opacity: 1; transform: scale(1); }
}

.page-header {
    animation: fadeUp 0.4s var(--ease) both;
}

.stat-card {
    animation: fadeUp 0.5s var(--ease) both;
}

.stat-card:nth-child(1) { animation-delay: 0.05s; }
.stat-card:nth-child(2) { animation-delay: 0.10s; }
.stat-card:nth-child(3) { animation-delay: 0.15s; }
.stat-card:nth-child(4) { animation-delay: 0.20s; }
.stat-card:nth-child(5) { animation-delay: 0.25s; }
.stat-card:nth-child(6) { animation-delay: 0.30s; }

/* ===========================
   RESPONSIVE
   =========================== */
@media (max-width: 768px) {
    .topbar-toggle {
        display: flex;
    }

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        z-index: 100;
        transform: translateX(-100%);
        transition: transform 0.3s var(--ease);
        width: 280px;
    }

    .sidebar.open {
        transform: translateX(0);
    }

    .sidebar-overlay {
        display: block;
        pointer-events: none;
    }

    .sidebar-overlay.visible {
        pointer-events: auto;
    }

    .sidebar-brand {
        padding: 20px 20px 16px;
    }

    .sidebar-brand-text,
    .sidebar-brand-accent {
        display: inline;
    }

    .nav-item span,
    .btn-logout span,
    .nav-label {
        display: inline;
    }

    .nav-item {
        justify-content: flex-start;
        padding: 9px 14px;
    }

    .nav-item.active::before {
        display: block;
    }

    .sidebar-footer {
        display: block;
        padding: 12px;
    }

    .btn-logout {
        justify-content: flex-start;
        padding: 9px 14px;
    }

    .app {
        flex-direction: column;
    }

    .main {
        margin-left: 0;
        width: 100%;
    }

    .content {
        padding: 20px 16px;
    }

    .topbar {
        padding: 12px 16px;
        gap: 12px;
    }

    .topbar-search {
        display: none;
    }

    body.sidebar-open {
        overflow: hidden;
    }
}

/* ===========================
   UTILITY - réutilisable dans les vues enfants
   =========================== */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.page-title {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    letter-spacing: -0.3px;
}

.page-count {
    font-size: 12px;
    background: var(--glass);
    border: 1px solid var(--glass-border);
    color: var(--text-dim);
    padding: 4px 14px;
    border-radius: 20px;
    font-weight: 500;
}

.alert {
    padding: 12px 16px;
    border-radius: var(--radius);
    margin-bottom: 16px;
    font-size: 13px;
    font-weight: 500;
}

.alert-success {
    background: rgba(16,185,129,0.1);
    color: #10b981;
    border: 1px solid rgba(16,185,129,0.2);
}

.table-card {
    background: var(--elevated);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-card);
    overflow: hidden;
}

.table-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--glass-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-card-header h3 {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    color: var(--text);
}

.table-scroll {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.admin-table thead {
    background: rgba(255,255,255,0.02);
}

.admin-table th {
    padding: 12px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: var(--text-dim);
    white-space: nowrap;
    border-bottom: 1px solid var(--glass-border);
}

.admin-table td {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.03);
    vertical-align: middle;
    color: var(--text-muted);
}

.admin-table tbody tr {
    transition: background 0.15s var(--ease);
}

.admin-table tbody tr:hover {
    background: rgba(255,255,255,0.02);
}

.admin-table tbody tr:last-child td {
    border-bottom: none;
}
</style>


<script>
document.addEventListener('turbo:load', function() {
    // Sidebar toggle
    var toggle = document.getElementById('sidebarToggle');
    var sidebar = document.querySelector('.sidebar');
    var overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('visible');
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('visible');
        document.body.classList.remove('sidebar-open');
    }

    if (toggle && sidebar && overlay) {
        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        overlay.addEventListener('click', closeSidebar);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });

        // Close on nav link click (Turbo navigation)
        sidebar.querySelectorAll('.nav-item').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    closeSidebar();
                }
            });
        });

        // Reset on resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });
    }

    // Notification polling
    var poll = setInterval(function() {
        fetch('{{ route("admin.notifications.count") }}')
            .then(function(r) { return r.json() })
            .then(function(d) {
                var badge = document.querySelector('.notif-count');
                if (badge) {
                    badge.textContent = d.count;
                    badge.style.display = d.count > 0 ? 'flex' : 'none';
                } else if (d.count > 0) {
                    var btn = document.querySelector('.topbar-btn');
                    if (btn) {
                        var b = document.createElement('span');
                        b.className = 'notif-count';
                        b.textContent = d.count;
                        btn.appendChild(b);
                    }
                }
            })
            .catch(function() {});
    }, 30000);

    document.addEventListener('turbo:before-cache', function() {
        clearInterval(poll);
    });
});
</script>

</body>
</html>
