@extends('admin.layouts.admin')

@section('content')

<div class="page-header">
    <h2 class="page-title">Historique des Inscriptions</h2>
    <span class="page-count">{{ $subscriptions->count() }} entree(s)</span>
</div>

<div class="table-card">
    <table class="admin-table">

        <thead>
            <tr>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Pays</th>
                <th>Actor ID</th>
                <th>Catégories</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>

            @forelse($subscriptions as $subscription)

                <tr>

                    <td class="cell-name">
                        <div class="avatar">{{ substr($subscription->fullname, 0, 2) }}</div>
                        {{ $subscription->fullname }}
                    </td>

                    <td class="cell-email">
                        {{ $subscription->email }}
                    </td>

                    <td class="cell-muted">
                        {{ $subscription->country }}
                    </td>

                    <td class="cell-actor">
                        #{{ $subscription->actor_id }}
                    </td>

                    <td class="cell-categories">

                        @if(is_array($subscription->categories))

                            @foreach($subscription->categories as $category)

                                <span class="label-cat">
                                    {{ $category }}
                                </span>

                            @endforeach

                        @else

                            <span class="label-cat dim">-</span>

                        @endif

                    </td>

                    <td>
                        <span class="label label-{{ $subscription->status == 'sent' ? 'sent' : ($subscription->status == 'pending' ? 'pending' : 'received') }}">
                            @switch($subscription->status)
                                @case('sent') Envoyé @break
                                @case('pending') En attente @break
                                @default Reçu
                            @endswitch
                        </span>
                    </td>

                    <td class="cell-dim">
                        {{ $subscription->created_at->format('d/m/Y H:i') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="empty-row">
                        Aucun historique d'inscription trouvé
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>
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

.table-card {
    background: linear-gradient(145deg, rgba(20,20,20,0.95), rgba(10,10,10,0.98));
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 16px;
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

.admin-table thead {
    background: rgba(255,255,255,0.02);
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

.admin-table th {
    padding: 14px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #808080;
    white-space: nowrap;
}

.admin-table td {
    padding: 14px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    vertical-align: middle;
    color: #ffffff;
}

.admin-table tbody tr:hover {
    background: rgba(255,255,255,0.03);
}

.admin-table tbody tr:last-child td {
    border-bottom: none;
}

.cell-name {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    color: #ffffff;
}

.avatar {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: linear-gradient(135deg, #e50914, #b2070f);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    flex-shrink: 0;
    border: 1px solid rgba(255,255,255,0.06);
}

.cell-email {
    color: #e50914;
}

.cell-muted {
    color: #808080;
}

.cell-actor {
    color: #fbbf24;
    font-weight: 600;
    font-variant-numeric: tabular-nums;
}

.cell-dim {
    color: #9ca3af;
    font-size: 13px;
    font-variant-numeric: tabular-nums;
}

.cell-categories {
    display: flex;
    gap: 4px;
    flex-wrap: wrap;
}

.label-cat {
    display: inline-block;
    background: rgba(255,255,255,0.06);
    color: #9ca3af;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
}

.label-cat.dim {
    background: rgba(255,255,255,0.03);
    color: #808080;
}

.label {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.label-pending {
    background: rgba(245,158,11,0.1);
    color: #fbbf24;
}

.label-sent {
    background: rgba(59,130,246,0.1);
    color: #60a5fa;
}

.label-received {
    background: rgba(16,185,129,0.1);
    color: #34d399;
}

.label-validated {
    background: rgba(16,185,129,0.1);
    color: #34d399;
}

.label-rejected {
    background: rgba(229,9,20,0.1);
    color: #e50914;
}

.label-archived {
    background: rgba(255,255,255,0.05);
    color: #9ca3af;
}

.empty-row {
    text-align: center;
    padding: 30px;
    color: #808080;
    font-style: italic;
}
</style>
