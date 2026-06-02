@extends('admin.layouts.admin')

@section('content')

<h2 class="page-title">📝 Historique des Inscriptions</h2>

<table class="table-admin">

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

                <!-- NOM -->
                <td class="col-name">
                    {{ $subscription->fullname }}
                </td>

                <!-- EMAIL -->
                <td class="col-email">
                    {{ $subscription->email }}
                </td>

                <!-- PAYS -->
                <td class="col-country">
                    {{ $subscription->country }}
                </td>

                <!-- ACTOR ID -->
                <td class="col-actor">
                    #{{ $subscription->actor_id }}
                </td>

                <!-- CATEGORIES -->
                <td class="col-categories">

                    @if(is_array($subscription->categories))

                        @foreach($subscription->categories as $category)

                            <span class="category-badge">
                                {{ $category }}
                            </span>

                        @endforeach

                    @else

                        -
                    
                    @endif

                </td>

                <!-- STATUS -->
                <td>

                    @if($subscription->status == 'sent')

                        <span class="badge sent">
                            📤 Envoyé
                        </span>

                    @elseif($subscription->status == 'pending')

                        <span class="badge pending">
                            ⏳ En attente
                        </span>

                    @else

                        <span class="badge received">
                            📨 Reçu
                        </span>

                    @endif

                </td>

                <!-- DATE -->
                <td class="created-at">
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

@endsection


<!-- CSS EN BAS -->
<style>

    body {
        background: #f1f5f9;
    }

    /* TITRE */
    .page-title {
        color: #0f172a;
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* TABLE */
    .table-admin {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .table-admin thead {
        background: linear-gradient(90deg, #0f172a, #1e293b);
        color: #ffffff;
    }

    .table-admin th {
        padding: 15px;
        text-align: left;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    .table-admin td {
        padding: 14px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
        vertical-align: top;
    }

    .table-admin tr:nth-child(even) {
        background: #f8fafc;
    }

    .table-admin tr:hover {
        background: #e0f2fe;
        transition: 0.2s;
    }

    /* COLONNES */
    .col-name {
        color: #0f172a;
        font-weight: 600;
    }

    .col-email {
        color: #2563eb;
    }

    .col-country {
        color: #7c3aed;
        font-weight: 500;
    }

    .col-actor {
        color: #ea580c;
        font-weight: bold;
    }

    .created-at {
        color: #64748b;
        font-size: 13px;
    }

    /* CATEGORIES */
    .category-badge {
        display: inline-block;
        background: #dbeafe;
        color: #1d4ed8;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        margin: 2px;
        font-weight: 500;
    }

    /* BADGES STATUS */
    .badge {
        padding: 7px 12px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }

    .received {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .pending {
        background: #fef3c7;
        color: #92400e;
    }

    .sent {
        background: #dcfce7;
        color: #166534;
    }

    /* LIGNE VIDE */
    .empty-row {
        text-align: center;
        padding: 30px;
        color: #64748b;
        font-style: italic;
    }

    /* GLOBAL */
    td, th {
        border-right: 1px solid #f1f5f9;
    }

    td:last-child,
    th:last-child {
        border-right: none;
    }

</style>