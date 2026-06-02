@extends('admin.layouts.admin')

@section('content')
    <h2 class="page-title">📜 Historique des Castings</h2>

    <table class="table-admin">

        <thead>
            <tr>
                <th>Titre</th>
                <th>Pays</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Créé le</th>
            </tr>
        </thead>

        <tbody>

            @forelse($castings as $casting)
                <tr>

                    <td class="col-title">
                        {{ $casting->title }}
                    </td>

                    <td class="col-country">
                        {{ $casting->country }}
                    </td>

                    <td>
                        {{ $casting->date }}
                    </td>

                    <td>
                        @if ($casting->status === 'validated')
                            <span class="badge validated">✅ Validé</span>
                        @elseif($casting->status === 'rejected')
                            <span class="badge rejected">❌ Rejeté</span>
                        @elseif($casting->status === 'pending')
                            <span class="badge pending">⏳ En attente</span>
                        @else
                            <span class="badge archived">📦 Archivé</span>
                        @endif
                    </td>

                    <td>
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
@endsection


<style>
    body {
        background: #f1f5f9;
    }

    .page-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .table-admin {
        width: 100%;
        background: white;
        border-collapse: collapse;
    }

    .table-admin th,
    .table-admin td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
    }

    .validated {
        background: #dcfce7;
        color: #166534;
    }

    .rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .pending {
        background: #fef9c3;
        color: #854d0e;
    }

    .archived {
        background: #e2e8f0;
        color: #334155;
    }

    .empty-row {
        text-align: center;
        padding: 20px;
    }
</style>
