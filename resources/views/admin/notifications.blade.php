@extends('admin.layouts.admin')

@section('content')

<h2 class="page-title">🔔 Notifications</h2>

<div class="notifications-container">

    @forelse($notifications as $notification)
        <div class="notification-card">
            <div class="notification-icon">🔔</div>

            <div class="notification-content">
                {{ $notification->message }}
            </div>

            <div class="notification-date">
                {{ $notification->created_at->diffForHumans() }}
            </div>
        </div>
    @empty
        <div class="empty-state">
            Aucune notification pour le moment.
        </div>
    @endforelse

</div>

@endsection


<!-- CSS EN BAS -->
<style>
    body {
        background: #f1f5f9;
    }

    .page-title {
        font-size: 26px;
        font-weight: bold;
        color: #0f172a;
        margin-bottom: 20px;
    }

    .notifications-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .notification-card {
        background: #ffffff;
        padding: 15px 18px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: 0.2s ease;
        border-left: 5px solid #3b82f6;
    }

    .notification-card:hover {
        transform: translateY(-2px);
        background: #f8fafc;
    }

    .notification-icon {
        font-size: 20px;
        margin-right: 12px;
    }

    .notification-content {
        flex: 1;
        font-size: 14px;
        color: #0f172a;
    }

    .notification-date {
        font-size: 12px;
        color: #64748b;
        white-space: nowrap;
    }

    /* EMPTY STATE */
    .empty-state {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        color: #64748b;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
</style>