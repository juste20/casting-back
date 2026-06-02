@extends('admin.layouts.admin')

@section('content')

<h2 class="archive-title">📦 Archives</h2>

<div class="archive-box">
    <p class="archive-text">
        Castings, inscriptions et paiements archivés automatiquement après traitement.
    </p>

    <div class="archive-grid">

        <div class="archive-card casting">
            <h3>Castings archivés</h3>
            <p>{{ $castings->count() ?? 0 }}</p>
        </div>

        <div class="archive-card subscription">
            <h3>Inscriptions archivées</h3>
            <p>{{ $subscriptions->count() ?? 0 }}</p>
        </div>

        <div class="archive-card payment">
            <h3>Paiements archivés</h3>
            <p>{{ $payments->count() ?? 0 }}</p>
        </div>

    </div>
</div>

@endsection


<!-- CSS EN BAS -->
<style>
    body {
        background: #f1f5f9;
    }

    .archive-title {
        font-size: 26px;
        font-weight: bold;
        color: #0f172a;
        margin-bottom: 15px;
    }

    .archive-box {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .archive-text {
        color: #64748b;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .archive-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .archive-card {
        padding: 20px;
        border-radius: 10px;
        color: #fff;
        text-align: center;
        transition: 0.2s ease;
    }

    .archive-card h3 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .archive-card p {
        font-size: 28px;
        margin-top: 10px;
        font-weight: bold;
    }

    .archive-card:hover {
        transform: translateY(-3px);
    }

    /* 🎨 COLORS */
    .casting {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }

    .subscription {
        background: linear-gradient(135deg, #22c55e, #15803d);
    }

    .payment {
        background: linear-gradient(135deg, #f59e0b, #b45309);
    }
</style>