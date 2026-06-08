@extends('admin.layouts.admin')

@section('content')

<div class="page-header">
    <h2 class="page-title">Historique des Castings</h2>
    <span class="page-count">{{ $castings->count() }} entree(s)</span>
</div>

<div class="table-card">
    <table class="admin-table">

        <thead>
            <tr>
                <th>Titre</th>
                <th>Pays</th>
                <th>Periode</th>
                <th>Statut</th>
                <th>Créé le</th>
            </tr>
        </thead>

        <tbody>

            @forelse($castings as $casting)
                <tr>

                    <td class="cell-title">
                        {{ $casting->title }}
                    </td>

                    <td class="cell-muted">
                        {{ $casting->country }}
                    </td>

                    <td class="cell-dim">
                        @if($casting->start_date && $casting->end_date)
                            {{ \Carbon\Carbon::parse($casting->start_date)->format('d/m/Y') }}
                            - {{ \Carbon\Carbon::parse($casting->end_date)->format('d/m/Y') }}
                        @else
                            {{ $casting->date }}
                        @endif
                    </td>

                    <td>
                        <span class="label label-{{ $casting->status }}">
                            @switch($casting->status)
                                @case('validated') Validé @break
                                @case('rejected') Rejeté @break
                                @case('pending') En attente @break
                                @default Archivé
                            @endswitch
                        </span>
                    </td>

                    <td class="cell-dim">
                        {{ $casting->created_at->format('d/m/Y H:i') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="empty-row">
                        Aucun historique trouvé
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

.cell-title {
    font-weight: 600;
    color: #ffffff;
}

.cell-muted {
    color: #808080;
}

.cell-dim {
    color: #9ca3af;
    font-size: 13px;
    font-variant-numeric: tabular-nums;
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
