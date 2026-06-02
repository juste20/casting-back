@extends('admin.layouts.admin')

@section('content')

<h2 class="page-title">🎬 Castings reçus</h2>

<table class="table-admin">

    <thead>
        <tr>
            <th>Titre</th>
            <th>Pays</th>
            <th>Date</th>
            <th>Recruteur</th>
            <th>Contact</th>
            <th>Affiche</th>
            <th>Statut</th>
            <th>Actions</th>
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

                <td class="col-date">
                    {{ $casting->date }}
                </td>

                <td>
                    {{ $casting->promoter_email }}
                </td>

                <td>
                    {{ $casting->promoter_phone }}
                </td>

                <td>
                    @if($casting->poster)
                        <img src="{{ asset('storage/' . $casting->poster) }}"
                             style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                    @else
                        -
                    @endif
                </td>

                <td>
                    <span class="badge badge-{{ $casting->status }}">
                        {{ strtoupper($casting->status) }}
                    </span>
                </td>

                <td class="col-actions">

                    <a href="{{ route('admin.castings', $casting->id) }}"
                       class="btn validate">
                        Valider
                    </a>

                    <a href="{{ route('admin.castings', $casting->id) }}"
                       class="btn reject">
                        Rejeter
                    </a>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="8" class="empty-row">
                    Aucun casting trouvé
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
    color: #0f172a;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 20px;
}

.table-admin {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
}

.table-admin thead {
    background: #0f172a;
    color: white;
}

.table-admin th,
.table-admin td {
    padding: 12px;
    font-size: 14px;
}

.table-admin tr:nth-child(even) {
    background: #f8fafc;
}

.col-title {
    font-weight: bold;
}

.badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    color: white;
}

.badge-pending { background: #f59e0b; }
.badge-validated { background: #16a34a; }
.badge-rejected { background: #dc2626; }
.badge-archived { background: #64748b; }

.btn {
    padding: 5px 10px;
    border-radius: 6px;
    color: white;
    text-decoration: none;
    font-size: 12px;
}

.validate { background: #16a34a; }
.reject { background: #dc2626; }

.empty-row {
    text-align: center;
    padding: 20px;
}
</style>