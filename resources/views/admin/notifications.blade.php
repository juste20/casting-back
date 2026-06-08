@extends('admin.layouts.admin')

@section('content')

<div class="page-header">
    <h2 class="page-title">Notifications</h2>
    <span class="page-count">{{ $notifications->count() }} notification(s)</span>
</div>

<div class="notifications-container">

    @forelse($notifications as $notification)
        <div class="notification-card">
           <div class="notification-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
            </div>

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

.page-title {
    font-size: 24px;
    font-weight: 700;
    color: #ffffff;
    margin: 0;
}

.page-count {
    font-size: 13px;
    background: rgba(255,255,255,0.06);
    color: #9ca3af;
    padding: 4px 12px;
    border-radius: 20px;
    font-weight: 500;
}

.notifications-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.notification-card {
    background: linear-gradient(145deg, rgba(20,20,20,0.95), rgba(10,10,10,0.98));
    border: 1px solid rgba(255,255,255,0.06);
    padding: 16px 20px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s ease;
    border-left: 4px solid #e50914;
}

.notification-card:hover {
    background: rgba(229,9,20,0.05);
    border-left-color: #ff1a1a;
}

.notification-icon {
    display: flex;
    align-items: center;
    margin-right: 14px;
    color: #e50914;
    flex-shrink: 0;
}

.notification-content {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
    color: #ffffff;
    line-height: 1.5;
}

.notification-date {
    font-size: 12px;
    color: #808080;
    white-space: nowrap;
    margin-left: 12px;
    font-weight: 500;
}

.empty-state {
    background: linear-gradient(145deg, rgba(20,20,20,0.95), rgba(10,10,10,0.98));
    border: 1px solid rgba(255,255,255,0.06);
    padding: 32px;
    border-radius: 16px;
    text-align: center;
    color: #808080;
    font-size: 14px;
}
</style>
