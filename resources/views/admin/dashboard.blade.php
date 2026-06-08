@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <h1 class="page-title">Dashboard</h1>
        <span class="page-date" id="dashboardDate"></span>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.castings') }}" class="btn-action">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
            </svg>
            <span>Gerer les castings</span>
        </a>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card stat-card-blue">
        <div class="stat-glow"></div>
        <div class="stat-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                <circle cx="12" cy="13" r="4"/>
            </svg>
        </div>
        <div class="stat-body">
            <span class="stat-label">Castings en attente</span>
            <span class="stat-value">{{ $castings_pending }}</span>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 0%"></div>
            </div>
        </div>
        <span class="stat-badge stat-badge-blue">En cours</span>
    </div>

    <div class="stat-card stat-card-green">
        <div class="stat-glow"></div>
        <div class="stat-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        <div class="stat-body">
            <span class="stat-label">Castings valides</span>
            <span class="stat-value">{{ $castings_sent ?? 0 }}</span>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 0%"></div>
            </div>
        </div>
        <span class="stat-badge stat-badge-green">Approuves</span>
    </div>

    <div class="stat-card stat-card-amber">
        <div class="stat-glow"></div>
        <div class="stat-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
        </div>
        <div class="stat-body">
            <span class="stat-label">Inscriptions</span>
            <span class="stat-value">{{ $subscriptions_pending }}</span>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 0%"></div>
            </div>
        </div>
        <span class="stat-badge stat-badge-amber">En attente</span>
    </div>

    <div class="stat-card stat-card-red">
        <div class="stat-glow"></div>
        <div class="stat-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>
            </svg>
        </div>
        <div class="stat-body">
            <span class="stat-label">Paiements</span>
            <span class="stat-value">{{ $payments_pending }}</span>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 0%"></div>
            </div>
        </div>
        <span class="stat-badge stat-badge-red">En attente</span>
    </div>

    <div class="stat-card stat-card-purple">
        <div class="stat-glow"></div>
        <div class="stat-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
            </svg>
        </div>
        <div class="stat-body">
            <span class="stat-label">Notifications</span>
            <span class="stat-value">{{ $notificationsCount ?? 0 }}</span>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 0%"></div>
            </div>
        </div>
        <span class="stat-badge stat-badge-purple">Non lues</span>
    </div>

    <div class="stat-card stat-card-slate">
        <div class="stat-glow"></div>
        <div class="stat-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="21 8 21 21 3 21 3 8"/><rect x="1" y="3" width="22" height="5"/><line x1="10" y1="12" x2="14" y2="12"/>
            </svg>
        </div>
        <div class="stat-body">
            <span class="stat-label">Archives</span>
            <span class="stat-value">{{ $archives_count ?? 0 }}</span>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 0%"></div>
            </div>
        </div>
        <span class="stat-badge stat-badge-slate">Stockes</span>
    </div>
</div>

<div class="dashboard-footer">
    <div class="quick-actions">
        <span class="quick-actions-label">Actions rapides</span>
        <div class="quick-actions-grid">
            <a href="{{ route('admin.castings') }}" class="quick-action">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
                <span>Nouveau casting</span>
            </a>
            <a href="{{ route('admin.subscriptions') }}" class="quick-action">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Inscriptions</span>
            </a>
            <a href="{{ route('admin.payments') }}" class="quick-action">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                </svg>
                <span>Paiements</span>
            </a>
            <a href="{{ route('admin.notifications') }}" class="quick-action">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                </svg>
                <span>Notifications</span>
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('turbo:load', function() {
    var el = document.getElementById('dashboardDate');
    if (el) {
        var now = new Date();
        var opts = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        el.textContent = now.toLocaleDateString('fr-FR', opts);
    }
});
</script>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
    gap: 16px;
    margin-bottom: 28px;
}

.stat-card {
    background: linear-gradient(145deg, rgba(20,20,20,0.95) 0%, rgba(10,10,10,0.98) 100%);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 16px;
    padding: 20px 24px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.stat-glow {
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.4s var(--ease);
    pointer-events: none;
    filter: blur(60px);
}

.stat-card:hover .stat-glow {
    opacity: 0.12;
}

.stat-card-blue .stat-glow { background: #3b82f6; }
.stat-card-green .stat-glow { background: #10b981; }
.stat-card-amber .stat-glow { background: #f59e0b; }
.stat-card-red .stat-glow { background: #e50914; }
.stat-card-purple .stat-glow { background: #8b5cf6; }
.stat-card-slate .stat-glow { background: #94a3b8; }

.stat-card:hover {
    transform: translateY(-4px);
    border-color: rgba(229,9,20,0.2);
    box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 40px rgba(229,9,20,0.08);
}

.stat-card-blue:hover { border-color: rgba(59,130,246,0.25); box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 40px rgba(59,130,246,0.08); }
.stat-card-green:hover { border-color: rgba(16,185,129,0.25); box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 40px rgba(16,185,129,0.08); }
.stat-card-amber:hover { border-color: rgba(245,158,11,0.25); box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 40px rgba(245,158,11,0.08); }
.stat-card-red:hover { border-color: rgba(229,9,20,0.25); box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 40px rgba(229,9,20,0.08); }
.stat-card-purple:hover { border-color: rgba(139,92,246,0.25); box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 40px rgba(139,92,246,0.08); }
.stat-card-slate:hover { border-color: rgba(148,163,184,0.25); box-shadow: 0 8px 30px rgba(0,0,0,0.5), 0 0 40px rgba(148,163,184,0.08); }

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
}

.stat-card-blue .stat-icon { background: linear-gradient(135deg, rgba(59,130,246,0.2), rgba(59,130,246,0.05)); color: #60a5fa; }
.stat-card-green .stat-icon { background: linear-gradient(135deg, rgba(16,185,129,0.2), rgba(16,185,129,0.05)); color: #34d399; }
.stat-card-amber .stat-icon { background: linear-gradient(135deg, rgba(245,158,11,0.2), rgba(245,158,11,0.05)); color: #fbbf24; }
.stat-card-red .stat-icon { background: linear-gradient(135deg, rgba(229,9,20,0.2), rgba(229,9,20,0.05)); color: var(--red); }
.stat-card-purple .stat-icon { background: linear-gradient(135deg, rgba(139,92,246,0.2), rgba(139,92,246,0.05)); color: #a78bfa; }
.stat-card-slate .stat-icon { background: linear-gradient(135deg, rgba(148,163,184,0.15), rgba(148,163,184,0.04)); color: #94a3b8; }

.stat-body {
    display: flex;
    flex-direction: column;
    gap: 4px;
    flex: 1;
    min-width: 0;
}

.stat-label {
    font-size: 12px;
    font-weight: 500;
    color: var(--text-dim);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 30px;
    font-weight: 800;
    color: #fff;
    line-height: 1.1;
    letter-spacing: -0.5px;
}

.stat-progress {
    width: 100%;
    height: 3px;
    background: rgba(255,255,255,0.04);
    border-radius: 2px;
    margin-top: 6px;
    overflow: hidden;
}

.stat-progress-bar {
    height: 100%;
    border-radius: 2px;
    transition: width 0.8s var(--ease);
}

.stat-card-blue .stat-progress-bar { background: #3b82f6; }
.stat-card-green .stat-progress-bar { background: #10b981; }
.stat-card-amber .stat-progress-bar { background: #f59e0b; }
.stat-card-red .stat-progress-bar { background: #e50914; }
.stat-card-purple .stat-progress-bar { background: #8b5cf6; }
.stat-card-slate .stat-progress-bar { background: #94a3b8; }

.stat-badge {
    position: absolute;
    top: 12px;
    right: 16px;
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 3px 12px;
    border-radius: 20px;
}

.stat-badge-blue { color: #60a5fa; background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.15); }
.stat-badge-green { color: #34d399; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.15); }
.stat-badge-amber { color: #fbbf24; background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.15); }
.stat-badge-red { color: var(--red); background: rgba(229,9,20,0.1); border: 1px solid rgba(229,9,20,0.15); }
.stat-badge-purple { color: #a78bfa; background: rgba(139,92,246,0.1); border: 1px solid rgba(139,92,246,0.15); }
.stat-badge-slate { color: #94a3b8; background: rgba(148,163,184,0.08); border: 1px solid rgba(148,163,184,0.12); }

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 12px;
}

.page-header-left {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.page-date {
    font-size: 12px;
    color: var(--text-dim);
    font-weight: 400;
}

.page-header-actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    background: linear-gradient(135deg, rgba(229,9,20,0.12), rgba(229,9,20,0.04));
    border: 1px solid rgba(229,9,20,0.2);
    border-radius: 10px;
    color: var(--red);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s var(--ease);
}

.btn-action:hover {
    background: linear-gradient(135deg, rgba(229,9,20,0.2), rgba(229,9,20,0.08));
    border-color: rgba(229,9,20,0.35);
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(229,9,20,0.2);
}

.dashboard-footer {
    margin-top: 4px;
}

.quick-actions {
    background: rgba(20,20,20,0.6);
    border: 1px solid var(--glass-border);
    border-radius: 16px;
    padding: 20px 24px;
}

.quick-actions-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: var(--text-dim);
    display: block;
    margin-bottom: 14px;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 10px;
}

.quick-action {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: var(--glass);
    border: 1px solid var(--glass-border);
    border-radius: 10px;
    color: var(--text-dim);
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.2s var(--ease);
}

.quick-action:hover {
    background: var(--glass-hover);
    color: var(--text);
    border-color: rgba(255,255,255,0.12);
    transform: translateY(-2px);
}

.quick-action svg {
    flex-shrink: 0;
    opacity: 0.6;
    transition: opacity 0.2s var(--ease);
}

.quick-action:hover svg {
    opacity: 1;
    color: var(--red);
}

@media (max-width: 600px) {
    .stats-grid { grid-template-columns: 1fr; }
    .quick-actions-grid { grid-template-columns: 1fr 1fr; }
    .page-header { flex-direction: column; align-items: flex-start; }
    .btn-action { width: 100%; justify-content: center; }
}
</style>

@endsection
