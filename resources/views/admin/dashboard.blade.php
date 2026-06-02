@extends('admin.layouts.admin')

@section('content')
    <h2 class="dashboard-title">Dashboard</h2>

    <div class="dashboard-stats">

        <div class="dashboard-card card-blue">
            <h3 class="dashboard-card-title">Castings en attente</h3>
            <p class="dashboard-card-value">{{ $castings_pending }}</p>
        </div>

        <div class="dashboard-card card-green">
            <h3 class="dashboard-card-title">Castings envoyés</h3>
            <p class="dashboard-card-value">{{ $castings_sent ?? 0 }}</p>
        </div>

        <div class="dashboard-card card-orange">
            <h3 class="dashboard-card-title">Inscriptions en attente</h3>
            <p class="dashboard-card-value">{{ $subscriptions_pending }}</p>
        </div>

        <div class="dashboard-card card-purple">
            <h3 class="dashboard-card-title">Paiements en attente</h3>
            <p class="dashboard-card-value">{{ $payments_pending }}</p>
        </div>

        <div class="dashboard-card card-red">
            <h3 class="dashboard-card-title">Notifications</h3>
            <p class="dashboard-card-value">{{ $notificationsCount ?? 0 }}</p>
        </div>

        <div class="dashboard-card card-dark">
            <h3 class="dashboard-card-title">Archives</h3>
            <p class="dashboard-card-value">{{ $archives_count ?? 0 }}</p>
        </div>

    </div>
@endsection


<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .dashboard-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-left: 6px solid transparent;
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
    }

    .dashboard-card-title {
        margin: 0 0 10px;
        font-size: 15px;
        color: #1e293b;
        font-weight: 600;
    }

    .dashboard-card-value {
        margin: 0;
        font-size: 32px;
        font-weight: bold;
        color: #0f172a;
    }

    .dashboard-title {
        font-size: 28px;
        font-weight: bold;
        color: #0f172a;
        margin-bottom: 10px;
    }

    /* 🎨 COLORS */
    .card-blue {
        border-left-color: #3b82f6;
        background: #eff6ff;
    }

    .card-green {
        border-left-color: #22c55e;
        background: #f0fdf4;
    }

    .card-orange {
        border-left-color: #f59e0b;
        background: #fffbeb;
    }

    .card-purple {
        border-left-color: #a855f7;
        background: #faf5ff;
    }

    .card-red {
        border-left-color: #ef4444;
        background: #fef2f2;
    }

    .card-dark {
        border-left-color: #334155;
        background: #f1f5f9;
    }
</style>
