@extends('admin.layouts.admin')

@section('content')

<h2 class="page-title">💳 Paiements</h2>

<table class="table-admin">

    <thead>
        <tr>
            <th>Référence</th>
            <th>Email</th>
            <th>Montant</th>
            <th>Méthode</th>
            <th>Statut</th>
        </tr>
    </thead>

    <tbody>

        @forelse($payments as $payment)

            <tr>

                <!-- REFERENCE -->
                <td class="ref">
                    {{ $payment->reference }}
                </td>

                <!-- EMAIL -->
                <td class="email">
                    {{ $payment->email }}
                </td>

                <!-- MONTANT -->
                <td class="amount">
                    {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
                </td>

                <!-- METHODE -->
                <td class="method">
                    {{ strtoupper($payment->method) }}
                </td>

                <!-- STATUS -->
                <td>

                    @php
                        $status = strtolower($payment->status);
                    @endphp

                    <span class="status status-{{ $status }}">

                        @if($status === 'pending')
                            ⏳ EN ATTENTE

                        @elseif($status === 'success')
                            ✅ SUCCÈS

                        @elseif($status === 'failed')
                            ❌ ÉCHOUÉ

                        @else
                            {{ strtoupper($payment->status) }}
                        @endif

                    </span>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="empty">
                    Aucun paiement trouvé
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

    .page-title {
        font-size: 26px;
        font-weight: bold;
        color: #0f172a;
        margin-bottom: 20px;
    }

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
        color: #fff;
    }

    .table-admin th {
        padding: 14px;
        text-align: left;
        font-size: 14px;
    }

    .table-admin td {
        padding: 14px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
    }

    .table-admin tr:nth-child(even) {
        background: #f8fafc;
    }

    .table-admin tr:hover {
        background: #e0f2fe;
        transition: 0.2s;
    }

    /* COLONNES */
    .ref {
        font-weight: 600;
        color: #0f172a;
    }

    .email {
        color: #2563eb;
    }

    .amount {
        color: #16a34a;
        font-weight: bold;
    }

    .method {
        color: #7c3aed;
        font-weight: 500;
    }

    /* STATUS BADGES */
    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-pending {
        background: #f59e0b;
    }

    .status-success {
        background: #16a34a;
    }

    .status-failed {
        background: #dc2626;
    }

    .empty {
        text-align: center;
        padding: 30px;
        color: #64748b;
        font-style: italic;
    }

</style>