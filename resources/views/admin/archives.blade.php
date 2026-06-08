@extends('admin.layouts.admin')

@section('content')

<div class="page-header">
    <h2 class="page-title">Archives</h2>
    <div class="page-actions">
        @if(session('success'))
            <div class="alert alert-success" style="margin:0">{{ session('success') }}</div>
        @endif
        <form action="{{ route('admin.archives.run') }}" method="POST" style="display:inline">
            @csrf
            <button type="submit" class="btn-archive-run">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-3-7.55"/></svg>
                Archiver maintenant
            </button>
        </form>
    </div>
</div>

<div class="archive-box">
    <p class="archive-text">
        Castings, inscriptions et paiements archivés automatiquement après traitement.
    </p>

    <div class="archive-grid">

        <div class="archive-card casting">
            <div class="archive-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><path d="M8 21h8"/><path d="M12 17v4"/></svg>
            </div>
            <h3>Castings archivés</h3>
            <p class="archive-number">{{ $castings->count() ?? 0 }}</p>
        </div>

        <div class="archive-card subscription">
            <div class="archive-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><path d="M20 8v6"/><path d="M23 11h-6"/></svg>
            </div>
            <h3>Inscriptions archivées</h3>
            <p class="archive-number">{{ $subscriptions->count() ?? 0 }}</p>
        </div>

        <div class="archive-card payment">
            <div class="archive-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
            </div>
            <h3>Paiements archivés</h3>
            <p class="archive-number">{{ $payments->count() ?? 0 }}</p>
        </div>

    </div>
</div>

@endsection

<style>
* {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.page-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
}

.archive-box {
    background: linear-gradient(145deg, rgba(20,20,20,0.95), rgba(10,10,10,0.98));
    border: 1px solid rgba(255,255,255,0.06);
    padding: 24px;
    border-radius: 16px;
}

.archive-text {
    color: #808080;
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 1.6;
}

.archive-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
}

.archive-card {
    padding: 24px 20px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.06);
    color: #ffffff;
    text-align: center;
    transition: all 0.2s ease;
    cursor: default;
}

.archive-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.4);
}

.archive-icon {
    display: flex;
    justify-content: center;
    margin-bottom: 12px;
    opacity: 0.85;
}

.archive-card h3 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.3px;
    color: #ffffff;
}

.archive-number {
    font-size: 32px;
    margin-top: 8px;
    font-weight: 700;
    letter-spacing: -0.5px;
}

.casting {
    background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(37,99,235,0.08));
}

.subscription {
    background: linear-gradient(135deg, rgba(16,185,129,0.15), rgba(5,150,105,0.08));
}

.payment {
    background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(217,119,6,0.08));
}

.btn-archive-run {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border: 1px solid rgba(16,185,129,0.2);
    border-radius: 8px;
    background: rgba(16,185,129,0.08);
    color: #34d399;
    font-size: 12px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.2s ease;
}
.btn-archive-run:hover {
    background: rgba(16,185,129,0.15);
    box-shadow: 0 0 20px rgba(16,185,129,0.1);
}
</style>
